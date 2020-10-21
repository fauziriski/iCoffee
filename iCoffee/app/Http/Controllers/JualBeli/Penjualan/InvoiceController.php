<?php

namespace App\Http\Controllers\JualBeli\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Orderdetail;
use App\Delivery;
use App\Account;
use App\Helper\Helper;

class InvoiceController extends Controller
{
    public function index($invoice)
    {
        $id_penjual = Auth::user()->id;

        $order = Order::where('invoice', $invoice)->where('id_penjual', $id_penjual)->first();

        if (empty($order)) {
            Alert::error('Gagal', 'Order tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/transaksi#pills-profile');
        }

        $cek_resi = Delivery::where('id_order', $order->id)->first();
        $orderdetails = Orderdetail::where('invoice', $invoice)->where('id_order', $order->id)->get();
        $alamat_penjual = Orderdetail::where('invoice', $invoice)->where('id_order', $order->id)->first();
        $kurir = explode(': ', $order->shipping);
        $jumlah_seluruh = $kurir[0]+$order->total_bayar;
        $bank_information = Account::where('bank_name', $order->payment)->first();

        return view('jual-beli.invoice_penjual', compact('alamat_penjual', 'orderdetails', 'order','bank_information','jumlah_seluruh','kurir','cek_resi'));
    }

    public function ordersAccepted(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'invoice' => 'required',
            'jumlah_seluruh' => 'required',
            'submit' => 'required',
        ]);

        if ($request->submit == 'Terima') {
            $order = Order::where('id', $request->id)->first();

            if (empty($order)) {
                Alert::error('Gagal', 'Order tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/transaksi#pills-profile');
            }

            $update = $order->update([
                'status' => 4
            ]);

            if ($update) {
                Alert::success('Berhasil', 'Berhasil menenerima order')->showConfirmButton('Ok', '#3085d6');
                
                return redirect('/jual-beli/invoice_penjual/'. $request->invoice);
            }else {
                Alert::error('Gagal', 'Tidak dapat menenerima order')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/invoice_penjual/'. $request->invoice);
            }
           
        }
        elseif ($request->submit == 'Tolak') {
            $order = Order::where('id', $request->id)->first();

            if (empty($order)) {
                Alert::error('Gagal', 'Order tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/transaksi#pills-profile');
            }

            $order->update([
                'status' => 0
            ]);

            $rekber = Joint_account::where('user_id', $order->id_pelanggan)->first();
            
            $update = $rekber->update([

                'saldo' => $request->jumlah_seluruh

            ]);

            if ($update) {
                Alert::success('Berhasil', 'Berhasil menolak order')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/invoice_penjual/'. $request->invoice);
            }else {
                Alert::error('Gagal', 'Tidak dapat menolak order')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/invoice_penjual/'. $request->invoice);
            }

        }
        return redirect('/jual-beli/invoice_penjual/'. $request->invoice);   
    }

    public function updateResi(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'input_resi' => 'required',
            'invoice' => 'required',
            'submit' => 'required'
        ]);

        if ($request->submit == 'Input') {
            
            $order = Order::where('id', $request->id)->first();

            if (empty($order)) {
                Alert::error('Gagal', 'Order tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/transaksi#pills-profile');
            }

            $updateOrder = $order->update([
                    'status' => 5
                ]);
            
            if ($updateOrder) {
                
                $delivers = Delivery::where('id_order', $request->id)->first();

                $updateCourier = $delivers->update([
                    'invoice' => $request->input_resi
                ]);

                if ($updateCourier) {
                    Alert::success('Berhasil', 'Berhasil update nomor resi')->showConfirmButton('Ok', '#3085d6');
                    return redirect('/jual-beli/invoice_penjual/'. $request->invoice);
                }
                Alert::error('Gagal')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/invoice_penjual/'. $request->invoice);

            }
            Alert::error('Gagal', 'Gagal memasukan nomor resi')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/invoice_penjual/'. $request->invoice);

        }

        return redirect('/jual-beli/invoice_penjual/'. $request->invoice);
    }

    public function getWayBill($id)
    {
        $delivery = Delivery::where('id_order', $id)->first();
        $kurir = explode(': ', $delivery->nama);
        $courir = strtolower($kurir[1]);
        $array = array(
            "waybill" => $delivery->invoice,
            "courier" => $courir,
        );
        $data = Helper::instance()->getwaybill($array);

        return response()->json($data);
    }
    
}
