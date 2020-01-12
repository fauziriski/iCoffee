<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id_pelanggan','id_produk','nama_gambar','kode_produk'
    ];

    public $timestamps = true;


    
}
