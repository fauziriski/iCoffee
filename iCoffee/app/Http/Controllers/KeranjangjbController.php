<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\User;
use App\Shop_product;
use App\Image;
use App\Jbcart;
use App\Address;
use App\Delivery;
use App\Delivery_category;
use App\Order;
use App\Orderdetail;
use App\Rating;
use App\Account;
use App\Joint_account;
use App\Complaint;
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
        $keranjang = Jbcart::where('id_pelanggan', $id_customer)->orderBy('created_at','desc')->get();
        $carttotal = count($keranjang);

        if ($carttotal == 0) {
            Alert::info('Kosong','Keranjang Anda Kosong')->showConfirmButton('Ok', '#3085d6');

            return redirect('/jual-beli');
            
        }
       

        $subtotal = $keranjang->sum('total');
        

        return view('jual-beli.keranjang', compact('keranjang','subtotal','carttotal'));
    }

    public function tambahkeranjang(Request $request)
    {

        if ($request->ketersedian == "Kosong") {
            Alert::warning('Stok Sedang Tidak Tersedia')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/produk/'.$request->id_produk);
        }
        $id_customer = Auth::user()->id;
        if ($request->id_penjual == $id_customer) {
            Alert::warning('Penjual Tidak Boleh Membeli Produk Milik Sendiri')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/produk/'.$request->id_produk);
        }
        

        $cek_keranjang = Jbcart::where('id_produk', $request->id_produk)->where('id_pelanggan', $id_customer)->first();

        if (!(empty($cek_keranjang))) {
            $jumlah = $request->quantity + $cek_keranjang->jumlah;
            $total = ($request->harga*$request->quantity)+$cek_keranjang->total;
            $cek_keranjang->update([
                'jumlah' => $jumlah,
                'total' => $total
            ]);
            Alert::success('Berhasil')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/keranjang');
        }

        $total = $request->harga*$request->quantity;

        $keranjang = Jbcart::create([
            'id_pelanggan' => $id_customer,
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->quantity,
            'harga' => $request->harga,
            'kode_produk' => $request->kode_produk,
            'total' => $total,
            'image' => $request->gambar,
            'id_penjual' => $request->id_penjual

        ]);
        Alert::success('Berhasil')->showConfirmButton('Ok', '#3085d6');
        return redirect('/jual-beli/keranjang');
    }

    public function tambahkeranjangindex($id)
    {
        $id_customer = Auth::user()->id;
        $produk = Shop_product::where('id', $id)->first();
        $cek_keranjang = Jbcart::where('id_produk', $id)->where('id_pelanggan', $id_customer)->first();

        if (!(empty($cek_keranjang))) {
            $jumlah = 1 + $cek_keranjang->jumlah;
            $total = $produk->harga+$cek_keranjang->total;
            $cek_keranjang->update([
                'jumlah' => $jumlah,
                'total' => $total
            ]);

            return redirect('/jual-beli/keranjang');
        }

        $keranjang = Jbcart::create([
            'id_pelanggan' => $id_customer,
            'id_produk' => $id,
            'nama_produk' => $produk->nama_produk,
            'jumlah' => 1,
            'harga' => $produk->harga,
            'kode_produk' => $produk->kode_produk,
            'total' =>  $produk->harga,
            'image' => $produk->gambar,
            'id_penjual' => $produk->id_pelanggan

        ]);

        Alert::success('Berhasil')->showConfirmButton('Ok', '#3085d6');

        return redirect('/jual-beli/keranjang');
    }

    public function checkout()
    {
        return view('jual-beli.checkout');
    }

    public function checkoutbarang(Request $request)
    {
        $links = session()->has('links') ? session('links') : [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session
        
        
        $this->validate($request,[

            'id' => 'required'
        ]);
        

        $id_customer = Auth::user()->id;
        $alamat_cadangan = Address::where('id_pelanggan', $id_customer)->whereIn('status', [0,1])->get();

        if($alamat_cadangan->isEmpty())
        {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/tambahalamat');  
        }

        $alamat = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();
        
        
        $id = $request->id;

        $checkout = Jbcart::whereIn('id', $request->id)->get();

        foreach ($checkout as $data) {
            if ($data->shop_product->stok <= 0 ) {
                Alert::warning('Gagal','Stok Sedang Tidak Tersedia')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        }

        foreach ($checkout as $data) {
            if ($data->shop_product->stok <= $data->jumlah ) {
                Alert::warning('Gagal','Stok Tidak Mencukupi')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        }
        

        foreach ($checkout as $data) {

            if($data->jumlah <= 0)
            {
                Alert::error('Gagal','Jumlah Tidak Boleh Kurang Dari Satu')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        
        }

       
        
        
        foreach ($checkout as $data) {

            
            $produk[] = Shop_product::find($data->id_produk);
            
        }
        

        foreach ($produk as $data) {

            $alamat_penjual[] = Address::where('id_pelanggan', $data->id_pelanggan)
                                        ->where('status', 1)->first();
            
        }

        $hitung_jumlah_alamat_penjual = count($alamat_penjual);
        
        $datas = array();
        $berat = array();
        $jumlah = array();


        
        for ($i=0; $i < $hitung_jumlah_alamat_penjual ; $i++) { 
            if (!(in_array($checkout[$i]->id_penjual, $datas))) {
                $datas[] = $checkout[$i]->id_penjual;
                
            }
        }
        

        $jumlah_penjual = count($datas);
        for ($i=0; $i < $jumlah_penjual  ; $i++) { 
            $data_coba_checkout = $datas[$i];
            $data_checkout = array();
            $hitungdatacheckout = array();
            for ($j=0; $j < $hitung_jumlah_alamat_penjual ; $j++) { 
                if ( $checkout[$j]->id_penjual == $data_coba_checkout) {
                    $data_checkout[] = $checkout[$j];
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


        // for ($i=0; $i < $jumlah_penjual  ; $i++) { 
        //     for ($j=0; $j <$jumlah_data_checkout[$i] ; $j++) { 
        //         echo $checkout_data[$i][$j]->nama_produk; 
        //     }
        //     echo'<br>';
        // }

        // dd($checkout_data);

        for ($i=0; $i < $jumlah_penjual  ; $i++) { 
            $data_coba = $datas[$i];
            $data_jumlah_checkout = 0;
            $data_total_checkout = 0;
            for ($j=0; $j < $hitung_jumlah_alamat_penjual ; $j++) { 
                if ( $checkout[$j]->id_penjual == $data_coba) {
                    $data_jumlah_checkout += $checkout[$j]->jumlah*1000;
                    $data_total_checkout += $checkout[$j]->total;
                }   
            }
            $berat[] = $data_jumlah_checkout;
            $jumlah[] = $data_total_checkout;
            
        }

        
        $jumlah_seluruh = array_sum($jumlah);


        // $berat = $checkout->sum('jumlah')*1000;
        // $jumlah = $checkout->sum('total');

      

        $pengirim =  array();

        for ($i=0; $i < $hitung_jumlah_alamat_penjual ; $i++) { 
            if (!(in_array($alamat_penjual[$i]->kota_kabupaten, $pengirim))) {
                $pengirim[] = $alamat_penjual[$i]->kota_kabupaten;
                
            }
        }
        


        // $pengirim = $alamat_penjual[0]->kota_kabupaten;
        $penerima = $alamat->kota_kabupaten;

        session(['alamat_penjual' => $pengirim]);
        session(['alamat' => $penerima]);
        session(['berat' => $berat]);


        $costjne = array();
        $costtiki = array();
        $costpos = array();
        
        for ($i=0; $i < $jumlah_penjual ; $i++) { 

            //jne
            $costjne[] = RajaOngkir::ongkosKirim([
                'origin'        => $pengirim[$i],     // ID kota/kabupaten asal
                'destination'   => $penerima,      // ID kota/kabupaten tujuan
                'weight'        => $berat[$i],    // berat barang dalam gram
                'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();
        
            //tiki
            $costtiki[] = RajaOngkir::ongkosKirim([
                'origin'        => $pengirim[$i],     // ID kota/kabupaten asal
                'destination'   => $penerima,      // ID kota/kabupaten tujuan
                'weight'        => $berat[$i],    // berat barang dalam gram
                'courier'       => 'tiki'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();
            
            //pos
            $costpos[] = RajaOngkir::ongkosKirim([
                'origin'        => $pengirim[$i],     // ID kota/kabupaten asal
                'destination'   => $penerima,      // ID kota/kabupaten tujuan
                'weight'        => $berat[$i],    // berat barang dalam gram
                'courier'       => 'pos'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();

        }
        // $kurir =  $costjne[0]['costs'][2]['cost'][0]['value'];
        // echo $kurir;

        // dd($costjne[0]["code"]);

        // for($i=0; $i<count($costjne[0]["costs"]); $i++)
        // {
        //     echo $costjne[0]["costs"][$i]["cost"][0]["value"];
        
        // }


        // for ($i=0; $i < $jumlah_penjual  ; $i++) {
        //     for($k = 0; $k < count($costjne[$i][0]["costs"]); $k++) {
        //         echo $costjne[$i][0]["costs"][$k]["cost"][0]["etd"];
                
        //     }

        // }
        



        return view('jual-beli.checkout', compact('checkout','jumlah_penjual','jumlah_seluruh','alamat','jumlah','penjual','costpos','checkout_data','costtiki','costjne','jumlah_data_checkout'));


    }

    public function updatekeranjang($data, $tombol)
    {
        $cart = Jbcart::where('id', $data)->first();

        if($tombol == 'plus')
        {
            if ($cart->jumlah >= 30) 
            {
                $jumlah = $cart->jumlah;
                $total = $cart->total;
                
            }
            else
            {
                $jumlah = $cart->jumlah+1;
                $total = $jumlah*$cart->harga;
                $cart->update([
                    'jumlah' => $jumlah,
                    'total' => $total
                ]);

            }
            

        }
        elseif($tombol == 'minus')
        {
            if ($cart->jumlah <= 1) 
            {
                $jumlah = $cart->jumlah;
                $total = $cart->total;
            }
            else
            {
                $jumlah = $cart->jumlah-1;
                $total = $jumlah*$cart->harga;
                $cart->update([
                    'jumlah' => $jumlah,
                    'total' => $total
                ]);
            }
            

        }
        

        return response()->json(['jumlah' => $jumlah, 'total' => $total]);

    }

    public function updatecartberubah($id, $jumlah)
    {
        $cart = Jbcart::where('id', $id)->first();

        if ($jumlah > 30) 
        {
            $jumlah_seluruh = $cart->jumlah;
            $total = $cart->total;
            return response()->json(['jumlah' => $jumlah_seluruh, 'total' => $total, 'status' => 'lebih30']);
        }
        elseif ($jumlah < 1) {
            $jumlah_seluruh = $cart->jumlah;
            $total = $cart->total;
            return response()->json(['jumlah' => $jumlah_seluruh, 'total' => $total, 'status' => 'kurang1']);
        }
        else
        {
            $jumlah_seluruh = $jumlah;
            $total = $jumlah_seluruh*$cart->harga;
            $cart->update([
                'jumlah' => $jumlah_seluruh,
                'total' => $total
            ]);

        }

        return response()->json(['jumlah' => $jumlah_seluruh, 'total' => $total, 'status' => 'berhasil']);

    }

    public function pesanbarang(Request $request)
    {

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

    public function invoice($invoice)
    {
        // blm bayar 1
        // sudah dibbayar 2
        // proses penjual 3
        // penjual menerima 4 menolak 0
        // dikriim 5
        // terkirim 6
        // komplin 7
        // konfirmasi diproses 8
        // batalkan pesanan pembeli 9
        // komplain dterima 10
        // komplain ditolak 11
        $id_pembeli = Auth::user()->id;
        $order = Order::where('invoice', $invoice)->get();
        $orderdetail = Orderdetail::where('invoice', $invoice)->get();

        $hitung_orderdetil = $orderdetail->count();
        
        $hitung = $order->count();
        
        for ($i=0; $i < $hitung ; $i++) {
            $id_penjual[] =  $order[$i]->id_penjual;
        }


        for ($i=0; $i < $hitung ; $i++) {
            $orderdetailcek = Orderdetail::where('invoice', $invoice)->where('id_penjual',$id_penjual[$i])->get();
            $jumlahorder =  $orderdetailcek->count();
            $hitungdataorder[] = $jumlahorder;
            for ($j=0; $j < $jumlahorder ; $j++) { 
                $orderdetaildata[$i] = Orderdetail::where('invoice', $invoice)->where('id_penjual',$id_penjual[$i])->get();
                
            }

        }

        for ($i=0; $i < $hitung ; $i++) { 
            $alamat_pembeli[] = Address::where('id', $order[$i]->id_alamat)->first();
        }

        $id_alamat_penjual = array();
        for ($i=0; $i < $hitung_orderdetil ; $i++) { 
            if (!(in_array($orderdetail[$i]->id_alamat_penjual, $id_alamat_penjual))) {
                $id_alamat_penjual[] = $orderdetail[$i]->id_alamat_penjual;
                
            }
        }

        for ($i=0; $i < $hitung; $i++) { 
            
            $alamat_penjual[] = Address::where('id', $id_alamat_penjual[$i])->first();
        }
   

        for ($i=0; $i < $hitung; $i++) {
            $rekening[] = Account::where('bank_name', $order[$i]->payment)->first();
        }

        for ($i=0; $i < $hitung; $i++) {
            $kurir[] = explode(': ', $order[$i]->shipping);
        }

        for ($i=0; $i < $hitung; $i++) {
            $sum[] = $kurir[$i][0]+$order[$i]->total_bayar;

        }

        $jumlah_seluruh = array_sum($sum);

        $rating = array();
        for ($i=0; $i < $hitung; $i++) {
            $rating[] = Rating::where('id_order', $order[$i]->id)->where('jasa', 1)->first();
            if(empty($rating[$i]))
            {
                $penilaian[] = 0;
            }
            else{
                $penilaian[] = $rating[$i]->rating;
            }
        }

        for ($i=0; $i < $hitung; $i++) 
        {
            $cek_resi[] = Delivery::where('id_order', $order[$i]->id)->first();
        }        


        return view('jual-beli.invoice', compact('order', 'penilaian','cek_resi', 'hitung', 'kurir', 'jumlah_seluruh' , 'hitungdataorder' , 'orderdetaildata', 'alamat_penjual', 'alamat_pembeli', 'id_penjual', 'hitung', 'rekening'));
    }


    public function invoice_penjual($invoice)
    {
        $id_penjual = Auth::user()->id;
        $order = Order::where('invoice', $invoice)->where('id_penjual', $id_penjual)->first();
        $cek_resi = Delivery::where('id_order', $order->id)->first();
        $orderdetails = Orderdetail::where('invoice', $invoice)->where('id_order', $order->id)->get();
        $alamat_penjual = Orderdetail::where('invoice', $invoice)->where('id_order', $order->id)->first();
        $kurir = explode(': ', $order->shipping);
        $jumlah_seluruh = $kurir[0]+$order->total_bayar;
        $bank_information = Account::where('bank_name', $order->payment)->first();

        return view('jual-beli.invoice_penjual', compact('alamat_penjual', 'orderdetails', 'order','bank_information','jumlah_seluruh','kurir','cek_resi'));
    }

    public function batalkanpesanan($invoice)
    {
        $order = Order::where('invoice', $invoice)->update([
            'status' => 9
        ]);
        Alert::success('Berhasil','Pesanan Berhasil Dibatalkan')->showConfirmButton('Ok', '#3085d6');;
        return redirect('/jual-beli/invoice/'.$invoice);
        
    }

    public function pesananditerima(Request $request)
    {
        // blm bayar 1
        // sudah dibbayar 2
        // proses penjual 3
        // penjual menerima 4 menolak 0
        // dikriim 5
        // terkirim 6
        // komplin 7
        // konfirmasi diproses 8
        // batalkan pesanan pembeli 9
        // komplain dterima 10
        if ($request->submit == 'Terima') 
        {
            $order = Order::where('id', $request->id)->first();

            $order->update([
                'status' => 4
            ]);

            return redirect('/jual-beli/invoice_penjual/'. $request->invoice);
           
        }
        elseif ($request->submit == 'Tolak') 
        {
            $order = Order::where('id', $request->id)->first();

            $order->update([
                'status' => 0
            ]);

            $rekber = Joint_account::where('user_id', $order->id_pelanggan)->first();
            
            $rekber->update([

                'saldo' => $request->jumlah_seluruh

            ]);

            return redirect('/jual-beli/invoice_penjual/'. $request->invoice);    
        }
    }

    public function inputresi(Request $request)
    {
        $this->validate($request,[

            'input_resi' => 'required'
        ]);


        $order = Order::where('id', $request->id)->first();
        $order->update([
                'status' => 5
            ]);

        $delivers = Delivery::where('id_order', $request->id)->first();
        $delivers->update([
            'invoice' => $request->input_resi
        ]);


        return redirect('/jual-beli/invoice_penjual/'. $request->invoice);

    }

    public function pesananselesai(Request $request)
    {
        // blm bayar 1
        // sudah dibbayar 2
        // proses penjual 3
        // penjual menerima 4 menolak 0
        // dikriim 5
        // terkirim 6
        // komplin 7
        // konfirmasi diproses 8
        // batalkan pesanan pembeli 9
        // komplain dterima 10
        // komplain ditolak 11

        if ($request->submit == 'Diterima') 
        {
            $order = Order::where('id', $request->id)->first();

            $rating = Rating::create([
                'id_penjual' => $order->id_penjual,
                'id_pembeli' => $order->id_pelanggan,
                'id_order' => $order->id,
                'invoice' => $order->invoice,
                'rating' => 0,
                'jasa' => 1

            ]);

            $order->update([
                'status' => 6
            ]);

            $rekber = Joint_account::where('user_id', $order->id_penjual)->first();

            $saldosum = $rekber->saldo+$request->jumlah_seluruh;
            
            $rekber->update([

                'saldo' => $saldosum

            ]);

            return redirect('/jual-beli/invoice/'. $request->invoice);
           
        }
        elseif ($request->submit == 'Komplain') 
        {
            $order = Order::where('id', $request->id)->first();

            return redirect('/jual-beli/pesanan/'. $request->id .'/komplain/'. $request->invoice);    
        }

    }

    public function komplain($id, $invoice)
    {
        
        return view('jual-beli.komplain', compact('id', 'invoice'));
    }

    public function komplaindiproses(Request $request)
    {
        $this->validate($request,[

            'email' => 'required',
            'keterangan' => 'required',
            'foto_bukti' => 'required|image|max:2048'

        ]);

        $folderPath = public_path("Uploads/Komplain/JualBeli/{".$request->invoice."}");
        $response = mkdir($folderPath);
        
        $image = $request->foto_bukti;
        $name=$image->getClientOriginalName();
        $image_resize = Images::make($image->getRealPath());
        $image_resize->save($folderPath .'/'. $name);

        $order = Order::where('id', $request->id_order)->first();


        $komplain = Complaint::create([
            'id_pelanggan' => $order->id_pelanggan,
            'id_order' => $request->id_order,
            'id_penjual' => $order->id_penjual,
            'invoice' => $request->invoice,
            'keterangan' => $request->keterangan,
            'email' => $request->email,
            'gambar' => $name,
            'status' => 1

        ]);

        $order->update([
            'status' => 7
        ]);

        return redirect('/jual-beli/invoice/'. $request->invoice);

    }

    

    public function hapus($id)
    {
        $flight = Jbcart::find($id);

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

    public function rating(Request $request)
    {
        $rating = Rating::where('id_order', $request->id_order_rating)->where('jasa', 1)->first();
        $rating->update([
            'rating' => $request->whatever1
        ]);

        return response()->json();
    }
    
}
