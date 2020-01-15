<?php

namespace App\Http\Controllers;

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
}
