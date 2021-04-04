<?php

namespace App\Http\Controllers\JualBeli\Penjualan;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Shop_product;
use App\Order;
use App\User;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexSell()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipenjual = Order::where('id_penjual', $id_pelanggan)->whereIn('status',[0,3,4,5,6,7,10,11])->orderBy('created_at','desc')->paginate(5);
        $jumlah_transaksi_penjual = count($transaksipenjual);
        $kurir_data = array();
        $total_bayar = array();
        for ($i=0; $i < $jumlah_transaksi_penjual ; $i++) { 
            $kurir_penjual = explode(': ',  $transaksipenjual[$i]->shipping);
            $kurir_data[] =  $kurir_penjual[0];
            $total_bayar[] =  $transaksipenjual[$i]->total_bayar+$kurir_penjual[0];
        }
        return view('jual-beli.sellHistory', compact('transaksipenjual', 'total_bayar'));
    }
}
