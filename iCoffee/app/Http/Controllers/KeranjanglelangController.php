<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Auction_product;
use App\Auction_process;
use App\Auction_winner;
use App\Auction_image;

class KeranjanglelangController extends Controller
{
    public function keranjang()
    {

        $id_customer = Auth::user()->id;
        $keranjang = Auction_winner::where('id_pemenang', $id_customer)->where('status', 1)->orderBy('created_at','desc')->get();
        $carttotal = $keranjang->count();

        $subtotal = $keranjang->sum('jumlah_penawaran');
        

        return view('jual-beli.lelang.keranjang', compact('keranjang','subtotal','carttotal'));
    }

}
