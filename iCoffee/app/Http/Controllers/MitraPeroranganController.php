<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mitra_perorangan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class MitraPeroranganController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kartu_keluarga'  => 'required|mimes:doc,docx,pdf|max:2048',
            'surat_nikah'  => 'required|mimes:doc,docx,pdf|max:2048',
            'email' => 'unique:users,email',
            'no_hp' => 'unique:mitra_perorangan,no_hp'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $timestamps = date('YmdHis');
        $foldername = $request->email.'-'.$timestamps;
        $folderPath = public_path("Uploads\Mitra_Perorangan\{$foldername}");
        $response = mkdir($folderPath);
        $filenames = array();
        
        $inputan = array('gambar', 'kartu_keluarga', 'surat_nikah');
        for($i=0;$i<3;$i++){
            if($request->hasfile($inputan[$i])){
                $file = $request->file($inputan[$i]);
                $filename = $file->getClientOriginalName();
                $filenames = str_replace(" ","_",$filename);
                $inputan[$i] = $filenames;
                $file->move($folderPath,$filenames);
            }
        }
        
        $mitra = Mitra_perorangan::create([
            'nama_perorangan' => $request->nama_perorangan,
            'alamat' => $request->alamat,
            'jumlah_petani' => $request->jumlah_petani,
            'deskripsi' => $request->deskripsi,
            'gambar' => $inputan[0],
            'kartu_keluarga' => $inputan[1],
            'surat_nikah' => $inputan[2],
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'kode' => $foldername

            
    
        ]);
        $id = $mitra->id;
        $mitra = Mitra_perorangan::find($id);
        $mitra->id_mitra = 'PR'.$id;
        $mitra->save();

        Alert::toast('Registrasi Berhasil!', 'success');
        return redirect('jadi-mitra');
    }
}
