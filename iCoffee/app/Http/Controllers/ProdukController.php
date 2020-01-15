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

        
        for ($i=1; $i < $size ; $i++) {
            Image::create([
                'id_pelanggan' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $oldMarker

            ]);
        }

        return redirect('/jual-beli');
    }


    public function index()
    {
        // $id_customer = Auth::id();
        
        $products = Shop_product::orderBy('created_at','desc')->paginate(12);
    
        return view('jual-beli.index',compact('products'));
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
