<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok_tani extends Model
{
    protected $table = 'kelompok_tani';
    protected $fillable = ['nama_kelompok','deskripsi','alamat','jumlah_petani','gambar','id_pengguna'];
    public $timestamps = true;
    
}
