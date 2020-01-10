<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Shop_product;
use App\Category;
use App\Image;



class ProdukController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pasangjualbeli()
    {
        $id_pelanggan = Auth::id();
        $nama_pelanggan = User::where('name', $id_pelanggan)->get();
        return view('jual-beli.pasang',compact('id_pelanggan','nama_pelanggan'));
    }


    public function pasangproduk(Request $request)
    {

        $timestamps = date('YmdHis');
        $id_pelanggan = Auth::id();
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
                $image->move($folderPath,$name);
                $nama[]=$name;
                
            }


        }
    


        $order = Shop_product::create([
            'id_pelanggan' => $id_pelanggan,
            'id_kategori' => '1',
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

        return redirect('/');
    }


    public function index()
    {
        $id_customer = Auth::id();
    
        $products = DB::table('products')->paginate(8);
        $cart = Cart::where('id_customer', $id_customer)->get();
        $size = $cart->count();
 
    
        return view('User.index',compact('products','size'));
    }
    
}
