<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invest_product;
use App\invest_order;
use Auth;

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
        return view('investasi.mitra.index')->with('produk',$produk)->with('total',$total)->with('investor',$investor);
    }
}
