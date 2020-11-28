<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invest_product;
use App\invest_order;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
use App\User;
use App\Mitra;
use App\Mitra_bank;
use App\Mitra_withdraw;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:mitra');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = count(Invest_product::where('id_mitra',Auth::user()->id_mitra)->get());
        $dana = invest_order::where('id_mitra',Auth::user()->id_mitra)->where('status',2)->get('total');
        $investor = invest_order::where('id_mitra',Auth::user()->id_mitra)->where('status',2)->distinct()->count('id_investor');
        $total = 0;
        for($i=0;$i<count($dana);$i++){
            $total += $dana[$i]->total;
        }
        if(Str::contains(Auth::user()->id_mitra, 'KT')){
            $kode = Auth::user()->kode;
            $gambar = Auth::user()->gambar;
            $path = "Uploads/Kelompok_tani/{$kode}/{$gambar}";
        }elseif(Str::contains(Auth::user()->id_mitra, 'KP')){
            $kode = Auth::user()->kode;
            $gambar = Auth::user()->gambar;
            $path = "Uploads/Mitra_Koperasi/{$kode}/{$gambar}";
        }else{
            $kode = Auth::user()->kode;
            $gambar = Auth::user()->gambar;
            $path = "Uploads/Mitra_Perorangan/{$kode}/{$gambar}";
        }
        return view('investasi.mitra.index')->with('produk',$produk)->with('total',$total)->with('investor',$investor)->with('path',$path);
    }

    public function produkDetail($kode_produk)
    {
        $produk = Invest_product::where('kode_produk',$kode_produk)->first();
        $dana = invest_order::where('status',2)->where('id_produk',$produk->id)->get();
        $total = 0;
        $qty = 0;
        if(!$dana->isEmpty()){
            for($i=0;$i<count($dana);$i++){
                $total += $dana[$i]->total;
                $qty += $dana[$i]->qty;
                $nama[] = User::where('id', $dana[$i]->id_investor)->first();
            }
            $investor = invest_order::where('id_produk',$produk->id)->where('status',2)->distinct()->count('id_investor');
    
            return view('investasi.mitra.detail')->with('produk',$produk)->with('total',$total)->with('investor',$investor)->with('qty',$qty)->with(compact('dana'))->with(compact('nama'));
        }
        else{
            $investor = invest_order::where('id_produk',$produk->id)->where('status',2)->distinct()->count('id_investor');
            return view('investasi.mitra.detail')->with('produk',$produk)->with('total',$total)->with('investor',$investor)->with('qty',$qty)->with(compact('dana'));
        }
        
    }


    public function rekeningMitra()
    {
        // $saldo = Mitra::where('id_mitra',Auth::user()->id_mitra)->first('saldo');
        $data = Mitra::where('id_mitra',Auth::user()->id_mitra)->first();
        $saldo_tercatat = $data->saldo;

        $rekening = Mitra_bank::where('id_mitra', Auth::user()->id_mitra)->get();
        $withdraws = Mitra_withdraw::where('id_mitra', Auth::user()->id_mitra)->get();
        if(!$withdraws->isEmpty()){
            for ($i=0; $i < count($withdraws); $i++) {
                $bank_withdraws[$i] = Mitra_bank::where('id_mitra',Auth::user()->id_mitra)->where('id',$withdraws[$i]->id_bank)->get();
            }
            return view('investasi.mitra.rekening', compact('rekening','withdraws','bank_withdraws','saldo_tercatat'))->with('saldo');
        }
        else{
            return view('investasi.mitra.rekening', compact('rekening','withdraws','saldo_tercatat'))->with('saldo');
        }
    
    }
    public function tambahBank(Request $request)
    {
        Mitra_bank::create([
            'id_mitra' => Auth::user()->id_mitra,
            'bank_name' => $request->bank_name,
            'name' => $request->name,
            'norek' => $request->norek
        ]);
        Alert::toast('Tambah Rekening Bank Berhasil!', 'success');
        return redirect('/mitra/rekening-mitra');
    }

    public function tarikSaldo(Request $request)
    {
        Mitra::where('id_mitra',Auth::user()->id_mitra)->decrement('saldo',$request->jumlah);
        Mitra_withdraw::create([
            'id_mitra' => Auth::user()->id_mitra,
            'id_bank' => $request->id_bank,
            'jumlah' => $request->jumlah,
            'status' => 1
        ]);
        Alert::toast('Permintaan Tarik Saldo Berhasil!', 'success');
        return redirect('/mitra/rekening-mitra');
    }

    public function nyoba(Request $request)
    {
        dd($request->file('gambar'));
    }
    public function test()
    {
        return view('investasi.nyoba');
    }

    public function progressInvestasi()
    {
        return view('investasi.mitra.progress');
    }
}
