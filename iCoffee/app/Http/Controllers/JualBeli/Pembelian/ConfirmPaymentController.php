<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Confirm_payment;
use App\Helper\Helper;
use App\Order;
use App\User;


class ConfirmPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipenjual = Order::where('id_pelanggan', $id_pelanggan)->whereIn('status',[1,2])->orderBy('created_at','desc')->get();

        $jumlah_invoice = count($transaksipenjual);

        $data_invoice = array();
        $data_tanggal = array();
        for ($i=0; $i < $jumlah_invoice ; $i++) { 
            if(!(in_array($transaksipenjual[$i]->invoice, $data_invoice))){
                $data_invoice[] = $transaksipenjual[$i]->invoice;
                $data_tanggal[] = date('Y-m-d', strtotime($transaksipenjual[$i]->created_at));

            }
        }
        $jumlah = count($data_invoice);

        return view('jual-beli.confirm_payment', compact('data_invoice', 'jumlah', 'data_tanggal','transaksipenjual'));

    }

    public function store(Request $request)
    {
        $id_pelanggan = Auth::user()->id;
        $this->validate($request,[
            'email' => 'required',
            'nama_bank_pengirim' => 'required',
            'no_rekening_pengirim' => 'required',
            'no_telp' => 'required',
            'nama_pemilik_pengirim' => 'required',
            'jumlah_transfer' => 'required',
            'invoice' => 'required',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $folderPath = public_path("Uploads/Konfirmasi_Pembayaran/JualBeli/{".$request->invoice."}");
        $image = $request->foto_bukti;
        $name=$image->getClientOriginalName();


        $jumlah_transfer = Helper::instance()->removeDot($request->jumlah_transfer);;

        $confirm_pesanan = Confirm_payment::create([
            'id_pelanggan' => $id_pelanggan,
            'email' => $request->email,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'nama_bank_pengirim' => $request->nama_bank_pengirim,
            'nama_pemilik_pengirim' => $request->nama_pemilik_pengirim,
            'jasa' => '1',
            'no_telp' => $request->no_telp,
            'jumlah_transfer' => $jumlah_transfer,
            'invoice' => $request->invoice,
            'foto_bukti' => $name,
            'status' => '1'
        ]);

        if ($confirm_pesanan) {
            $response = mkdir($folderPath);
            $image_resize = Images::make($image->getRealPath());
            $image_resize->save($folderPath .'/'. $name);
            $order = Order::where('invoice', $request->invoice)->update([
                'status' => '8'
            ]);
    
            Alert::success('Berhasil', 'Konfirmasi berhasil')->showConfirmButton('Ok', '#3085d6');
    
            return redirect('/jual-beli/invoice/'. $request->invoice);
        }
        else {
            Alert::error('Gagal', 'Konfirmasi gagal')->showConfirmButton('Ok', '#3085d6');
    
            return redirect('/jual-beli/konfirmasi');
        }
        
    }
}
