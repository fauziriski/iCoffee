<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Shop_product;
use App\Address;
use App\Jbcart;
use App\User;
use App\Helper\Helper;

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

        $id_customer = Auth::user()->id;

        // make link session
        $links = session()->has('links') ? session('links') : [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session
        
        
        
        $alamat_cadangan = Address::where('id_pelanggan', $id_customer)->whereIn('status', [0,1])->get();

        //check address
        if($alamat_cadangan->isEmpty())
        {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/tambahalamat');  
        }

        //check active address
        $alamat = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();

        if (empty($alamat)) {
            Alert::info('Tentukan Alamat Utama')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/edit#pills-contact'); 
        }

        $getProductData = Jbcart::whereIn('id', $request->id)->get();

        foreach ($getProductData as $data) 
        {
            if ($data->shop_product->stok <= 0 ) {
                Alert::warning('Gagal','Stok sedang tidak tersedia')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        }
    
        foreach ($getProductData as $data) 
        {
            if ($data->shop_product->stok <= $data->jumlah ) {
                Alert::warning('Gagal','Stok produk tidak mencukupi')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        }
        

        foreach ($getProductData as $data) 
        {
            if($data->jumlah <= 0){
                Alert::error('Gagal','Jumlah Tidak Boleh Kurang Dari Satu')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        }

        foreach ($getProductData as $data) 
        {
            $produk[] = Shop_product::find($data->id_produk);
        }
        

        foreach ($produk as $data) 
        {
            $alamat_penjual[] = Address::where('id_pelanggan', $data->id_pelanggan)
                                        ->where('status', 1)->first();
        }
    
        $hitung_jumlah_alamat_penjual = count($alamat_penjual);
        
        $datas = array();
        $berat = array();
        $jumlah = array();

        //count address seller
        for ($i=0; $i < $hitung_jumlah_alamat_penjual ; $i++) 
        { 
            if (!(in_array($getProductData[$i]->id_penjual, $datas))) {
                $datas[] = $getProductData[$i]->id_penjual;
                
            }
        }

        $jumlah_penjual = count($datas);

        //grouping product by seller
        for ($i=0; $i < $jumlah_penjual  ; $i++) { 
            $data_coba_checkout = $datas[$i];
            $data_checkout = array();
            $hitungdatacheckout = array();
            for ($j=0; $j < $hitung_jumlah_alamat_penjual ; $j++) { 
                if ( $getProductData[$j]->id_penjual == $data_coba_checkout) {
                    $data_checkout[] = $getProductData[$j];
                    $hitungdatacheckout[] += 1;

                }   
            }
            $jumlah_data = count($hitungdatacheckout);
            $jumlah_data_checkout[] = $jumlah_data;
            $checkout_data[] = $data_checkout;
            
        }

        for ($i=0; $i < $jumlah_penjual; $i++) { 
            $penjual[] = User::where('id', $datas[$i])->first();
        }

        for ($i=0; $i < $jumlah_penjual  ; $i++) { 
            $data_coba = $datas[$i];
            $data_jumlah_checkout = 0;
            $data_total_checkout = 0;
            for ($j=0; $j < $hitung_jumlah_alamat_penjual ; $j++) { 
                if ( $getProductData[$j]->id_penjual == $data_coba) {
                    $data_jumlah_checkout += $getProductData[$j]->jumlah*1000;
                    $data_total_checkout += $getProductData[$j]->total;
                }   
            }
            $berat[] = $data_jumlah_checkout;
            $jumlah[] = $data_total_checkout;
            
        }

        
        $jumlah_seluruh = array_sum($jumlah);

        $pengirim =  array();

        for ($i=0; $i < $hitung_jumlah_alamat_penjual ; $i++) 
        { 
            if (!(in_array($alamat_penjual[$i]->kota_kabupaten, $pengirim))) {
                $pengirim[] = $alamat_penjual[$i]->kota_kabupaten;
                
            }
        }
        

        $penerima = $alamat->kota_kabupaten;

        session(['alamat_penjual' => $pengirim]);
        session(['alamat' => $penerima]);
        session(['berat' => $berat]);


        $costjne = array();
        $costtiki = array();
        $costpos = array();

        
        for ($i=0; $i < $jumlah_penjual ; $i++) { 

            //jne

            $array = array(
                "origin" => $pengirim[$i],
                "destination" => $penerima,
                "weight" => $berat[$i],
                "courier" => "jne",
            );
            $costjne[] = Helper::instance()->cekOngkir($array);
        
            //tiki

            $array = array(
                "origin" => $pengirim[$i],
                "destination" => $penerima,
                "weight" => $berat[$i],
                "courier" => "tiki",
            );
            $costtiki[] = Helper::instance()->cekOngkir($array);
            
            // //pos

            $array = array(
                "origin" => $pengirim[$i],
                "destination" => $penerima,
                "weight" => $berat[$i],
                "courier" => "pos",
            );
            $costpos[] = Helper::instance()->cekOngkir($array);

        }


        return view('jual-beli.checkout', compact('getProductData','jumlah_penjual','jumlah_seluruh','alamat','jumlah','penjual','costpos','checkout_data','costtiki','costjne','jumlah_data_checkout'));


    }

    public function checkFeeShip()
    {
            $costjne[] = RajaOngkir::ongkosKirim([
                'origin'        => $pengirim[$i],     // ID kota/kabupaten asal
                'destination'   => $penerima,      // ID kota/kabupaten tujuan
                'weight'        => $berat[$i],    // berat barang dalam gram
                'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();
    }
}
