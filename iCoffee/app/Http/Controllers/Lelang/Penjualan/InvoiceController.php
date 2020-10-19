<?php

namespace App\Http\Controllers\Lelang\Penjualan;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auction_delivery;
use App\Joint_account;
use App\Auction_Order;
use App\Account;
use App\Rating;


class InvoiceController extends Controller
{
    public function invoice_penjual($invoice)
    {
        // blm bayar 1
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
}
