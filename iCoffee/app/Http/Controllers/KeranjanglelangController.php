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
use App\Auction_Order;
use App\Auction_delivery;
use App\Auction_complaint;
use App\Account;
use App\Joint_account;
use App\Complaint;
use App\Address;
use App\Delivery;
use App\Delivery_category;
use App\Rating;
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


        return view('jual-beli.lelang.checkout', compact('checkout','alamat_pembeli', 'alamat_penjual', 'costjne', 'costtiki', 'costpos'));
        
    }

    public function pesanbarang(Request $request)
    {
        $this->validate($request,[

            'kurir' => 'required',
            'bank' => 'required'
        ]);

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

    public function invoice($invoice)
    {
        $id_pembeli = Auth::user()->id;
        $order = Auction_Order::where('invoice', $invoice)->where('id_pembeli', $id_pembeli)->first();
        $kurir = explode(': ', $order->shipping);
        $bank_information = Account::where('bank_name', $order->payment)->first();

        $rating;
        $rating = Rating::where('id_order', $order->id)->where('jasa', 2)->first();

        if(empty($rating))
            {
                $penilaian = 0;
            }
            else{
                $penilaian = $rating->rating;
            }
        
        $cek_resi = Auction_delivery::where('id_order', $order->id)->first();

        if($order->status == 5 || 6 || 7 || 10 || 11)
        {
            return view('jual-beli.lelang.invoice', compact('order', 'kurir', 'bank_information','cek_resi', 'penilaian'));
            
        }
        return view('jual-beli.lelang.invoice', compact('order', 'kurir', 'bank_information', 'penilaian'));
    }

    public function invoice_penjual($invoice)
    {
        // blm bayar 1
        // sudah dibbayar 2
        // pembayaran ditolak 2
        // proses penjual 3
        // penjual menerima 4 menolak 0
        // dikriim 5
        // terkirim 6
        // komplin 7
        // konfirmasi diproses 8
        // batalkan pesanan pembeli 9
        // komplain dterima 10
        // komplain ditolak 11
        $id_penjual = Auth::user()->id;
        $order = Auction_Order::where('invoice', $invoice)->where('id_penjual', $id_penjual)->whereIn('status',[0,3,4,5,6,7,10,11])->first();
        $kurir;
        $invoice;

        $kurir = explode(': ', $order->shipping);
        $bank_information = Account::where('bank_name', $order->payment)->first();

        $cek_resi = Auction_delivery::where('id_order', $order->id)->first();

        if($order->status == 5 || 6 || 7 || 10 || 11)
        {
            return view('jual-beli.lelang.invoice_penjual', compact('order', 'kurir', 'bank_information','cek_resi'));
            
        }

        return view('jual-beli.lelang.invoice_penjual', compact('order', 'kurir', 'bank_information'));

    }

    public function transaksi()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipembeli = Auction_Order::where('id_pembeli', $id_pelanggan)->orderBy('created_at','desc')->get();
        $transaksipenjual = Auction_Order::where('id_penjual', $id_pelanggan)->whereIn('status',[0,3,4,5,6,7])->orderBy('created_at','desc')->get();

        return view('jual-beli.lelang.transaksi', compact('transaksipembeli', 'transaksipenjual'));

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
            $order = Auction_Order::where('id', $request->id)->first();

            $order->update([
                'status' => 4
            ]);

            return redirect('/lelang/invoice_penjual/'. $request->invoice);
           
        }
        elseif ($request->submit == 'Tolak') 
        {
            $order = Auction_Order::where('id', $request->id)->first();

            $order->update([
                'status' => 0
            ]);

            $rekber = Joint_account::where('user_id', $order->id_pembeli)->first();
            
            $rekber->update([

                'saldo' => $request->jumlah_seluruh

            ]);

            return redirect('/lelang/invoice_penjual/'. $request->invoice);   
        }
    }

    public function inputresi(Request $request)
    {

        $this->validate($request,[

            'input_resi' => 'required'
        ]);

        $delivers = Auction_delivery::where('id_order', $request->id)->first();
        $delivers->update([
            'invoice' => $request->input_resi
        ]);


        $order = Auction_Order::where('id', $request->id)->first();
        $order->update([
                'status' => 5
            ]);

        return redirect('/lelang/invoice_penjual/'. $request->invoice);

    }

    public function pesananselesai(Request $request)
    {
        // blm bayar 1
        // ditolak pembayaran 2
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
            $order = Auction_Order::where('id', $request->id)->first();

            $order->update([
                'status' => 6
            ]);

            $rating = Rating::create([
                'id_penjual' => $order->id_penjual,
                'id_pembeli' => $order->id_pembeli,
                'id_order' => $order->id,
                'invoice' => $order->invoice,
                'rating' => 0,
                'jasa' => 2

            ]);

            $rekber = Joint_account::where('user_id', $order->id_penjual)->first();

            $saldosum = $rekber->saldo+$request->jumlah_seluruh;
            
            $rekber->update([

                'saldo' => $saldosum

            ]);

            return redirect('/lelang/invoice/'. $request->invoice);
           
        }
        elseif ($request->submit == 'Komplain') 
        {
            $order = Auction_Order::where('id', $request->id)->first();

            return redirect('/lelang/pesanan/'. $request->id .'/komplain/'. $request->invoice);    
        }


    }

    public function komplain($id, $invoice)
    {
        
        return view('jual-beli.lelang.komplain', compact('id', 'invoice'));
    }
    
    public function komplaindiproses(Request $request)
    {
        $this->validate($request,[

            'email' => 'required',
            'keterangan' => 'required',
            'foto_bukti' => 'required|image|max:2048'

        ]);

    
        $folderPath = public_path("Uploads\Komplain\Lelang\{$request->invoice}");
        $response = mkdir($folderPath);
        
        $image = $request->foto_bukti;
        $name=$image->getClientOriginalName();
        $image_resize = Images::make($image->getRealPath());
        $image_resize->save($folderPath .'/'. $name);

        $order = Auction_Order::where('id', $request->id_order)->first();


        $komplain = Auction_complaint::create([
            'id_pelanggan' => $order->id_pembeli,
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

        return redirect('/lelang/invoice/'. $request->invoice);
    }

    public function rating(Request $request)
    {
        $rating = Rating::where('id_order', $request->id_lelang_rating)->where('jasa', 2)->first();
        $rating->update([
            'rating' => $request->whatever1
        ]);

        return response()->json();
    }
    

    


}
