<?php

namespace App\Http\Controllers\Lelang\Pembelian;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Auction_Order;
use App\Category;
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
        $listAuction = Auction_Order::where('id_pembeli', $user_id)->orderBy('created_at','desc')->paginate(5);
        return view('jual-beli.lelang.buyHistory', compact('listAuction'));
    }
}
