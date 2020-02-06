<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invest_product;
use App\invest_order;
use Auth;
use Illuminate\Support\Str;

class MitraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:mitra');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = count(Invest_product::where('id_mitra',Auth::user()->id_mitra)->get());
        $dana = invest_order::where('id_mitra',Auth::user()->id_mitra)->where('status',2)->get('total');
        $investor = invest_order::where('id_mitra',Auth::user()->id_mitra)->where('status',2)->distinct()->count('id_investor');
        $total = 0;
        for($i=0;$i<count($dana);$i++){
            $total += $dana[$i]->total;
        }
        if(Str::contains(Auth::user()->id_mitra, 'KT')){
            $kode = Auth::user()->kode;
            $gambar = Auth::user()->gambar;
            $path = "Uploads\Kelompok_tani\{$kode}\{$gambar}";
        }elseif(Str::contains(Auth::user()->id_mitra, 'KP')){
            $kode = Auth::user()->kode;
            $gambar = Auth::user()->gambar;
            $path = "Uploads\Mitra_Koperasi\{$kode}\{$gambar}";
        }else{
            $kode = Auth::user()->kode;
            $gambar = Auth::user()->gambar;
            $path = "Uploads\Mitra_Perorangan\{$kode}\{$gambar}";
        }
        return view('investasi.mitra.index')->with('produk',$produk)->with('total',$total)->with('investor',$investor)->with('path',$path);
    }

    public function produkDetail($kode_produk)
    {
        $produk = Invest_product::where('kode_produk',$kode_produk)->first();
        return view('investasi.mitra.detail')->with('produk',$produk);
    }
}
