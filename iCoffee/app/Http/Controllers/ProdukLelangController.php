<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Address;
use App\Auction_product;
use App\Auction_process;
use App\Auction_winner;
use App\Auction_image;
use App\Joint_account;
use App\Category;
use App\Helper\Helper;

class ProdukLelangController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function tawar(Request $request)
    {
        $id_pelanggan = Auth::user()->id;

        $produk = Auction_product::where('id', $request->id_produk)->first();
        $cek_saldo = Joint_account::where('user_id', $id_pelanggan)->first();

        $lima_persen = 5/100*$produk->harga_awal;

        if($cek_saldo->saldo < $lima_persen)
        {
            return response()->json(['response' => 'Saldo', 'data' => $request]);
        }



        if($request->id_pelelang == $id_pelanggan){

            return response()->json(['response' => 'Gagal', 'data' => $request]);
        }


        $process = Auction_process::create([
            'id_produk' => $request->id_produk,
            'id_pelelang' => $request->id_pelelang,
            'id_penawar' => $request->id_penawar,
            'nama' => $request->nama,
            'penawaran' => $request->penawaran,
            'pemenang' => '0',
            'kelipatan' => $request->kelipatan,
            'status' => '1'
        ]);
        $i = 1;
        Alert::success('Tawaran Anda Berhasil');

        return response()->json(['response' => 'Berhasil', 'data' => $process]);



    }

    
}
