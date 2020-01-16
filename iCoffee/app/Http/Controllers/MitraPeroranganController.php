<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mitra_perorangan;

class MitraPeroranganController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[

            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kartu_keluarga'  => 'required|mimes:doc,docx,pdf|max:2048',
            'surat_nikah'  => 'required|mimes:doc,docx,pdf|max:2048'
        ]);
        $foldername = $request->nama_perorangan;
        $folderPath = public_path("Uploads\Mitra Perorangan\{$foldername}");
        $response = mkdir($folderPath);
        
        $inputan = array('gambar', 'kartu_keluarga', 'surat_nikah');
        foreach($inputan as $value){
            if($request->hasfile($value)){
                $file = $request->file($value);
                $filename = $file->getClientOriginalName();
                $file->move($folderPath,$filename);
            }
        }
        
        $mitra = Mitra_perorangan::create([
            'nama_perorangan' => $request->nama_perorangan,
            'alamat' => $request->alamat,
            'jumlah_petani' => $request->jumlah_petani,
            'deskripsi' => $request->deskripsi,
            'gambar' => $request->gambar->getClientOriginalName(),
            'kartu_keluarga' => $request->kartu_keluarga->getClientOriginalName(),
            'surat_nikah' => $request->surat_nikah->getClientOriginalName()
            
    
        ]);
        $id = $mitra->id;
        $mitra = Mitra_perorangan::find($id);
        $mitra->id_mitra = 'PR'.$id;
        $mitra->save();
    }
}
