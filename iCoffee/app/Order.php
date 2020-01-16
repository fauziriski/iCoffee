<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['nama_perorangan','deskripsi','alamat','jumlah_petani','gambar','kartu_keluarga','surat_nikah'];
    public $timestamps = true;
}

