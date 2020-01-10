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


        $order = Shop_product::create([
            'id_pelanggan' => $id_pelanggan,
            'id_kategori' => '1',
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $request->detail_produk,
            'gambar' => 'coba.png',
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kode_produk' => $oldMarker

        ]);

        $id = $order->id;

        

        Image::create([
            'id_pelanggan' => $id_pelanggan,
            'id_produk' => $id,
            'nama_gambar' => 'coba.png',
            'kode_produk' => $oldMarker

        ]);

        return redirect('/');
    }
    
}
