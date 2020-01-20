<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use App\User;
use App\Shop_product;
use App\Image;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function pasangjualbeli()
    {
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = User::where('name', $id_pelanggan)->get();
        return view('jual-beli.pasang',compact('id_pelanggan','nama_pelanggan'));
    }


    public function pasangproduk(Request $request)
    {

        
        $timestamps = date('YmdHis');
        $id_pelanggan = Auth::user()->id;
        $oldMarker = $timestamps.$id_pelanggan;
        
        $size = count(collect($request)->get('image'));

        $this->validate($request,[

            'image' => 'required'
        ]);

        $folderPath = public_path("Uploads\Produk\{$oldMarker}");
        $response = mkdir($folderPath);
        $nama = array();
       
        

        if($files = $request->file('image')){

            foreach($files as $image){
                $name=$image->getClientOriginalName();
                $image_resize = Images::make($image->getRealPath());
                $image_resize->resize(690, 547);
                $image_resize->crop(500, 500);
                $image_resize->save($folderPath .'/'. $name);
                // $image_resize->move($folderPath,$name);
                $nama[]=$name;
                
            }

        }
    
        $order = Shop_product::create([
            'id_pelanggan' => $id_pelanggan,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $request->detail_produk,
            'gambar' => $nama[0],
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kode_produk' => $oldMarker

        ]);

        $id = $order->id;

        
        for ($i=0; $i < $size ; $i++) {
            Image::create([
                'id_pelanggan' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $oldMarker

            ]);
        }

        return redirect('/jual-beli');
    }



}
