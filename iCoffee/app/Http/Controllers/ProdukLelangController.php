<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukLelangController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
       public function pasangLelang()
    {
        return view('jual-beli.lelang.pasang');
    }


}
