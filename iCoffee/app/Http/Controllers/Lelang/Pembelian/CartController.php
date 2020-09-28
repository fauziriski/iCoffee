<?php

namespace App\Http\Controllers\Lelang\Pembelian;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auction_winner;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $id_customer = Auth::user()->id;
        $keranjang = Auction_winner::where('id_pemenang', $id_customer)->where('status', 1)->orderBy('created_at','desc')->get();
        $carttotal = $keranjang->count();
        $subtotal = $keranjang->sum('jumlah_penawaran');

        return view('jual-beli.lelang.keranjang', compact('keranjang','subtotal','carttotal'));
    }
}
