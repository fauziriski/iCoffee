<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\Shop_product;
use App\Image;
use App\Address;
use App\Auction_product;
use App\Auction_process;
use App\Auction_image;
use App\Category;
use App\Rating;
use App\Order;
use App\Orderdetail;
use App\Auction_Order;
use DB;



class ProdukController extends Controller
{

    public function index()
    {
        // $id_customer = Auth::id();
        
        $products = Shop_product::orderBy('created_at','desc')->paginate(12);
        $category = Category::all();
    
        return view('jual-beli.index',compact('products', 'category'));
    }

    public function index_category($id)
    {
        $products = Shop_product::where('id_kategori', $id)->orderBy('created_at','desc')->paginate(12);
        $category = Category::all();

        return view('jual-beli.index',compact('products', 'category'));
    }

    public function detail($id)
    {

        
        $products = Shop_product::find($id);
        $produk_terkait = Shop_product::where('id_kategori', $products->id_kategori)->where('id', '!=', $id)->take(4)->get();
        if($produk_terkait->isEmpty()){
            $produk_terkait = Shop_product::where('id', '!=', $id)->orderBy('created_at','desc')->take(4)->get();
        }
        $image = Image::where('id_produk', $products->id)->get();
        $alamat =  Address::where('id_pelanggan', $products->id_pelanggan)->where('status', 1)->first();

        $cek_rating_toko = Rating::where('id_penjual', $products->id_pelanggan)->get();
        $cek_jumlah_data_rating = count($cek_rating_toko);


        $jumlah_terjual = Orderdetail::where('id_produk', $id)->get();
        $jumlah_data_terjual = $jumlah_terjual->count();
        $jumlah_terjual_produk = 0;
        for ($i=0; $i <$jumlah_data_terjual ; $i++) 
        { 
            $cek_status_order = Order::where('invoice', $jumlah_terjual[$i]->invoice)->first();
            if($cek_status_order->status == 3|| 4 || 5 || 6 || 7 || 10 || 11)
            {
                $jumlah_terjual_produk += $jumlah_terjual[$i]->jumlah;
            }

        }


        $jumlah_data = 0;
        $sum = 0;
        $rating_toko = 0;
        $cek_data = array();
        for ($i=0; $i < $cek_jumlah_data_rating; $i++)
        {
            if(!($cek_rating_toko[$i]->rating == 0))
            {
                $cek_data[] = Orderdetail::where('invoice', $cek_rating_toko[$i]->invoice)->get();
                $jumlah_data += 1;
                $sum = $cek_rating_toko[$i]->sum('rating');
                $rating_toko = $sum/$jumlah_data;

            }
        }
        $count = 0;
        foreach ($cek_data as $data) {
            $count+= count($data);
        }

        
        return view('jual-beli.detailproduk',compact('products','image','produk_terkait', 'alamat', 'jumlah_terjual_produk', 'rating_toko', 'jumlah_data','count'));
    }

    public function lelang() 
    {
        // alert()->html('<i>HTML</i> <u>example</u>',"
        //                 You can use <b>bold text</b>,
        //                 <a href='//github.com'>links</a>
        //                 and other HTML tags
        //                 ",'success')->autoClose(5000);

                // example:


        $category = Category::all();
        $products = Auction_product::where('status', 2)->orderBy('created_at','desc')->paginate(12);

        $panjang = count($products);

        return view('jual-beli.lelang.index', compact('products','panjang', 'category'));
    }

   


   

   

    
    
}
