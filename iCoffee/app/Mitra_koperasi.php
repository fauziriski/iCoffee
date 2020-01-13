<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mitra_koperasi extends Model
{
    protected $table = 'mitra_koperasi';
    protected $fillable = ['nama_koperasi','deskripsi','alamat','jumlah_petani','gambar','ad_art','akte','ktp_pengurus'];
    public $timestamps = true;
}
