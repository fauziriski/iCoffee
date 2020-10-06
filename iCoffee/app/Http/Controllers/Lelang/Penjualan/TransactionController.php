<?php

namespace App\Http\Controllers\Lelang\Penjualan;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Auction_Order;
use App\Auction_process;
use App\Auction_product;
use App\User;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $myOrder = Auction_Order::where('id_penjual', $user_id)->orderBy('created_at','desc')->paginate(5);
        return view('jual-beli.lelang.sellHistory', compact('myOrder'));
    }
}
