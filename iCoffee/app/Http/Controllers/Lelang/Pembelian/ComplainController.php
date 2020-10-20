<?php

namespace App\Http\Controllers\Lelang\Pembelian;


use Intervention\Image\ImageManagerStatic as Images;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auction_complaint;
use App\Auction_Order;

class ComplainController extends Controller
{
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

    
        $folderPath = public_path("Uploads/Komplain/Lelang/".$request->invoice);
        $response = mkdir($folderPath);
        
        $image = $request->foto_bukti;
        $name = 'complain_auction_' .$request->invoice .'_' . \Carbon\Carbon::now()->format('Ymd_His'). '-' .uniqid() . '.' . $files->getClientOriginalExtension();
        // $name=$image->getClientOriginalName();
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
}
