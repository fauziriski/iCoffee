<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id_pelanggan','id_produk','nama_gambar',
    ];

    public $timestamps = true;
}
