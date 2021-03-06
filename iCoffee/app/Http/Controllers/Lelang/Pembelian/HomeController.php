<?php

namespace App\Http\Controllers\Lelang\Pembelian;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auction_process;
use App\Auction_product;
use App\Auction_winner;
use App\Joint_account;
use App\Auction_image;
use Carbon\Carbon;
use App\Category;
use App\User;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $products = Auction_product::where('status', 2)->orderBy('created_at','desc')->paginate(12);
    
        $panjang = count($products);
    
        return view('jual-beli.lelang.index', compact('products','panjang', 'category'));
    }

    public function show($id)
    {
        $id_pelanggan = Auth::user()->id;

        $nama_pelanggan = Auth::user()->name;

        $products = Auction_product::find($id);

        if ($products->status == 1) {
           
            Alert::info('Gagal', 'Menunggu Konfirmasi Admin')->showConfirmButton('Ok', '#3085d6');
            return back();
        }

        elseif ($products->status == 3) {
           
            Alert::info('Gagal', 'Sedang Dalam Pengecekan')->showConfirmButton('Ok', '#3085d6');
            return back();
        }
        $tanggal_selesai = $products->tanggal_berakhir;

        $cek = Carbon::parse($tanggal_selesai);

        $tanggal_mulai =  Carbon::parse(date('Y-m-d H:i:s'));

        $now = Carbon::now()->timestamp;
        $today = Carbon::now(new \DateTimeZone('Asia/Jakarta'));
        $auction_process = $today->gt($cek);

        $endday =  $cek->timestamp;

        $waktu = $endday-$now;

        if($waktu <= 0) {
            $auction_proses = Auction_process::where('id_produk', $products->id)->take(4)->latest('updated_at')->get();
            // $temp = array();
            // for ($i=0; $i <count($pemenang) ; $i--) { 
            //     for ($j=count($pemenang); $j <$i ; $j--) { 
            //         if ($pemenang->penawaran[$j] < $pemenang[$j-1]->penawaran) {
            //             $temp = $pemenang[$j]->penawaran;
            //             $pemenang[$j]->penawaran = $pemenang[$j-1]->penawaran;
            //             $pemenang[$j-1]->penawaran = $temp;
            //         }
            //     }
            // }

            // $size = count($pemenang)-1;
            // for ($i=0; $i<$size; $i++) {
            //     for ($j=0; $j<$size-$i; $j++) {
            //         $k = $j+1;
            //         if ($pemenang[$k]->penawaran > $pemenang[$j]->penawaran) {
            //             // Swap elements at indices: $j, $k
            //             list($pemenang[$j], $pemenang[$k]) = array($pemenang[$k], $pemenang[$j]);
            //         }
            //     }
            // }

            $pemenang = $this->bubble_sort($auction_proses);

            $cek_auction_winner = Auction_winner::where('id_produk_lelang', $products->id)->first();

            if($cek_auction_winner == NULL) {
                $pemenang_lelang = Auction_winner::create([
                    'id_pemenang' => $pemenang[0]->id_penawar,
                    'id_pelelang' => $pemenang[0]->id_pelelang,
                    'id_produk_lelang' => $pemenang[0]->id_produk,
                    'jumlah_penawaran' => $pemenang[0]->penawaran,
                    'status' => '1'
                ]);
            }
        
        } elseif($waktu > 0) {
            $cek_auction_winner = Auction_winner::where('id_produk_lelang', $products->id)->first();

            if(!($cek_auction_winner == NULL)) {
                $cek_auction_winner->delete();
            }
        }

        $proses = Auction_process::where('id_produk', $products->id)->latest('updated_at')->first();


        if(empty($proses)) {
            $process = Auction_process::create([
                'id_produk' => $products->id,
                'id_pelelang' => $products->id_pelelang,
                'id_penawar' => $products->id_pelelang,
                'nama' => 'pelelang',
                'penawaran' => $products->harga_awal,
                'pemenang' => '0',
                'kelipatan' => $products->kelipatan,
                'status' => '1'
            ]);

            $proses = Auction_process::where('id_produk', $products->id)->latest('updated_at')->first();

        }

        $tawar = $proses->penawaran+$proses->kelipatan;

        $produk_terkait = Auction_product::where('id_kategori', $products->id_kategori)->where('status', 2)->where('id','!=', $id)->take(4)->get();

        if($produk_terkait->isEmpty()) {
            $produk_terkait = Auction_product::where('status', 2)->where('id','!=', $id)->take(4)->get();
        }

        $panjang = count($produk_terkait);
        
        $image = Auction_image::where('id_produk', $products->id)->get();

        $bids = Auction_process::where('id_produk', $products->id)->latest('updated_at')->take(4)->get();
        $penawar = $this->bubble_sort($bids);
        

        $i = 1;
    
        return view('jual-beli.lelang.detaillelang',compact('products','image','produk_terkait','proses','tawar', 'penawar','i','panjang', 'auction_process'));
    }

    public function indexById($id)
    {
        $products = Auction_product::where('status', 2)->where('id_kategori', $id)->orderBy('created_at','desc')->paginate(12);

        $panjang = count($products);
        $category = Category::all();

        return view('jual-beli.lelang.index', compact('products','panjang','category'));

    }

    public function search(Request $request)
    {
        $validateData = $this->validate($request, [
            'search' =>'required|string',
        ]);

        $products = DB::table('auction_products')
                ->where('nama_produk', 'like', '%'.$request->search.'%')
                ->where('status', '=', '2')
                ->paginate(12);

        $category = Category::all();
        $panjang = count($products);

        if ($products) {
            return view('jual-beli.lelang.index',compact('products','panjang', 'category'));
        }
        else {
            return back();
            Alert::error('Gagal','Kopi Tidak Ditemukan');
        }
        
    }

    public function getDataAuction($id)
    {
        $products = Auction_product::find($id);

        $bids = Auction_process::where('id_produk', $products->id)->latest('updated_at')->take(4)->get();
        $i = 1;
        $penawar = $this->bubble_sort($bids);

    
        return view('jual-beli.lelang.data',compact('penawar','i'));
    }

    
    public function bid(Request $request)
    {
        $id_pelanggan = Auth::user()->id;

        $produk = Auction_product::where('id', $request->id_produk)->first();
        $cek_saldo = Joint_account::where('user_id', $id_pelanggan)->first();

        $lima_persen = 5/100*$produk->harga_awal;

        if($cek_saldo->saldo < $lima_persen)
        {
            return response()->json(['response' => 'Saldo', 'data' => $request]);
        }



        if($request->id_pelelang == $id_pelanggan){

            return response()->json(['response' => 'Gagal', 'data' => $request]);
        }


        $process = Auction_process::create([
            'id_produk' => $request->id_produk,
            'id_pelelang' => $request->id_pelelang,
            'id_penawar' => $request->id_penawar,
            'nama' => $request->nama,
            'penawaran' => $request->penawaran,
            'pemenang' => '0',
            'kelipatan' => $request->kelipatan,
            'status' => '1'
        ]);
        $i = 1;

        return response()->json(['response' => 'Berhasil', 'data' => $process]);



    }

    
    public function bubble_sort($arr) {
        $size = count($arr)-1;
        for ($i=0; $i<$size; $i++) {
            for ($j=0; $j<$size-$i; $j++) {
                $k = $j+1;
                if ($arr[$k]->penawaran > $arr[$j]->penawaran) {
                    // Swap elements at indices: $j, $k
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
    }

    
}
