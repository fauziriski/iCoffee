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
use App\Helper\Helper;

class KeranjanglelangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function checkout()
    {
        return view('jual-beli.lelang.checkout');
    }


    public function transaksi()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipembeli = Auction_Order::where('id_pembeli', $id_pelanggan)->orderBy('created_at','desc')->get();
        $transaksipenjual = Auction_Order::where('id_penjual', $id_pelanggan)->whereIn('status',[0,3,4,5,6,7])->orderBy('created_at','desc')->get();

        return view('jual-beli.lelang.transaksi', compact('transaksipembeli', 'transaksipenjual'));

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

    
        $folderPath = public_path("Uploads/Komplain/Lelang/{".$request->invoice."}");
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

    
    

    


}
