<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Shop_product;
use App\Image;
use DB;



class ProdukController extends Controller
{

    public function index()
    {
        // $id_customer = Auth::id();
        
        $products = Shop_product::orderBy('created_at','desc')->paginate(12);
    
        return view('jual-beli.index',compact('products'));
    }

    public function lelang() {
        return view('jual-beli.lelang.index');
    }

    public function detail($id)
    {
        $id_customer = Auth::id();
        
        $products = Shop_product::find($id);
        $produk_terkait = Shop_product::where('id_kategori', $products->id_kategori)->take(4)->get();
        $image = Image::where('id_produk', $products->id)->get();
    
        return view('jual-beli.detailproduk',compact('products','image','produk_terkait'));
    }

    
    
}
