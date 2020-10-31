<?php

namespace App\Http\Controllers\Lelang\Pembelian;

use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Confirm_payment;
use App\Helper\Helper;
use App\Auction_Order;

class ConfirmPaymentController extends Controller
{
    public function pembayaranlelang()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipenjual = Auction_Order::where('id_pembeli', $id_pelanggan)->whereIn('status',[1,2])->orderBy('created_at','desc')->get();
        $data_tanggal = array();
        foreach ($transaksipenjual as $data) {
            $data_tanggal = date('Y-m-d', strtotime($data->created_at));   
        }


        return view('jual-beli.lelang.confirm_payment', compact('data_tanggal','transaksipenjual'));
    } 

    public function konfirmasipembayaranlelang(Request $request)
    {
        $id_pelanggan = Auth::user()->id;
        $this->validate($request,[
            'email' => 'required',
            'nama_bank_pengirim' => 'required',
            'no_rekening_pengirim' => 'required',
            'no_telp' => 'required',
            'nama_pemilik_pengirim' => 'required',
            'jumlah_transfer' => 'required',
            'invoice' => 'required|exists:auction_orders,invoice',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $jumlah_transfer =  Helper::instance()->removeDot($request->jumlah_transfer);

        $folderPath = public_path("Uploads/Konfirmasi_Pembayaran/Lelang/{".$request->invoice."}");
        $response = mkdir($folderPath);
        
        $image = $request->foto_bukti;
        $name=$image->getClientOriginalName();
        $image_resize = Images::make($image->getRealPath());
        $image_resize->save($folderPath .'/'. $name);

        $confirm_pesanan = Confirm_payment::create([
            'id_pelanggan' => $id_pelanggan,
            'email' => $request->email,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'nama_bank_pengirim' => $request->nama_bank_pengirim,
            'nama_pemilik_pengirim' => $request->nama_pemilik_pengirim,
            'jasa' => '2',
            'no_telp' => $request->no_telp,
            'jumlah_transfer' => $jumlah_transfer,
            'invoice' => $request->invoice,
            'foto_bukti' => $name,
            'status' => '1'
        ]);

        $order = Auction_Order::where('invoice', $request->invoice)->update([
            'status' => '8'
        ]);

        Alert::success('Berhasil')->showConfirmButton('Ok', '#3085d6');

        return redirect('/lelang/invoice/'.$request->invoice);
    }
}
