<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pengajuan_dana;
use App\Invest_product;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanDanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:mitra');
    }
    
    public function produkPengajuanDana()
    {
        $produk = Invest_product::where('id_mitra', Auth::user()->id_mitra)->where('status',2)->get();
        return view('investasi.mitra.pengajuan-verif',compact('produk'));
    }

    public function pengajuanDana($id)
    {
        $status1 = Pengajuan_dana::where('kode_produk',$id)->where('progress','1')->value('status');
        $status2 = Pengajuan_dana::where('kode_produk',$id)->where('progress','2')->value('status');
        $status3 = Pengajuan_dana::where('kode_produk',$id)->where('progress','3')->value('status');
        $status4 = Pengajuan_dana::where('kode_produk',$id)->where('progress','4')->value('status');
        return view('investasi.mitra.pengajuan')->with('id',$id)->with('status1',$status1)->with('status2',$status2)->with('status3',$status3)->with('status4',$status4);
    }
    
    public function pengajuanDana1(Request $request)
    {
        for($i=1;$i<=count($request->item);$i++){
            $harga = $request->item[$i]['price'];
            $qty = $request->item[$i]['quantity'];
            $total = $harga*$qty;
            Pengajuan_dana::create([
                'produk' => $request->item[$i]['produk'],
                'harga' => $harga,
                'jumlah' => $qty,
                'total' => $total,
                'kode_produk' => $request->item[1]['kode_produk'],
                'progress' => '1',
                'status' => '1'
            ]);
        }
        Alert::toast('Pengajuan Berhasil!', 'success');
        return redirect('mitra/pengajuan-dana');
    }

    public function pengajuanDana2(Request $request)
    {
        for($i=1;$i<=count($request->item);$i++){
            $harga = $request->item[$i]['price'];
            $qty = $request->item[$i]['quantity'];
            $total = $harga*$qty;
            Pengajuan_dana::create([
                'produk' => $request->item[$i]['produk'],
                'harga' => $harga,
                'jumlah' => $qty,
                'total' => $total,
                'kode_produk' => $request->item[1]['kode_produk'],
                'progress' => '2',
                'status' => '1'
            ]);
        }
        Alert::toast('Pengajuan Berhasil!', 'success');
        return redirect('mitra/pengajuan-dana');
    }

    public function pengajuanDana3(Request $request)
    {
        for($i=1;$i<=count($request->item);$i++){
            $harga = $request->item[$i]['price'];
            $qty = $request->item[$i]['quantity'];
            $total = $harga*$qty;
            Pengajuan_dana::create([
                'produk' => $request->item[$i]['produk'],
                'harga' => $harga,
                'jumlah' => $qty,
                'total' => $total,
                'kode_produk' => $request->item[1]['kode_produk'],
                'progress' => '3',
                'status' => '1'
            ]);
        }
        Alert::toast('Pengajuan Berhasil!', 'success');
        return redirect('mitra/pengajuan-dana');
    }

    public function pengajuanDana4(Request $request)
    {
        for($i=1;$i<=count($request->item);$i++){
            $harga = $request->item[$i]['price'];
            $qty = $request->item[$i]['quantity'];
            $total = $harga*$qty;
            Pengajuan_dana::create([
                'produk' => $request->item[$i]['produk'],
                'harga' => $harga,
                'jumlah' => $qty,
                'total' => $total,
                'kode_produk' => $request->item[1]['kode_produk'],
                'progress' => '4',
                'status' => '1'
            ]);
        }
        Alert::toast('Pengajuan Berhasil!', 'success');
        return redirect('mitra/pengajuan-dana');
    }
}
