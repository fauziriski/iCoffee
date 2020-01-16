<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProdukInvestasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $timestamps = date('YmdHis');
        $id_mitra = Auth::id();
        $oldMarker = $timestamps.$id_mitra;

        $size = count(collect($request)->get('gambar'));

        $this->validate($request,[
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $folderPath = public_path("Uploads\Investasi\Produk\{$oldMarker}");
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
    }
}
