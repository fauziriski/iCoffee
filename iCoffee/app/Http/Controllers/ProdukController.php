<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
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
        $produk_terkait = Shop_product::where('id_kategori', $products->id_kategori)->where('id', '!=', $id)->take(4)->get();
        if($produk_terkait->isEmpty()){
            $produk_terkait = Shop_product::where('id', '!=', $id)->orderBy('created_at','desc')->take(4)->get();
        }
        $image = Image::where('id_produk', $products->id)->get();
    
        return view('jual-beli.detailproduk',compact('products','image','produk_terkait'));
    }

    public function lelang() {
        // alert()->html('<i>HTML</i> <u>example</u>',"
        //                 You can use <b>bold text</b>,
        //                 <a href='//github.com'>links</a>
        //                 and other HTML tags
        //                 ",'success')->autoClose(5000);

                // example:
        alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->showConfirmButton('Confirm', '#3085d6');


        $products = Auction_product::where('status', 2)->orderBy('created_at','desc')->paginate(12);

        $panjang = count($products);

        return view('jual-beli.lelang.index', compact('products','panjang'));
    }

   

    
    
}
