<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\User;
use App\Shop_product;
use App\Image;
use App\JbCart;
use App\Address;
use App\Delivery;
use App\Order;
use App\Orderdetail;
use App\Account;
use DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class KeranjangjbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function keranjang()
    {

        $id_customer = Auth::user()->id;
        $keranjang = JbCart::where('id_pelanggan', $id_customer)->orderBy('created_at','desc')->get();
        $subtotal = $keranjang->sum('total');
        $carttotal = $keranjang->count();

        return view('jual-beli.keranjang', compact('keranjang','subtotal','carttotal'));
    }

    public function tambahkeranjang(Request $request)
    {
        $id_customer = Auth::user()->id;

        $total = $request->harga*$request->quantity;

        $keranjang = JbCart::create([
            'id_pelanggan' => $id_customer,
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->quantity,
            'harga' => $request->harga,
            'kode_produk' => $request->kode_produk,
            'total' => $total,
            'image' => $request->gambar

        ]);

        $keranjang = JbCart::where('id_pelanggan', $id_customer)->get();


        return redirect('/jual-beli/keranjang');
    }

    public function checkout()
    {
        return view('jual-beli.checkout');
    }

    public function checkoutbarang(Request $request)
    {
        $this->validate($request,[

            'id' => 'required'
        ]);

        $id_customer = Auth::user()->id;
        $alamat = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();
        
        $id = $request->id;

        $checkout = JbCart::whereIn('id', $request->id)->get();
        
        
        foreach ($checkout as $data) {

            
            $produk[] = Shop_product::find($data->id_produk);
            
        }

        foreach ($produk as $data) {

            $alamat_penjual[] = Address::where('id_pelanggan', $data->id_pelanggan)
                                        ->where('status', 1)->first();
            
        }

        $berat = $checkout->sum('jumlah')*1000;
        $jumlah = $checkout->sum('total');

        $pengirim = $alamat_penjual[0]->kota_kabupaten;
        $penerima = $alamat->kota_kabupaten;

        // $delivery = Delivery::Where(function($x) {
        //         $x->where('asal', 'JAKARTA PUSAT')
        //           ->Where('tujuan', 'BANDAR LAMPUNG');
        //         })->orWhere(function($q) {
        //             $q->where('asal', 'BANDAR LAMPUNG')
        //               ->Where('tujuan', 'JAKARTA PUSAT');
        //             })->get();

        // $request->session()->keep([$alamat_penjual], [$alamat]);
        session(['alamat_penjual' => $pengirim]);
        session(['alamat' => $penerima]);
        session(['berat' => $berat]);
        

        //jne
        $costjne = RajaOngkir::ongkosKirim([
            'origin'        => $pengirim,     // ID kota/kabupaten asal
            'destination'   => $penerima,      // ID kota/kabupaten tujuan
            'weight'        => $berat,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        //tiki
        $costtiki = RajaOngkir::ongkosKirim([
            'origin'        => $pengirim,     // ID kota/kabupaten asal
            'destination'   => $penerima,      // ID kota/kabupaten tujuan
            'weight'        => $berat,    // berat barang dalam gram
            'courier'       => 'tiki'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        
        //pos
        $costpos = RajaOngkir::ongkosKirim([
            'origin'        => $pengirim,     // ID kota/kabupaten asal
            'destination'   => $penerima,      // ID kota/kabupaten tujuan
            'weight'        => $berat,    // berat barang dalam gram
            'courier'       => 'pos'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        // $kurir =  $costjne[0]['costs'][2]['cost'][0]['value'];
        // echo $kurir;

        // dd($costjne[0]["code"]);

        // for($i=0; $i<count($costjne[0]["costs"]); $i++)
        // {
        //     echo $costjne[0]["costs"][$i]["cost"][0]["value"];
        // }



        return view('jual-beli.checkout', compact('checkout','alamat','jumlah','costpos','costtiki','costjne'));


    }

    public function updatekeranjang(Request $request)
    {
        $cart = JbCart::where('id', $request->id)->first();
        $cart->update([
            'jumlah' => $request->quantity

        ]);

    }

    public function pesanbarang(Request $request)
    {
        $id_customer = Auth::user()->id;
        $hitung = count(collect($request)->get('id_produk'));
        for ($i=0; $i < $hitung ; $i++)
        {
        $id_produks[] = $request->id_produk[$i];
        }    

        $split = explode(': ', $request->kurir);

        // $alamat = Address::where('id', $request->id_alamat)->where('status', 1)->first();
        // dd($request);
        $timestamps = date('YmdHis');
        $invoice = $timestamps.$id_customer;
        $totalbayar = $request->total_bayar+$split[0];

        $order = Order::create([
            'id_pelanggan' => $id_customer,
            'id_alamat' => $request->id_alamat,
            'nama' => $request->nama_alamat,
            'invoice' => $invoice,
            'status' => '1',
            'payment' => $request->bank,
            'shipping' => $request->kurir,
            'pesan' => $request->pesan,
            'total_bayar' =>$totalbayar

        ]);

        $id = $order->id;

        
        for ($i=0; $i < $hitung ; $i++)
        {
            $id_penjual = Shop_product::whereIn('id',$id_produks)->get();
        }

        

        for ($i=0; $i < $hitung ; $i++)
        {
            $alamat_penjual = Address::where('id_pelanggan', $id_penjual[$i]->id_pelanggan)->get();
        }

        for ($i=0; $i < $hitung ; $i++) {

            $orderdetail = Orderdetail::create([
                'id_pelanggan' => $id_customer,
                'id_penjual' => $id_penjual[$i]->id_pelanggan,
                'id_order' => $id,
                'id_produk' => $request->id_produk[$i],
                'nama_produk' =>$request->nama_produk[$i],
                'invoice' => $invoice,
                'jumlah' => $request->jumlah[$i],
                'harga' => $request->harga[$i],
                'total' => $request->total[$i],
                'kode_produk' => $id_penjual[$i]->kode_produk,
                'gambar' => $id_penjual[$i]->gambar,
                'id_alamat_penjual' => $alamat_penjual[$i]->id
    
                
            ]);
            
            $ids[] = $orderdetail->id;


        }

        $ongkir = $split[0];


        for ($i=0; $i < $hitung ; $i++) {

            Delivery::create([
                'ongkos_kirim' => $ongkir,
                'id_orderdetails' => $ids[$i],
                'nama' => $request->kurir,
                'invoice' =>  ''
      
            ]);

        }
        
        return redirect('/jual-beli/invoice/'.$invoice);
        
        
    }

    public function invoice($invoice)
    {
        $id_pembeli = Auth::user()->id;
        $order = Order::where('invoice', $invoice)->first();
        $orderdetail = Orderdetail::where('invoice', $invoice)->get();
        
        $hitung = $orderdetail->count();
        
        $datas = array();
   
        
        for ($i=0; $i < $hitung ; $i++) {
            
            if (!(in_array($orderdetail[$i]->id_penjual, $datas))) {
                $datas[] = $orderdetail[$i]->id_penjual;
                $id_penjual[] = $orderdetail[$i]->id_penjual;
            }

        }

        
        $jumlah_pelanggan = count($id_penjual);

        for ($i=0; $i < $jumlah_pelanggan ; $i++) {
            $orderdetailcek = Orderdetail::where('invoice', $invoice)->where('id_penjual',$id_penjual[$i])->get();
            $jumlahorder =  $orderdetailcek->count();
            for ($j=0; $j < $jumlahorder ; $j++) { 
                $orderdetaildata[$i] = Orderdetail::where('invoice', $invoice)->where('id_penjual',$id_penjual[$i])->get();
            }
        }

        dd($orderdetaildata[0][1]->id);
        

        for ($i=0; $i < $jumlah_pelanggan; $i++) { 
            
            $alamat_penjual[] = Address::where('id_pelanggan', $id_penjual[$i])->get();
        }
  
        $alamat_pembeli = Address::where('id', $order->id_alamat)->first();
        $rekening = Account::where('bank_name', $order->payment)->first();

        return view('jual-beli.invoice', compact('order', 'orderdetail', 'alamat_penjual', 'alamat_pembeli', 'id_penjual', 'jumlah_pelanggan', 'rekening'));
    }

    

    public function hapus($id)
    {
        $flight = JbCart::find($id);

        $flight->delete();

        return redirect('/jual-beli/keranjang');

    }

    public function cekongkir($kurir)
    {
        $client = new Client();

        $alamat_penjual = $request->session()->get('alamat_penjual');
        $alamat = $request->session()->get('alamat');
        $berat = $request->session()->get('berat');


        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin='.$alamat_penjual.'&destination='.$alamat.'&weight='.$request->berat.'&courier=tiki',
                    'headers' => [
                        'key' => '173f863cc1b39ff155f1d8058cebc703',
                        'content-type' => 'application/x-www-form-urlencoded',
                        
                    ]
                ]
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();


        $array_result = json_decode($json, true);

        $myJSON = json_encode($array_result);

        echo $myJSON;

        // return response()->json($array_result);

    }
    
}
