<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Shop_product;


class ProdukController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pasangjualbeli()
    {
        $id_pelanggan = Auth::id();

        $nama_pelanggan = User::where('name', $id_pelanggan)->get();
        return view('jual-beli.pasang',compact('id_pelanggan','nama_pelanggan'));
    }


    public function pasangproduk()
    {

    }
}
