<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Address;
use App\Auction_product;
use App\Auction_process;
use App\Auction_winner;
use App\Auction_image;
use App\Joint_account;
use App\Category;

class ProdukLelangController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function pasangLelang()
    {
        $id_pelanggan = Auth::user()->id;
        $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->get();
        if($cekalamat->isEmpty())
        {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/tambahalamat');       

        }
        $alamat_utama = $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->where('status', 1)->get();

        if(empty($alamat_utama))
        {
            Alert::info('Tentukan Alamat Utama')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/edit');       

        }

        $category = Category::all();
    
        return view('jual-beli.lelang.pasang', compact('category'));
    }

    public function pasangLelangberhasil(Request $request)
    {
        $size = count($request->file());
        if ($size == 0) 
        {
            Alert::error('Gagal','Masukan Foto Produk Pertama')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        }
        elseif ($size == 1) 
        {
            Alert::error('Gagal','Masukan Foto Produk Kedua')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        }

        //geser nama gambar
        $image_file = array();
        for ($i=0; $i < 5 ; $i++) 
        { 
            if(!(empty($request->file('image-'.$i))))
            {
                $image_file[] = $request->file('image-'.$i);
            }
        }


        $jumlah_gambar_bener = array();
        $jumlah_gambar = count($image_file);
        
        for ($i=0; $i < $jumlah_gambar ; $i++) 
        { 
            $filesize = 0;
            $filesize = filesize($image_file[$i]);
            $filesize = round($filesize / 1024, 2);

            if($filesize > 2048 )
            {
                Alert::error('Gagal','Ukuran Gambar Tidak Lebih Dari 2 Mb')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
            elseif(!($image_file[$i]->isValid()))
            {
                Alert::error('Gagal','Gambar yang Anda Masukan Korupt, Ganti dengan Gambar Lain')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
            
            elseif($image_file[$i]->getMimeType() == 'image/jpeg' &&  $filesize < 2048)
            {
                $jumlah_gambar_bener[] = $image_file[$i]; 
            }
            elseif($image_file[$i]->getMimeType() == 'image/png' && $filesize < 2048 )
            {
                $jumlah_gambar_bener[] = $image_file[$i];

            }
            else
            {
                Alert::error('Gagal','File yang Anda Masukan Bukan Gambar')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
            
        }

        $this->validate($request,[

            'image-0' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $lama = $request->lama_lelang;
        $split = explode('-', $lama);

        $timestamps = date('YmdHis');
        $tanggal_mulai = date('Y-m-d H:i:s');

        if ($split[1] == 'Hari') {
            $tanggal_selesai = date("Y-m-d H:i:s", strtotime("+". $split[0] ."days"));
        } elseif($split[1] =='Jam') {
            $tanggal_selesai = date("Y-m-d H:i:s", strtotime("+". $split[0] ."hours"));
        }

        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = Auth::user()->name;
        $oldMarker = $timestamps.$id_pelanggan;

        $size = count($request->file());

        $folderPath = public_path("Uploads/Lelang/{".$oldMarker."}");
        $response = mkdir($folderPath);
        $nama = array();

        for ($i=0; $i < $size; $i++) { 
            if($files = $image_file[$i]){

                $names=$files->getClientOriginalName();
                $image_resize = Images::make($files->getRealPath());
                $image_resize->resize(690, 547);
                $image_resize->crop(500, 500);
                $image_resize->save($folderPath .'/'. $names);
                // $image_resize->move($folderPath,$name);
                $nama[]=$names;
                
            }
        }

        $produk = Auction_product::create([
            'id_pelelang' => $id_pelanggan,
            'nama_produk' => $request->nama_produk,
            'desc_produk' => $request->deskripsi,
            'kelipatan' => $request->kelipatan,
            'stok' => $request->stok,
            'harga_awal' => $request->harga_awal,
            'lama_lelang' => $request->lama_lelang,
            'gambar' => $nama[0],
            'stok' => $request->stok,
            'kode_lelang' => $oldMarker,
            'id_kategori' => $request->id_kategori,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_berakhir' => $tanggal_selesai,
            'status' => '1'

        ]);

        $id = $produk->id;

        $process = Auction_process::create([
            'id_produk' => $id,
            'id_pelelang' => $id_pelanggan,
            'id_penawar' => $id_pelanggan,
            'nama' => $nama_pelanggan,
            'penawaran' => $request->harga_awal,
            'pemenang' => '0',
            'kelipatan' => $request->kelipatan,
            'status' => '1'
        ]);
              
        for ($i=1; $i < $size ; $i++) {
            $produkdetails = Auction_image::create([
                'id_pelelang' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $oldMarker

            ]);
            
            
        }
        Alert::success('Berhasil','Tunggu Proses Selanjutnya');
        return redirect('/lelang');
        
    }

    public function detaillelang($id)
    {
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = Auth::user()->name;

        $products = Auction_product::find($id);


        $tanggal_selesai = $products->tanggal_berakhir;

        $cek = Carbon::parse($tanggal_selesai);
        $tanggal_mulai =  Carbon::parse(date('Y-m-d H:i:s'));
        $now = Carbon::now()->timestamp;
        $endday =  $cek->timestamp;

        $waktu = $endday-$now;

        if($waktu <= 0)
        {
            $pemenang = Auction_process::where('id_produk', $products->id)->latest('updated_at')->first();

            $cek_auction_winner = Auction_winner::where('id_produk_lelang', $products->id)->first();

            if($cek_auction_winner == NULL)
            {
                $pemenang_lelang = Auction_winner::create([
                    'id_pemenang' => $pemenang->id_penawar,
                    'id_pelelang' => $pemenang->id_pelelang,
                    'id_produk_lelang' => $pemenang->id_produk,
                    'jumlah_penawaran' => $pemenang->penawaran,
                    'status' => '1'
                ]);
            }
        
        } elseif($waktu > 0) {
            $cek_auction_winner = Auction_winner::where('id_produk_lelang', $products->id)->first();

            if(!($cek_auction_winner == NULL))
            {
                $cek_auction_winner->delete();
            }

        }


        $proses = Auction_process::where('id_produk', $products->id)->latest('updated_at')->first();
        // dd($proses);


        if(empty($proses))
        {
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

        if($produk_terkait->isEmpty())
        {
            $produk_terkait = Auction_product::where('status', 2)->where('id','!=', $id)->take(4)->get();
        }
        $panjang = count($produk_terkait);
        $image = Auction_image::where('id_produk', $products->id)->get();

        $penawar = Auction_process::where('id_produk', $products->id)->latest('updated_at')->take(4)->get();

        $i = 1;
    
        return view('jual-beli.lelang.detaillelang',compact('products','image','produk_terkait','proses','tawar', 'penawar','i','panjang'));
    }

    public function tawar(Request $request)
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
        Alert::success('Tawaran Anda Berhasil');

        return response()->json(['response' => 'Berhasil', 'data' => $process]);



    }

    public function datalelang($id)
    {

        $products = Auction_product::find($id);

        $penawar = Auction_process::where('id_produk', $products->id)->latest('updated_at')->take(4)->get();
        $i = 1;
    
        return view('jual-beli.lelang.data',compact('penawar','i'));
    }
    
}
