<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use App\Auction_product;
use App\Auction_process;
use App\Auction_image;

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
        return view('jual-beli.lelang.pasang');
    }

    public function pasangLelangberhasil(Request $request)
    {
      
        $this->validate($request,[

            'images' => 'required',
            'image' => 'required'
        ]);

        // dd($request);
        $lama = $request->lama_lelang;
        
        $timestamps = date('YmdHis');
        $tanggal_mulai = date('Y-m-d H:i:s');
        $tanggal_selesai = date("Y-m-d H:i:s", strtotime("+". $lama ."days"));
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = Auth::user()->name;
        $oldMarker = $timestamps.$id_pelanggan;

        $size = count(collect($request)->get('image'));

        $folderPath = public_path("Uploads\Lelang\{$oldMarker}");
        $response = mkdir($folderPath);
        $nama = array();


        if($files = $request->file('images')){

            $name=$files->getClientOriginalName();
            $image_resize = Images::make($files->getRealPath());
            $image_resize->resize(690, 547);
            $image_resize->crop(500, 500);
            $image_resize->save($folderPath .'/'. $name);
                // $image_resize->move($folderPath,$name);          
            
        }

        if($files = $request->file('image')){

            foreach($files as $image){
                $names=$image->getClientOriginalName();
                $image_resize = Images::make($image->getRealPath());
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
            'gambar' => $name,
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
              
        for ($i=0; $i < $size ; $i++) {
            $produkdetails = Auction_image::create([
                'id_pelelang' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $oldMarker

            ]);
            
            
        }
        return redirect('/lelang');
        
    }

    public function detaillelang($id)
    {

        $products = Auction_product::find($id);

        $proses = Auction_process::where('id_produk', $products->id)->latest('updated_at')->first();
        $tawar = $proses->penawaran+$proses->kelipatan;

        $produk_terkait = Auction_product::where('id_kategori', $products->id_kategori)->take(4)->get();
        $image = Auction_image::where('id_produk', $products->id)->get();

        $penawar = Auction_process::where('id_produk', $products->id)->latest('updated_at')->take(4)->get();
        $i = 1;
    
        return view('jual-beli.lelang.detaillelang',compact('products','image','produk_terkait','proses','tawar', 'penawar','i'));
    }

    public function tawar(Request $request)
    {
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

        return response()->json($process);



    }

    public function datalelang($id)
    {

        $products = Auction_product::find($id);

        $penawar = Auction_process::where('id_produk', $products->id)->latest('updated_at')->take(4)->get();
        $i = 1;
    
        return view('jual-beli.lelang.data',compact('penawar','i'));
    }
    


}
