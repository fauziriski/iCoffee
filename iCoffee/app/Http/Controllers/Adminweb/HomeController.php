<?php

namespace App\Http\Controllers\Adminweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon;
use App\Invest_product;
use App\Shop_product;
use App\Auction_product;
use DB;


use App\Transaction;

class HomeController extends Controller
{
    public function index(){

    $produk_jb = count(Shop_product::All());
    $produk_lelang = count(Auction_product::where('status',"2")->get());
    $produk_invest = count(Invest_product::where('status',"2")->get());   

    $kategori = array('Jual-Beli', 'Lelang', 'Investasi');
    $data  = array($produk_jb,$produk_lelang,$produk_invest);
    
    return view('admin.admin-web.beranda',['kategori' => $kategori, 'Data' => $data]);

    }

     public function validasiPembeli(){
    	return view('admin.validasi-pembeli');
    }
}
