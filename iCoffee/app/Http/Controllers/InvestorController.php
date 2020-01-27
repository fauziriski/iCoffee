<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investor;
use Illuminate\Support\Facades\Auth;

class InvestorController extends Controller
{
    public function formInvestor()
    {
        $id = Investor::where('id_pengguna',Auth::id())->get();
        return view('investasi.form-investor', compact('id'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'ktp' => 'required|image|max:2048',
            'no_ktp' => 'required'
        ]);
        
        $id_pengguna = Auth::id();

        $folderPath = public_path("Uploads\Investasi\Investor\{$id_pengguna}");
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
        return redirect('jadi-investor')->with('status', 'Data anda berhasil disimpan!');
    }
}
