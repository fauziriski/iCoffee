<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelompok_tani;

class KelompokTani extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request,[

            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'unique:users,email',
            'no_hp' => 'unique:kelompok_tani,no_hp'
        ]);
        
        if($request->hasfile('gambar')){
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('Uploads/Kelompok_tani',$filename);


            $kelompok = Kelompok_tani::create([
                'nama_kelompok' => $request->nama_kelompok,
                'alamat' => $request->alamat,
                'jumlah_petani' => $request->jumlah,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filename,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'status' => $request->status

            ]);
            $id = $kelompok->id;
            $kelompok = Kelompok_tani::find($id);
            $kelompok->id_mitra = 'KT'.$id;
            $kelompok->save();
        }
    }

    public function index(){
        return view('investasi.daftar-mitra');
    }
}
