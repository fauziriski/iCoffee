<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelompok_tani;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class KelompokTani extends Controller
{

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'unique:users,email',
            'no_hp' => 'unique:kelompok_tani,no_hp'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $timestamps = date('YmdHis');
        $foldername = $request->email.'-'.$timestamps;
        $folderPath = public_path("Uploads/Kelompok_Tani/{$foldername}");
        $response = mkdir($folderPath);

        if($request->hasfile('gambar')){
            $file = $request->file('gambar');
            $filename = $file->getClientOriginalName();
            $filenames = str_replace(" ","_",$filename);
            $file->move($folderPath,$filenames);


            $kelompok = Kelompok_tani::create([
                'nama_kelompok' => $request->nama_kelompok,
                'alamat' => $request->alamat,
                'jumlah_petani' => $request->jumlah,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filename,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'status' => $request->status,
                'kode' => $foldername

            ]);
            $id = $kelompok->id;
            $kelompok = Kelompok_tani::find($id);
            $kelompok->id_mitra = 'KT'.$id;
            $kelompok->save();
        }
        
        Alert::toast('Registrasi Berhasil!', 'success');
        return redirect('jadi-mitra');
    }

    public function index(){
        return view('investasi.daftar-mitra');
    }
}
