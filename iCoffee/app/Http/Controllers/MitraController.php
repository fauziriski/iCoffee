<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invest_product;
use App\invest_order;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
use App\User;

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
        $dana = invest_order::where('status',2)->where('id_produk',$produk->id)->get();
        $total = 0;
        $qty = 0;
        for($i=0;$i<count($dana);$i++){
            $total += $dana[$i]->total;
            $qty += $dana[$i]->qty;
            $nama[] = User::where('id', $dana[$i]->id_investor)->first();
        }
        $investor = invest_order::where('id_produk',$produk->id)->where('status',2)->distinct()->count('id_investor');

        return view('investasi.mitra.detail')->with('produk',$produk)->with('total',$total)->with('investor',$investor)->with('qty',$qty)->with(compact('dana'))->with(compact('nama'));
    }


    public function rekeningMitra()
    {
        return view('investasi.mitra.rekening');
    }
    public function nyoba(Request $request)
    {
        dd($request->file('gambar'));
    }
    public function test()
    {
        return view('investasi.nyoba');
    }
}
