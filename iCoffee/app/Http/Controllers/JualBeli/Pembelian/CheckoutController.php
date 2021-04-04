<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Delivery_category;
use GuzzleHttp\Client;
use App\Helper\Helper;
use App\Shop_product;
use App\Orderdetail;
use App\Delivery;
use App\Account;
use App\Address;
use App\Jbcart;
use App\Order;
use Validator;
use App\User;


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

        session(['cart_id' => $request->id]);

        return $this->bootIndex($request->id);
    }

    protected function bootIndex($id)
    {
        
        $id_customer = Auth::user()->id;

        // make link session
        $links = session()->has('links') ? session('links') : [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session
        
        $alamat_cadangan = Address::where('id_pelanggan', $id_customer)->whereIn('status', [0,1])->get();

        //check address
        if($alamat_cadangan->isEmpty()) {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/tambahalamat');  
        }

        //check active address
        $alamat = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();

        if (empty($alamat)) {
            Alert::info('Tentukan Alamat Utama')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/edit#pills-contact'); 
        }

        $getProductData = Jbcart::whereIn('id', $id)->get();

        foreach ($getProductData as $data) 
        {
            if ($data->shop_product->stok <= 0 ) {
                Alert::warning('Gagal','Stok sedang tidak tersedia')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        }
    
        foreach ($getProductData as $data) 
        {
            if ($data->shop_product->stok < $data->jumlah ) {
                Alert::warning('Gagal','Stok produk tidak mencukupi, sisa stok produk '. $data->shop_product->nama_produk . ' adalah '. $data->shop_product->stok)->showConfirmButton('Ok', '#3085d6');
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

        $pengirimCity =  array();
        $pengirimSubdistrict = array();

        for ($i=0; $i < $hitung_jumlah_alamat_penjual ; $i++) 
        { 
            if (!(in_array($alamat_penjual[$i]->kecamatan, $pengirimSubdistrict))) {
                $pengirimSubdistrict[] = $alamat_penjual[$i]->kecamatan;
                $pengirimCity[] = $alamat_penjual[$i]->kota_kabupaten;
                
            }
        }
        

        $penerimaSubdistrict = $alamat->kecamatan;
        $penerimaCity = $alamat->kota_kabupaten;

        session(['kecamatan_alamat_penjual' => $pengirimSubdistrict]);
        session(['kota_alamat_penjual' => $pengirimCity]);
        session(['kecamatan_penerima' => $penerimaSubdistrict]);
        session(['kota_penerima' => $penerimaCity]);
        session(['berat' => $berat]);


        $costjne = array();
        $costtiki = array();
        $costjnt = array();
        $costninja = array();
        $costlion = array();

        
        for ($i=0; $i < $jumlah_penjual ; $i++) { 

            //jne
            $array = array(

                "origin" => $pengirimCity[$i],
                "destination" => $penerimaCity,
                "weight" => $berat[$i],
                "courier" => "jne",
            );
            $costjne[] = Helper::instance()->cekOngkirByCity($array);
        
            //tiki

            $array = array(
                "origin" => $pengirimSubdistrict[$i],
                "destination" => $penerimaSubdistrict,
                "weight" => $berat[$i],
                "courier" => "tiki",
            );
            
            $costtiki[] = Helper::instance()->cekOngkir($array);
           
            
            //J&T

            $array = array(
                "origin" => $pengirimCity[$i],
                "destination" => $penerimaSubdistrict,
                "weight" => $berat[$i],
                "courier" => "jnt",
            );
            $costjnt[] = Helper::instance()->cekOngkirMix($array);
            

            //Ninja

            $array = array(
                "origin" => $pengirimSubdistrict[$i],
                "destination" => $penerimaSubdistrict,
                "weight" => $berat[$i],
                "courier" => "ninja",
            );

            $costninja[] = Helper::instance()->cekOngkir($array);

            
            $array = array(
                "origin" => $pengirimCity[$i],
                "destination" => $penerimaCity,
                "weight" => $berat[$i],
                "courier" => "lion",
            );
            $costlion[] = Helper::instance()->cekOngkirByCity($array);

        }


        return view('jual-beli.checkout', compact(
            'getProductData',
            'jumlah_penjual',
            'jumlah_seluruh',
            'alamat',
            'jumlah',
            'penjual',
            'costjne',
            'costjnt',
            'costninja',
            'checkout_data',
            'costtiki',
            'costlion',
            'jumlah_data_checkout'));


    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'kurir' => 'required',
            'bank' => 'required'
        ]);

        if(!(Account::where('bank_name', $request->bank)->first())) {
            Alert::error('Gagal', 'Bank tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/checkout');
        }

        $id_customer = Auth::user()->id;
        $hitung = count(collect($request)->get('id_toko'));
        $jumlah_keranjang = count(collect($request)->get('id_keranjang'));

        for ($i=0; $i < $hitung ; $i++)
        {
            $id_produks[] = $request->id_produk[$i];
        }    

        for ($i=0; $i < $hitung ; $i++) { 
            $split[] = explode(': ', $request->kurir[$i]);
        }

        for ($i=0; $i < $hitung ; $i++) { 
            $kategori_pengiriman[] = Delivery_category::where('nama_pengiriman', $split[$i][1])->first();
        }
        // $alamat = Address::where('id', $request->id_alamat)->where('status', 1)->first();
        // dd($request);
        $timestamps = date('YmdHis');
        $invoice = $timestamps.$id_customer;

        for ($i=0; $i < $hitung ; $i++) { 
            $totalbayar[] = $request->total_bayar[$i]+$split[$i][0];
        }

        for ($i=0; $i < $jumlah_keranjang ; $i++) { 
            $flight = Jbcart::where('id', $request->id_keranjang[$i])->first();
            $flight->delete();
        }


        for ($i=0; $i < $hitung ; $i++) { 

            $order[] = Order::create([
                        'id_pelanggan' => $id_customer,
                        'id_alamat' => $request->id_alamat,
                        'nama' => $request->nama_alamat,
                        'invoice' => $invoice,
                        'status' => '1',
                        'payment' => $request->bank,
                        'shipping' => $request->kurir[$i],
                        'pesan' => $request->pesan[$i],
                        'total_bayar' =>$request->total_bayar[$i],
                        'id_penjual' => $request->id_toko[$i]
    
            ]);      

        }

        for ($i=0; $i < $hitung ; $i++) { 
            $id[] = $order[$i]->id;
        }

        for ($i=0; $i < $hitung ; $i++) { 
            for ($j=0; $j < count($request->id_penjual[$i]) ; $j++) { 
                $alamat_penjual[$i][] = Address::where('id_pelanggan', $request->id_penjual[$i][$j])->where('status', 1)->first();
            }
        }

        for ($i=0; $i < $hitung ; $i++) { 
            for ($j=0; $j < count($request->id_penjual[$i]) ; $j++) { 

                $orderdetail[$i][] = Orderdetail::create([
                                'id_pelanggan' => $id_customer,
                                'id_penjual' => $request->id_penjual[$i][$j],
                                'id_order' => $id[$i],
                                'id_produk' => $request->id_produk[$i][$j],
                                'nama_produk' =>$request->nama_produk[$i][$j],
                                'invoice' => $invoice,
                                'jumlah' => $request->jumlah[$i][$j],
                                'harga' => $request->harga[$i][$j],
                                'total' => $request->total[$i][$j],
                                'kode_produk' =>  $request->total[$i][$j],
                                'gambar' => $request->gambar[$i][$j],
                                'id_alamat_penjual' => $alamat_penjual[$i][$j]->id
        
                    
                ]);
                $ids[$i][] = $orderdetail[$i][$j]->id;
            }

        }

        session()->forget('cart_id');
        for ($i=0; $i < $hitung ; $i++) {

            Delivery::create([
                'ongkos_kirim' => $split[$i][0],
                'id_order' => $id[$i],
                'nama' => $request->kurir[$i],
                'invoice' =>  '',
                'id_kategori_kurir' => $kategori_pengiriman[$i]->id
      
            ]);

        }
        
        return redirect('/jual-beli/invoice/'.$invoice);
        
        
    }

    public function checkId()
    {
        if(session()->has('cart_id')) {

            return $this->bootIndex(session()->get('cart_id'));
        }
        return redirect('/jual-beli/keranjang');
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
