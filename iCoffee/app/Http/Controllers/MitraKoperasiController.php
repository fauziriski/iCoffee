<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mitra_koperasi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class MitraKoperasiController extends Controller
{
    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ad_art'  => 'required|mimes:doc,docx,pdf',
            'akte'  => 'required|mimes:doc,docx,pdf',
            'ktp_pengurus'  => 'required|mimes:doc,docx,pdf',
            'email' => 'unique:users,email',
            'no_hp' => 'unique:mitra_koperasi,no_hp'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
            
        $timestamps = date('YmdHis');
        $foldername = $request->email.'-'.$timestamps;
        $folderPath = public_path("Uploads/Mitra_Koperasi/{$foldername}");
        $response = mkdir($folderPath);
        $filenames = array();

     
        $inputan = array('gambar', 'ad_art', 'akte','ktp_pengurus');
    
        for($i=0;$i<4;$i++){
            if($request->hasfile($inputan[$i])){
                $file = $request->file($inputan[$i]);
                $filename = $file->getClientOriginalName();
                $filenames = str_replace(" ","_",$filename);
                $inputan[$i] = $filenames;
                $file->move($folderPath,$filenames);
            }
        }

        $mitra = Mitra_koperasi::create([
            'nama_koperasi' => $request->nama_koperasi,
            'alamat' => $request->alamat,
            'jumlah_petani' => $request->jumlah_petani,
            'deskripsi' => $request->deskripsi,
            'gambar' => $inputan[0],
            'ad_art' => $inputan[1],
            'akte' => $inputan[2],
            'ktp_pengurus' => $inputan[3],
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'kode' => $foldername

        ]);
        $id = $mitra->id;
        $mitra = Mitra_koperasi::find($id);
        $mitra->id_mitra = 'KP'.$id;
        $mitra->save();

        Alert::toast('Registrasi Berhasil!', 'success');
        return redirect('jadi-mitra');
    }
}
