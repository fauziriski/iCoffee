<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Orderdetail;
use App\Address;
use App\Rating;
use App\Delivery;
use App\Account;
use App\Joint_account;

class InvoiceController extends Controller
{
        // blm bayar 1
        // sudah dibayar 2
        // proses penjual 3
        // penjual menerima 4 menolak 0
        // dikriim 5
        // terkirim 6
        // komplin 7
        // konfirmasi diproses 8
        // batalkan pesanan pembeli 9
        // komplain dterima 10
        // komplain ditolak 11

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($invoice)
    {
        $id_pembeli = Auth::user()->id;
        $order = Order::where('invoice', $invoice)->get();

        if ($order->isEmpty()) {
            Alert::error('Gagal', 'Order tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/transaksi');
        }

        $orderdetail = Orderdetail::where('invoice', $invoice)->get();

        $hitung_orderdetil = $orderdetail->count();
        
        $hitung = $order->count();
        
        for ($i=0; $i < $hitung ; $i++) 
        {
            $id_penjual[] =  $order[$i]->id_penjual;
        }


        for ($i=0; $i < $hitung ; $i++) 
        {
            $orderdetailcek = Orderdetail::where('invoice', $invoice)->where('id_penjual',$id_penjual[$i])->get();
            $jumlahorder =  $orderdetailcek->count();
            $hitungdataorder[] = $jumlahorder;
            for ($j=0; $j < $jumlahorder ; $j++) 
            { 
                $orderdetaildata[$i] = Orderdetail::where('invoice', $invoice)->where('id_penjual',$id_penjual[$i])->get();
            }
        }

        for ($i=0; $i < $hitung ; $i++) 
        { 
            $alamat_pembeli[] = Address::where('id', $order[$i]->id_alamat)->first();
        }

        $id_alamat_penjual = array();

        for ($i=0; $i < $hitung_orderdetil ; $i++) { 
            if (!(in_array($orderdetail[$i]->id_alamat_penjual, $id_alamat_penjual))) {
                $id_alamat_penjual[] = $orderdetail[$i]->id_alamat_penjual;
                
            }
        }

        for ($i=0; $i < $hitung; $i++) 
        {     
            $alamat_penjual[] = Address::where('id', $id_alamat_penjual[$i])->first();
        }
   

        for ($i=0; $i < $hitung; $i++) 
        {
            $rekening[] = Account::where('bank_name', $order[$i]->payment)->first();
        }

        for ($i=0; $i < $hitung; $i++) 
        {
            $kurir[] = explode(': ', $order[$i]->shipping);
        }

        for ($i=0; $i < $hitung; $i++) 
        {
            $sum[] = $kurir[$i][0]+$order[$i]->total_bayar;
        }

        $jumlah_seluruh = array_sum($sum);

        $rating = array();
        for ($i=0; $i < $hitung; $i++) 
        {
            $rating[] = Rating::where('id_order', $order[$i]->id)->where('jasa', 1)->first();
            if(empty($rating[$i])) {
                $penilaian[] = 0;
            }
            else {
                $penilaian[] = $rating[$i]->rating;
            }
        }

        for ($i=0; $i < $hitung; $i++) 
        {
            $cek_resi[] = Delivery::where('id_order', $order[$i]->id)->first();
        }        


        return view('jual-beli.invoice', compact('order', 'penilaian','cek_resi', 'hitung', 'kurir', 'jumlah_seluruh' , 'hitungdataorder' , 'orderdetaildata', 'alamat_penjual', 'alamat_pembeli', 'id_penjual', 'hitung', 'rekening'));
    }

    public function cancelOrder($invoice)
    {
        $order = Order::where('invoice', $invoice)->update([
            'status' => 9
        ]);

        if ($order) {
            
            Alert::success('Berhasil','Pesanan Berhasil Dibatalkan')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/invoice/'.$invoice);
        }
        return redirect('/jual-beli/invoice/'.$invoice);
        
    }

    public function acceptedProduct(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'invoice' => 'required',
            'jumlah_seluruh' => 'required',
            'submit' => 'required'
        ]);

        if ($request->submit == 'Diterima') {

            $order = Order::where('id', $request->id)->first();

            if ($order) {

                $accProduct = $order->update([
                    'status' => 6
                ]);
    
                if ($accProduct) {
    
                    $rating = Rating::create([
                        'id_penjual' => $order->id_penjual,
                        'id_pembeli' => $order->id_pelanggan,
                        'id_order' => $order->id,
                        'invoice' => $order->invoice,
                        'rating' => 0,
                        'jasa' => 1
        
                    ]);

                    if ($rating) {
                        $rekber = Joint_account::where('user_id', $order->id_penjual)->first();

                        if ($rekber) {
                            $saldosum = $rekber->saldo+$request->jumlah_seluruh;
                        
                            $rekber->update([
                                'saldo' => $saldosum
                            ]);
                            Alert::success('Selesai','Paket diterima')->showConfirmButton('Ok', '#3085d6');
                            return redirect('/jual-beli/invoice/'. $request->invoice);

                        } else {
                            Alert::error('Gagal','Gagal menemukan rekening')->showConfirmButton('Ok', '#3085d6');
                            return redirect('/jual-beli/invoice/'. $request->invoice);
                        }
                       

                    } else {
                        Alert::error('Gagal','Gagal membuat rating')->showConfirmButton('Ok', '#3085d6');
                        return redirect('/jual-beli/invoice/'. $request->invoice);
                        
                    }

                } else {
    
                    Alert::error('Gagal','Penerimaan produk gagal')->showConfirmButton('Ok', '#3085d6');
                    return redirect('/jual-beli/invoice/'. $request->invoice);
                }
                
            } else {
                
                Alert::error('Gagal','Order tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/invoice/'. $request->invoice);
            }


           
        }
        elseif ($request->submit == 'Komplain') {
            $order = Order::where('id', $request->id)->first();

            return redirect('/jual-beli/pesanan/'. $request->id .'/komplain/'. $request->invoice);    
        }

        else {
            return redirect('/jual-beli/invoice/'.$invoice);
        }

    }

    public function rating(Request $request)
    {
        $this->validate($request,[
            'id_order_rating' => 'required',
            'whatever1' => 'required',
        ]);

        if ($request->whatever1 <= 5) {
            $rating = Rating::where('id_order', $request->id_order_rating)->where('jasa', 1)->first();
            if ($rating) {
                $rating->update([
                    'rating' => $request->whatever1
                ]);
        
                return response()->json();
            }
        }
        
    }
}
