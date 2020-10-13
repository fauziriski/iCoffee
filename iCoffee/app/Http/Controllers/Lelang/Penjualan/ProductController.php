<?php

namespace App\Http\Controllers\Lelang\Penjualan;

use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Auction_process;
use App\Auction_product;
use App\Auction_image;
use App\Helper\Helper;
use Carbon\Carbon;
use App\Category;
use App\Address;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $myProduct = Auction_product::where('id_pelelang', $user_id)->orderBy('created_at','desc')->paginate(12);
        // dd($myProduct);
        return view('jual-beli.lelang.myProduct', compact('myProduct'));

    }

    public function create()
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
            return redirect('/profile/edit');       

        }

        $category = Category::all();

        for ($i=0; $i <5 ; $i++) { 
            $j[] = $i;
        }
    
        return view('jual-beli.lelang.pasang', compact('category', 'j'));
    }

    public function store(Request $request)
    {
        
        $size = count($request->file());
        if ($size == 0) {
            Alert::error('Gagal','Masukan Foto Produk Pertama')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        } elseif ($size == 1) {
            Alert::error('Gagal','Masukan Foto Produk Kedua')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        }

        //geser nama gambar
        $image_file = array();
        for ($i=0; $i < 5 ; $i++) 
        { 
            if(!(empty($request->file('image-'.$i)))){
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

            if($filesize > 2048 ) {
                Alert::error('Gagal','Ukuran Gambar Tidak Lebih Dari 2 Mb')->showConfirmButton('Ok', '#3085d6');
                return back();

            }elseif(!($image_file[$i]->isValid())) {
                Alert::error('Gagal','Gambar yang Anda Masukan Korupt, Ganti dengan Gambar Lain')->showConfirmButton('Ok', '#3085d6');
                return back();

            }elseif($image_file[$i]->getMimeType() == 'image/jpeg' &&  $filesize < 2048) {
                $jumlah_gambar_bener[] = $image_file[$i]; 

            }elseif($image_file[$i]->getMimeType() == 'image/png' && $filesize < 2048 ) {
                $jumlah_gambar_bener[] = $image_file[$i];

            }else {
                Alert::error('Gagal','File yang Anda Masukan Bukan Gambar')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
            
        }
        $harga_awal = Helper::instance()->removeDot($request->harga_awal);
        $kelipatan =  Helper::instance()->removeDot($request->kelipatan);
        $stok = Helper::instance()->removeDot($request->stok);
        
        
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
        $invoice = $timestamps.$id_pelanggan;

        $size = count($request->file());

        $folderPath = public_path("Uploads/Lelang/".$invoice);
        $response = mkdir($folderPath);
        $nama = array();

        //Change content to html                
        $content = $request->deskripsi;
        // $dom = new \DomDocument();
        // $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        // $content = $dom->saveHTML();

        for ($i=0; $i < $size; $i++) { 
            if($files = $image_file[$i]) {

                // $names=$files->getClientOriginalName();
                // $image_resize = Images::make($files->getRealPath());
                // $image_resize->resize(690, 547);
                // $image_resize->crop(500, 500);
                // $image_resize->save($folderPath .'/'. $names);
                // // $image_resize->move($folderPath,$name);
                // $nama[]=$names;
                $name = 'product_auction_' .$invoice .'_' . \Carbon\Carbon::now()->format('Ymd_His'). '-' .uniqid() . '.' . $files->getClientOriginalExtension();
                // $name = $files->getClientOriginalName();
                $image_resize = Images::make($files->getRealPath());
                $image_resize->resize(690, 547);
                $image_resize->crop(570, 512);
                $image_resize->save($folderPath .'/'. $name);
                $nama[]=$name;
                
            }
        }

        if ($content) {
            $produk = Auction_product::create([
                'id_pelelang' => $id_pelanggan,
                'nama_produk' => $request->nama_produk,
                'desc_produk' => $content,
                'kelipatan' => $kelipatan,
                'stok' => $request->stok,
                'harga_awal' => $harga_awal,
                'lama_lelang' => $request->lama_lelang,
                'gambar' => $nama[0],
                'stok' => $stok,
                'kode_lelang' => $invoice,
                'id_kategori' => $request->id_kategori,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_berakhir' => $tanggal_selesai,
                'status' => '1'
    
            ]);

            if ($produk) {
                $process = Auction_process::create([
                    'id_produk' => $produk->id,
                    'id_pelelang' => $id_pelanggan,
                    'id_penawar' => $id_pelanggan,
                    'nama' => $nama_pelanggan,
                    'penawaran' => $harga_awal,
                    'pemenang' => '0',
                    'kelipatan' => $kelipatan,
                    'status' => '1'
                ]);

                if ($process) {
                    for ($i=1; $i < $size ; $i++) {
                        $produkdetails = Auction_image::create([
                            'id_pelelang' => $id_pelanggan,
                            'id_produk' => $produk->id,
                            'nama_gambar' => $nama[$i],
                            'kode_produk' => $invoice
                        ]);
                    }

                    Alert::success('Berhasil','Tunggu Proses Selanjutnya');
                    return redirect('/lelang');
                } else {
                    Alert::error('Gagal', 'Gagal menambahkan produk')->showConfirmButton('Ok', '#3085d6');
                    return back();
                }
            } else {
                Alert::error('Gagal', 'Gagal menambahkan produk')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
        } else {
            Alert::error('Gagal')->showConfirmButton('Ok', '#3085d6');
            return back();
        }

        
        
    }
}
