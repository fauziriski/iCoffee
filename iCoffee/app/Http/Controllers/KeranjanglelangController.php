<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\User;
use App\Auction_product;
use App\Auction_process;
use App\Auction_winner;
use App\Auction_image;
use App\Account;
use App\Joint_account;
use App\Complaint;
use App\Address;
use App\Delivery;
use App\Delivery_category;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class KeranjanglelangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function keranjang()
    {

        $id_customer = Auth::user()->id;
        $keranjang = Auction_winner::where('id_pemenang', $id_customer)->where('status', 1)->orderBy('created_at','desc')->get();
        $carttotal = $keranjang->count();

        $subtotal = $keranjang->sum('jumlah_penawaran');
        

        return view('jual-beli.lelang.keranjang', compact('keranjang','subtotal','carttotal'));
    }

    public function checkout()
    {
        return view('jual-beli.lelang.checkout');
    }

    public function checkoutbarang(Request $request)
    {
        $this->validate($request,[

            'id' => 'required'
        ]);
        $id_customer = Auth::user()->id;

        $id = $request->id;

        $checkout = Auction_winner::where('id', $id)->first();

        $berat_g = $checkout->auction_product->stok;
        $berat_kg = $berat_g*1000;

        
        $alamat_pembeli = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();
        $alamat_penjual = Address::where('id_pelanggan', $checkout->id_pelelang)->where('status', 1)->first();
        
        $costjne = RajaOngkir::ongkosKirim([
            'origin'        => $alamat_penjual->kota_kabupaten,     // ID kota/kabupaten asal
            'destination'   => $alamat_pembeli->kota_kabupaten,      // ID kota/kabupaten tujuan
            'weight'        => $berat_kg,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        $costtiki = RajaOngkir::ongkosKirim([
            'origin'        => $alamat_penjual->kota_kabupaten,     // ID kota/kabupaten asal
            'destination'   => $alamat_pembeli->kota_kabupaten,      // ID kota/kabupaten tujuan
            'weight'        => $berat_kg,    // berat barang dalam gram
            'courier'       => 'tiki'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        $costpos = RajaOngkir::ongkosKirim([
            'origin'        => $alamat_penjual->kota_kabupaten,     // ID kota/kabupaten asal
            'destination'   => $alamat_pembeli->kota_kabupaten,      // ID kota/kabupaten tujuan
            'weight'        => $berat_kg,    // berat barang dalam gram
            'courier'       => 'pos'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return view('jual-beli.lelang.checkout', compact('checkout','alamat_pembeli', 'costjne', 'costtiki', 'costpos'));
        
    }

    


}
