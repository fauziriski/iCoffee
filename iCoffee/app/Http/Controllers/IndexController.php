<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Invest_product;
use App\Shop_product;
use App\Auction_product;
use App\Confirm_payment;
use App\Mitra;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
    $produk_jb = count(Shop_product::All());
    $produk_lelang = count(Auction_product::where('status',"2")->get());
    $produk_invest = count(Invest_product::where('status',"2")->get());
    $produk_lelang = count(Auction_product::where('status',"2")->get());

    $tranksaksi = Confirm_payment::where('status',"3")->sum('jumlah_transfer');
    $mitra = count(Mitra::All());
    $produk = $produk_jb+$produk_lelang+$produk_invest;
    $pengguna = count(User::All()); 
       
    return view('/index')->with('pengguna',$pengguna)->with('produk',$produk)->with('tranksaksi',$tranksaksi)->with('mitra',$mitra);
    }
}
