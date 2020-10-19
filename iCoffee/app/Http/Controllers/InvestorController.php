<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investor;
use Illuminate\Support\Facades\Auth;
use App\invest_order;
use App\Invest_product;
use App\Invest_confirm;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class InvestorController extends Controller
{
    public function formInvestor()
    {
        $id = Investor::where('id_pengguna',Auth::id())->first('status');

        return view('investasi.form-investor', compact('id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ktp' => 'required|image|max:2048',
            'no_ktp' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $id_pengguna = Auth::id();
        $folderPath = public_path("Uploads/Investasi/Investor/{$id_pengguna}");
        mkdir($folderPath);

        $inputan = array('ktp', 'npwp');
    
        for($i=0;$i<2;$i++){
            if($request->hasfile($inputan[$i])){
                $file = $request->file($inputan[$i]);
                $filename = $file->getClientOriginalName();
                $filenames = str_replace(" ","_",$filename);
                $inputan[$i] = $filenames;
                $file->move($folderPath,$filenames);
            }
            else{
                $inputan[$i] = null;
            }
        }

        Investor::create([
            'id_pengguna' => $id_pengguna,
            'no_ktp' => $request->no_ktp,
            'no_npwp' => $request->no_npwp,
            'ktp' => $inputan[0],
            'npwp' => $inputan[1],
            'status' => 1
        ]);
        Alert::toast('Registrasi Investor Berhasil!', 'success');
        return redirect('/jadi-investor');
    }

    public function profile()
    {
        return view('investasi.profil');
    }

    public function confirm()
    {
        $order = invest_order::where('id_investor', Auth::id())->where('status',1)->get();

        foreach($order as $ord){
            $produk[] = Invest_product::where('id', $ord->id_produk)->get();
        }
        
        // $produk = Invest_produk::where('id',$)
        return view('investasi.konfirmasi',compact('order','produk'));
    }

    public function confirmStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'gambar' => 'required|image|'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        if($request->hasfile('gambar')){
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->id_order.time().'.'.$extension;
            $file->move('Uploads/Investasi/Konfirmasi',$filename);
        }

        Invest_confirm::create([
            'id_investor' => Auth::id(),
            'id_order' => $request->id_order,
            'bank' => $request->nama_bank,
            'nama' => $request->nama,
            'nominal' =>$request->nominal,
            'gambar' => $filename,
            'status' => 1,
            'norek' => $request->norek
        ]);
        Alert::toast('Konfirmasi Pembayaran Berhasil!', 'success');
        return redirect('/invest/konfirmasi');
    }

    public function orderDetail()
    {
        
    }

    public function orderHistory()
    {
        $order = invest_order::where('id_investor',Auth::id())->paginate(3);
        foreach($order as $ord){
            $produk[] = Invest_product::where('id', $ord->id_produk)->get();
        }
        return view('investasi.riwayatorder',compact('order','produk'));
    }
}
