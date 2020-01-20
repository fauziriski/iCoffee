<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_image extends Model
{
    protected $table = 'auction_images';
    protected $fillable = [
        'id_pelelang', 'id_produk', 'nama_gambar', 'kode_produk'
    ];

    public $timestamps = true;
}
