<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Invest_product;
use App\Invest_product_image;

class ProdukInvestasiController extends Controller
{

    public function produkInvestasi()
    {
        return view('investasi.produk');
    }

    public function pasangInvestasi()
    {
        return view('investasi.pasang');
    }

    public function store(Request $request)
    {
        
        $id_mitra = Auth::id();
        $timestamps = date('YmdHis');
        $code = $timestamps.$id_mitra;
        $size = count(collect($request)->get('gambar'));

        $this->validate($request,[
            'gambar' => 'required'
        ]);

        $folderPath = public_path("Uploads\Investasi\Produk\{$id_mitra}\{$code}");
        $response = mkdir($folderPath);
        $nama = array();
        
        if($files = $request->file('gambar')){
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

        $product = Invest_product::create([
            'id_mitra' => $id_mitra,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $request->detail_produk,
            'gambar' => $nama[0],
            'harga' => $request->harga,
            'stok' => $request->stok,
            'roi' => $request->roi,
            'periode' => $request->periode,
            'profit_periode' => $request->profit_periode,
            'kode_produk' => $code
            
        ]);

        $id = $product->id;
        
        for ($i=1; $i < $size ; $i++) {
            Invest_product_image::create([
                'id_mitra' => $id_mitra,
                'id_produk' => $id,
                'nama' => $nama[$i],
                'kode_produk' => $code

            ]);
        }

        return redirect('/investasi');
    }

    public function index(){
        $products = Invest_product::orderBy('created_at','desc')->paginate(12);
    
        return view('investasi.index',compact('products'));
    }

    public function detail($id)
    {
        $products = Invest_product::find($id);
        $produk_terkait = Invest_product::where('id_kategori', $products->id_kategori)->take(4)->get();
        $image = Invest_product_image::where('id_produk', $products->id)->get();
    
        return view('investasi.detailproduk',compact('products','image','produk_terkait'));
    }
}
