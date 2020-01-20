<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_product extends Model
{
    protected $fillable = [
        'id_pelelang', 'nama_produk', 'desc_produk', 'kelipatan', 'harga_awal', 'lama_lelang', 'status', 'gambar', 'kode_lelang','id_kategori'
    ];

    public $timestamps = true;
}