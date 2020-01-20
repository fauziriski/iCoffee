<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mitra_koperasi extends Model
{
    protected $table = 'mitra_koperasi';
    protected $fillable = ['nama_koperasi','deskripsi','alamat','jumlah_petani','gambar','ad_art','akte','ktp_pengurus','id_mitra','email','no_hp','status'];
    public $timestamps = true;
}
