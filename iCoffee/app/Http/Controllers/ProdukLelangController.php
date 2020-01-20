<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use App\Auction_product;
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
        
        $timestamps = date('YmdHis');
        $id_pelanggan = Auth::user()->id;
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

        $order = Auction_product::create([
            'id_pelelang' => $id_pelanggan,
            'nama_produk' => $request->nama_produk,
            'desc_produk' => $request->deskripsi,
            'kelipatan' => $request->kelipatan,
            'harga_awal' => $request->harga_awal,
            'lama_lelang' => $request->lama_lelang,
            'gambar' => $name,
            'kode_lelang' => $oldMarker,
            'id_kategori' => $request->id_kategori,
            'status' => '1'

        ]);

        $id = $order->id;

        
        for ($i=1; $i < $size ; $i++) {
            Auction_image::create([
                'id_pelelang' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $oldMarker

            ]);
        }
        return redirect('/jual-beli');
        
    }
    


}
