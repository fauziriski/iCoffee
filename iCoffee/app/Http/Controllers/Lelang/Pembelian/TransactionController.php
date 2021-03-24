<?php

namespace App\Http\Controllers\Lelang\Pembelian;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Auction_Order;
use App\Address;
use App\Category;
use App\User;
use File;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProvinceData()
    {
        // $files = File::files(public_path());
        $cek_alamat = Address::where('id_pelanggan', 6)->where('status', 1)->first();
        $alamat_pembeli = Address::where('id_pelanggan', 7)->where('status', 1)->first();
        $berat_kg = 1000;
        $costjne = array();
        
        $array = array(
            "origin" => $cek_alamat->kota_kabupaten,
            "destination" => $alamat_pembeli->kota_kabupaten,
            "weight" => $berat_kg,
            "courier" => "jne",
        );
        $costjnt = Helper::instance()->cekOngkirByCity($array);
        dd($costjnt);

        $subdistric = Helper::instance()->getcity();
        dd($subdistric);
        // $path = public_path() . "/country-calling-codes.min.json";
        // $str = File::get($path);
        // $datas = $array_result = json_decode($str, true);
        //     $data = Helper::instance()->dialCode($datas);
        //     dd($data);

        return response()->json($data);
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $listAuction = Auction_Order::where('id_pembeli', $user_id)->orderBy('created_at','desc')->paginate(5);
        return view('jual-beli.lelang.buyHistory', compact('listAuction'));
    }
}
