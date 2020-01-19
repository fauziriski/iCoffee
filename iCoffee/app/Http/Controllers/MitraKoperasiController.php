<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mitra_koperasi;

class MitraKoperasiController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[

            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ad_art'  => 'required|mimes:doc,docx,pdf|max:2048',
            'akte'  => 'required|mimes:doc,docx,pdf|max:2048',
            'ktp_pengurus'  => 'required|mimes:doc,docx,pdf|max:2048',
            'email' => 'unique:users,email',
            'no_hp' => 'unique:mitra_koperasi,no_hp'
        ]);
        $foldername = $request->no_hp;
        $folderPath = public_path("Uploads\Mitra_Koperasi\{$foldername}");
        $response = mkdir($folderPath);


        $inputan = array('gambar', 'ad_art', 'akte','ktp_pengurus');
        foreach($inputan as $value){
            if($request->hasfile($value)){
                $file = $request->file($value);
                $filename = $filename = $file->getClientOriginalName();
                $file->move($folderPath,$filename);
            }
        }

        $mitra = Mitra_koperasi::create([
            'nama_koperasi' => $request->nama_koperasi,
            'alamat' => $request->alamat,
            'jumlah_petani' => $request->jumlah_petani,
            'deskripsi' => $request->deskripsi,
            'gambar' => $request->gambar->getClientOriginalName(),
            'ad_art' => $request->ad_art->getClientOriginalName(),
            'akte' => $request->akte->getClientOriginalName(),
            'ktp_pengurus' => $request->ktp_pengurus->getClientOriginalName(),
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status' => $request->status

        ]);
        $id = $mitra->id;
        $mitra = Mitra_koperasi::find($id);
        $mitra->id_mitra = 'KP'.$id;
        $mitra->save();
    }
}
