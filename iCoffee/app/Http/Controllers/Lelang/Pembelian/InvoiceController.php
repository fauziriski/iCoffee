<?php

namespace App\Http\Controllers\Lelang\Pembelian;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auction_delivery;
use App\Auction_product;
use App\Helper\Helper;
use App\Joint_account;
use App\Auction_Order;
use App\Account;
use App\Rating;
use DB;

class InvoiceController extends Controller
{
    public function invoice($invoice)
    {
        $id_pembeli = Auth::user()->id;
        $order = Auction_Order::where('invoice', $invoice)->where('id_pembeli', $id_pembeli)->first();
        $kurir = explode(': ', $order->shipping);
        $bank_information = Account::where('bank_name', $order->payment)->first();

        $product;
        // $rating = Rating::where('id_order', $order->id)->where('jasa', 2)->first();
        $product = Auction_product::where('id', $order->id_produk)->first('rating');

        if(empty($product->rating))
            {
                $penilaian = 0;
            }
            else{
                $penilaian = $product->rating;
            }
        
        $cek_resi = Auction_delivery::where('id_order', $order->id)->first();

        if($order->status == 5 || 6 || 7 || 10 || 11)
        {
            return view('jual-beli.lelang.invoice', compact('order', 'kurir', 'bank_information','cek_resi', 'penilaian'));
            
        }
        return view('jual-beli.lelang.invoice', compact('order', 'kurir', 'bank_information', 'penilaian'));
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

            // $rating = Auction_product::create([
            //     'id_penjual' => $order->id_penjual,
            //     'id_pembeli' => $order->id_pembeli,
            //     'id_order' => $order->id,
            //     'invoice' => $order->invoice,
            //     'rating' => 0,
            //     'jasa' => 2

            // ]);

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

    public function rating(Request $request)
    {
        $order = Auction_Order::where('id', $request->id_lelang_rating)->first();
        $product = Auction_product::where('id',$order->id_produk)->first();
        
        // $rating = Rating::where('id_order', $request->id_lelang_rating)->where('jasa', 2)->first();
        $update = $product->update([
            'rating' => $request->whatever1
        ]);
    //    $update =  DB::select(`UPDATE auction_product SET 'rating' = $request->whatever1 WHERE 'id'= $request->id_lelang_rating`);

        return response()->json();
    }

    public function getWayBill($id)
    {
        $delivery = Auction_delivery::where('id_order', $id)->first();
        $kurir = $delivery->delivery_category->judul;
        $array = array(
            "waybill" => $delivery->invoice,
            "courier" => $kurir,
        );
        $data = Helper::instance()->getwaybill($array);

        return response()->json($data);
    }
}
