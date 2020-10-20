<?php

namespace App\Http\Controllers\JualBeli\Penjualan;

use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Shop_product;
use App\Category;
use App\Address;
use App\Image;
use App\User;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;

        $produk = Shop_product::where('id_pelanggan', $user_id)->get();
        $category = Category::all();

        return view('jual-beli.myProduct', compact('produk', 'category'));
    }

    public function create()
    {
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = User::where('name', $id_pelanggan)->get();
        $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->whereIn('status', [0,1])->get();

        if($cekalamat->isEmpty()) {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/tambahalamat');       

        }

        $alamat_utama = $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->where('status', 1)->get();

        if(empty($alamat_utama)) {
            Alert::info('Tentukan Alamat Utama')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/edit');       

        }

        for ($i=0; $i <5 ; $i++) { 
            $j[] = $i;
        }

        $category = Category::all();
        return view('jual-beli.pasang',compact('category', 'j'));
    }
    
    public function store(Request $request)
    {
        $size = count($request->file());
        if ($size == 0) {
            Alert::error('Gagal','Masukan Foto Produk Pertama')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        }
        elseif ($size == 1) {
            Alert::error('Gagal','Masukan Foto Produk Kedua')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        }
        $harga = $this->removeDot($request->harga);
        $stok = $this->removeDot($request->stok);
        
        $timestamps = date('YmdHis');
        $id_pelanggan = Auth::user()->id;
        $invoice = $timestamps.$id_pelanggan;
        
        //geser nama gambar
        $image_file = array();
        for ($i=0; $i < 5 ; $i++) 
        { 
            if(!(empty($request->file('image-'.$i)))) {
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

            if($filesize > 2048 ){
                Alert::error('Gagal','Ukuran Gambar Tidak Lebih Dari 2 Mb')->showConfirmButton('Ok', '#3085d6');
                return back();

            }elseif(!($image_file[$i]->isValid())){
                Alert::error('Gagal','Gambar yang Anda Masukan Korupt, Ganti dengan Gambar Lain')->showConfirmButton('Ok', '#3085d6');
                return back();

            }elseif($image_file[$i]->getMimeType() == 'image/jpeg' &&  $filesize < 2048){
                $jumlah_gambar_bener[] = $image_file[$i]; 

            }elseif($image_file[$i]->getMimeType() == 'image/png' && $filesize < 2048 ){
                $jumlah_gambar_bener[] = $image_file[$i];

            }else{
                Alert::error('Gagal','File yang Anda Masukan Bukan Gambar')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
        }


        $folderPath = public_path("Uploads/Produk/".$invoice);
        $response = mkdir($folderPath);
        $nama = array();
        for ($i=0; $i < $size; $i++) { 
            if($files = $image_file[$i]){
                $name = 'product_marketplace_' .$invoice .'_' . \Carbon\Carbon::now()->format('Ymd_His'). '-' .uniqid() . '.' . $files->getClientOriginalExtension();
                // $name = $files->getClientOriginalName();
                $image_resize = Images::make($files->getRealPath());
                $image_resize->resize(690, 547);
                $image_resize->crop(570, 512);
                $image_resize->save($folderPath .'/'. $name);
                // $image_resize->move($folderPath,$name);
                $nama[]=$name;
            }

        }

        //Change content to html                
        $content = $request->detail_produk;
        // dd($content);
        // $dom = new \DOMDocument();
        // libxml_use_internal_errors(true);
        // $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        // dd($dom);
        // $content = $dom->saveHTML();
        $slug = Str::slug($request->get('nama_produk').'-'.rand(10000,99999));
        $order = Shop_product::create([
            'id_pelanggan' => $id_pelanggan,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $content,
            'gambar' => $nama[0],
            'harga' => $harga,
            'stok' => $stok,
            'kode_produk' => $invoice,
            'status' => '1',
            'slug' => $slug

        ]);

        $id = $order->id;

        
        for ($i=1; $i < $size ; $i++) {
            Image::create([
                'id_pelanggan' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $invoice

            ]);
        }

        return redirect('/jual-beli');
    }

    public function edit($id)
    {
        $produk = Shop_product::where('id', $id)->first();
        $images = Image::where('id_produk', $produk->id)->get();

        if (!$produk) {
            Alert::error('Gagal','Produk tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
           return back();
        }

        $kategori = $produk->category->kategori;
        $category = Category::all();
        for ($i=0; $i <5 ; $i++) { 
            $j[] = $i;
        }
        return view('jual-beli.editProduct', compact('produk', 'kategori','category', 'j', 'images'));
    }

    public function update(Request $request)
    {
        
        $validateData = $this->validate($request, [
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|max:11',
            'stok' => 'required|max:6',
            'id_kategori' => 'required|exists:categories,id',
            'detail_produk' => 'required',
            'old_image' => 'required',
            'old_image-0' => 'required',
        ]);

        $harga = $this->removeDot($request->harga);
        $stok = $this->removeDot($request->stok);

        $size = count($request->file());

        if ($size) {
            if ($size == 0) {
                Alert::error('Gagal','Masukan Foto Produk Pertama')->showConfirmButton('Ok', '#3085d6');
                return back();
                
            }
            elseif ($size == 1) {
                Alert::error('Gagal','Masukan Foto Produk Kedua')->showConfirmButton('Ok', '#3085d6');
                return back();
                
            }
            
            $image_file = array();
            for ($i=0; $i < 5 ; $i++) 
            { 
                if(!(empty($request->file('image-'.$i)))) {
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

                if($filesize > 2048 ){
                    Alert::error('Gagal','Ukuran Gambar Tidak Lebih Dari 2 Mb')->showConfirmButton('Ok', '#3085d6');
                    return back();

                }elseif(!($image_file[$i]->isValid())){
                    Alert::error('Gagal','Gambar yang Anda Masukan Korupt, Ganti dengan Gambar Lain')->showConfirmButton('Ok', '#3085d6');
                    return back();

                }elseif($image_file[$i]->getMimeType() == 'image/jpeg' &&  $filesize < 2048){
                    $jumlah_gambar_bener[] = $image_file[$i]; 

                }elseif($image_file[$i]->getMimeType() == 'image/png' && $filesize < 2048 ){
                    $jumlah_gambar_bener[] = $image_file[$i];

                }else{
                    Alert::error('Gagal','File yang Anda Masukan Bukan Gambar')->showConfirmButton('Ok', '#3085d6');
                    return back();
                }
            }

            $produk = Shop_product::where('id', $request->produk_id)->first();

            $folderPath = public_path("Uploads/Produk/".$produk->invoice);
            $nama = array();
            for ($i=0; $i < $size; $i++) { 
                if($files = $image_file[$i]){
                    $name = 'product_marketplace_' .$invoice .'_' . \Carbon\Carbon::now()->format('Ymd_His'). '-' .uniqid() . '.' . $files->getClientOriginalExtension();
                    // $name = $files->getClientOriginalName();
                    $image_resize = Images::make($files->getRealPath());
                    $image_resize->resize(690, 547);
                    $image_resize->crop(570, 512);
                    $image_resize->save($folderPath .'/'. $name);
                    // $image_resize->move($folderPath,$name);
                    $nama[]=$name;
                }

            }
            
        }

        $content = $request->detail_produk;


        $update = $produk->update([
            'id_pelanggan' => $id_pelanggan,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $content,
            'gambar' => $nama[0],
            'harga' => $harga,
            'stok' => $stok,
            'kode_produk' => $invoice,
            'status' => '1',
            'slug' => $slug

        ]);

        $id = $order->id;

        
        for ($i=1; $i < $size ; $i++) {
            Image::create([
                'id_pelanggan' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $invoice

            ]);
        }

        return redirect('/jual-beli');

      
        $produk->update([
            'nama_produk' => $request->nama_produk_edit,
            'id_kategori' => $request->kategori_kopi_edit,
            'harga' => $harga,
            'stok' => $stok, 
            'detail_produk' => $content
        ]);

        return response()->json();
    }

    public function removeDot($value)
    {
        $trueValue = str_replace('.', '', $value);
        if ($trueValue) {
            return $trueValue;
        }
        else {
            return $value;
        }
        
    }
}
