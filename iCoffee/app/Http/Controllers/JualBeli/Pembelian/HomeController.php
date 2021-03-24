<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop_product;
use App\Category;
use App\Image;
use App\Address;
use App\Rating;
use App\Order;
use App\Orderdetail;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = Shop_product::orderBy('created_at','desc')->where('status', 1)->paginate(12);
        $category = Category::all();
    
        return view('jual-beli.index',compact('products', 'category'));
    }

    public function category($id)
    {
        $products = Shop_product::where('id_kategori', $id)->orderBy('created_at','desc')->where('status', 1)->paginate(12);
        $category = Category::all();

        if ($products) {
            return view('jual-beli.index',compact('products', 'category'));
        }
        else {
            Alert::error('Kategori Tidak Ditemukan');
        }
        
    }

    public function search(Request $request)
    {
        $validateData = $this->validate($request, [
            'search' =>'required|string',
        ]);

        $products = DB::table('shop_products')
                ->where('nama_produk', 'like', '%'.$request->search.'%')
                ->where('status', '=', 1)
                ->paginate(12);

        $category = Category::all();

        if ($products) {
            return view('jual-beli.index',compact('products', 'category'));
        }
        else {
            return back();
            Alert::error('Gagal','Kopi Tidak Ditemukan');
        }
        
    }
    
    public function detail(string $slug)
    {
          
        // $products = Shop_product::find($slug);
        $products = Shop_product::where(['slug'=> $slug])->get()->first();
        $id = $products->id;
        if (!$products) {
            Alert::error('Produk Tidak Ditemukan');
        }


        $produk_terkait = Shop_product::where('id_kategori', $products->id_kategori)->where('status', 1)->where('id', '!=', $id)->take(4)->get();
        

        if($produk_terkait->isEmpty()){
            $produk_terkait = Shop_product::where('id', '!=', $id)->orderBy('created_at','desc')->where('status', 1)->take(4)->get();
        }
        $image = Image::where('id_produk', $products->id)->get();
        $alamat =  Address::where('id_pelanggan', $products->id_pelanggan)->whereIn('status', [0,1])->first();

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
        $cek_data_rating = array();
        for ($i=0; $i < $cek_jumlah_data_rating; $i++)
        {
            if(!($cek_rating_toko[$i]->rating == 0))
            {
                $cek_data_rating[] = $cek_rating_toko[$i]->rating;
                $cek_data[] = Orderdetail::where('invoice', $cek_rating_toko[$i]->invoice)->get();
                $jumlah_data += 1;


            }
           
        }

        if ($jumlah_data > 0) {
           
        $sum = array_sum($cek_data_rating);
        $rating_toko = round($sum/$jumlah_data,1);;
        // foreach ($cek_data_rating as $data) {
        //     $count+= count($data);
        // }

        }
        $count = $jumlah_data;

        
        return view('jual-beli.detailproduk',compact(
            'products','image','produk_terkait', 'alamat', 'jumlah_terjual_produk', 'rating_toko', 'jumlah_data','count'
        ));
    }
}
