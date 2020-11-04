<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Complaint;
use App\Order;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id, $invoice)
    {
        return view('jual-beli.komplain', compact('id', 'invoice'));
    }

    public function update(Request $request)
    {

        $this->validate($request,[

            'email' => 'required',
            'invoice_data' => 'required|exists:orders,invoice',
            'invoice' => 'required|exists:orders,invoice',
            'keterangan' => 'required',
            'foto_bukti' => 'required|image|max:2048'

        ]);

        $order = Order::where('id', $request->id_order)->first();

        if ($order) {

            $folderPath = public_path("Uploads/Komplain/JualBeli/".$request->invoice);
            $response = mkdir($folderPath);
            
            // $image = $request->foto_bukti;
            // $name=$image->getClientOriginalName();
            // $image_resize = Images::make($image->getRealPath());
            // $image_resize->save($folderPath .'/'. $name);

            $image = $request->foto_bukti;
            $name = 'complain_jualbeli_' .$request->invoice .'_' . \Carbon\Carbon::now()->format('Ymd_His'). '-' .uniqid() . '.' . $image->getClientOriginalExtension();
            // $name=$image->getClientOriginalName();
            $image_resize = Images::make($image->getRealPath());
            $image_resize->save($folderPath .'/'. $name);
    
            if ($image_resize) {
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

                if ($komplain) {
                    Alert::success('Berhasil','Tunggu pemberitahuan selanjutnya')->showConfirmButton('Ok', '#3085d6');
                    return redirect('/jual-beli/invoice/'. $request->invoice);
                } else {
                    Alert::error('Gagal','Gagal membuat komplain')->showConfirmButton('Ok', '#3085d6');
                    return redirect('/jual-beli/pesanan/' .$request->id_order . '/komplain/' .$request->invoice);
                }
                
            } else {
                Alert::error('Gagal','Upload gambar gagal')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/pesanan/' .$request->id_order . '/komplain/' .$request->invoice);
            }


        } else {
            Alert::error('Gagal','Order tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/pesanan/' .$request->id_order . '/komplain/' .$request->invoice);

        }
        

    }
}
