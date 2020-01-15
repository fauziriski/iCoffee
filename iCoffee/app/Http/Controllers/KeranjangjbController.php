<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Shop_product;
use App\Image;
use App\JbCart;
use DB;

class KeranjangjbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function keranjang()
    {

        $id_customer = Auth::user()->id;
        $keranjang = JbCart::where('id_pelanggan', $id_customer)->orderBy('created_at','desc')->get();
        $subtotal = $keranjang->sum('total');
        $carttotal = $keranjang->count();

        return view('jual-beli.keranjang', compact('keranjang','subtotal','carttotal'));
    }

    public function tambahkeranjang(Request $request)
    {
        $id_customer = Auth::user()->id;

        $total = $request->harga*$request->quantity;

        $keranjang = JbCart::create([
            'id_pelanggan' => $id_customer,
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->quantity,
            'harga' => $request->harga,
            'kode_produk' => $request->kode_produk,
            'total' => $total,
            'image' => $request->gambar

        ]);

        $keranjang = JbCart::where('id_pelanggan', $id_customer)->get();


        return redirect('/jual-beli/keranjang');
    }
    
}
