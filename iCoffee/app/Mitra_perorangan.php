<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mitra_perorangan extends Model
{
    protected $table = 'mitra_perorangan';
    protected $fillable = ['nama_perorangan','deskripsi','alamat','jumlah_petani','gambar','kartu_keluarga','surat_nikah','id_mitra','email','no_hp'];
    public $timestamps = true;
}
