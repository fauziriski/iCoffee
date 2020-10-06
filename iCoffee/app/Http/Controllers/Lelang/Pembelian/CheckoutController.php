<?php

namespace App\Http\Controllers\Lelang\Pembelian;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Delivery_category;
use App\Auction_delivery;
use App\Auction_winner;
use App\Helper\Helper;
use App\Auction_Order;
use Carbon\Carbon;
use App\Address;
use App\Account;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->validate($request,[

            'id' => 'required'
        ]);

        session(['cart_auctionId' => $request->id]);
        return $this->bootIndex($request->id);
    }

    protected function bootindex($id)
    {

        $id_customer = Auth::user()->id;

        $cek_alamat_tersedia = Address::where('id_pelanggan', $id_customer)->get();

        if (empty($cek_alamat_tersedia)) {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/tambahalamat');
        }

        $cek_alamat = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();

        if (empty($cek_alamat)) {
            Alert::info('Tentukan Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/edit#pills-contact');
        }

        $checkout = Auction_winner::where('id', $id)->first();

        $berat_g = $checkout->auction_product->stok;
        $berat_kg = $berat_g*1000;

        
        $alamat_pembeli = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();
        $alamat_penjual = Address::where('id_pelanggan', $checkout->id_pelelang)->where('status', 1)->first();

        $array = array(
            "origin" => $alamat_penjual->kota_kabupaten,
            "destination" => $alamat_pembeli->kota_kabupaten,
            "weight" => $berat_kg,
            "courier" => "jne",
        );

        $costjne = Helper::instance()->cekOngkir($array);

        $array = array(
            "origin" => $alamat_penjual->kota_kabupaten,
            "destination" => $alamat_pembeli->kota_kabupaten,
            "weight" => $berat_kg,
            "courier" => "tiki",
        );

        $costtiki = Helper::instance()->cekOngkir($array);

        $array = array(
            "origin" => $alamat_penjual->kota_kabupaten,
            "destination" => $alamat_pembeli->kota_kabupaten,
            "weight" => $berat_kg,
            "courier" => "pos",
        );

        $costpos = Helper::instance()->cekOngkir($array);


        return view('jual-beli.lelang.checkout', compact('checkout','alamat_pembeli', 'alamat_penjual', 'costjne', 'costtiki', 'costpos'));
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'kurir' => 'required',
            'bank' => 'required'
        ]);

        if(!(Account::where('bank_name', $request->bank)->first())) {
            Alert::error('Gagal', 'Bank tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
            return redirect('/lelang/checkout-barang');
        }

        $id_pelanggan = Auth::user()->id;
        $timestamps = date('YmdHis');
        $kurir = explode(': ', $request->kurir);
        $total_bayar = $kurir[0]+$request->total_bayar;
        $oldMarker = $timestamps.$id_pelanggan;
        

        $order = Auction_Order::create([
            'id_penjual' => $request->id_penjual,
            'id_pembeli'=> $id_pelanggan,
            'id_alamat_penjual'=> $request->id_alamat_penjual,
            'id_alamat_pembeli'=> $request->id_alamat_pembeli,
            'nama'=> $request->nama_alamat,
            'invoice'=> $oldMarker,
            'payment'=> $request->bank,
            'shipping'=> $request->kurir, 
            'pesan'=> $request->pesan,
            'jumlah' => $request->jumlah,
            'tawaran_awal' => $request->harga_awal, 
            'sub_total'=> $request->jumlah_penawaran, 
            'total_bayar'=> $total_bayar, 
            'status'=> '1',
            'id_produk'=> $request->id_produk

        ]);

        $kategori_pengiriman = Delivery_category::where('nama_pengiriman', $kurir[1])->first();

        $auction_delivery = Auction_delivery::create([
            'id_order' => $order->id, 
            'id_kategori_kurir' => $kategori_pengiriman->id , 
            'nama' => $request->nama_alamat, 
            'ongkos_kirim' => $kurir[0],
            'invoice' => ''
        ]);

        $auction_winner = Auction_winner::where('id', $request->id_keranjang)->first();

        $auction_winner->update([
            'status' => '2'
        ]);

        return redirect('/lelang/invoice/'.$oldMarker);
        
    }

    public function checkId()
    {
        if(session()->has('cart_auctionId')) {
            return $this->bootIndex(session()->get('cart_auctionId'));
        }
        
        return redirect('/lelang/keranjang');
    }

}
