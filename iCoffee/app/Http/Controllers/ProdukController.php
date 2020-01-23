<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Shop_product;
use App\Image;
use App\Auction_product;
use App\Auction_process;
use App\Auction_image;
use DB;



class ProdukController extends Controller
{

    public function index()
    {
        // $id_customer = Auth::id();
        
        $products = Shop_product::orderBy('created_at','desc')->paginate(12);
    
        return view('jual-beli.index',compact('products'));
    }

    public function detail($id)
    {

        
        $products = Shop_product::find($id);
        $produk_terkait = Shop_product::where('id_kategori', $products->id_kategori)->take(4)->get();
        $image = Image::where('id_produk', $products->id)->get();
    
        return view('jual-beli.detailproduk',compact('products','image','produk_terkait'));
    }

    public function lelang() {

        $products = Auction_product::orderBy('created_at','desc')->paginate(12);

        $panjang = count($products);

        return view('jual-beli.lelang.index', compact('products','panjang'));
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

    
    
}
