<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_product extends Model
{
    protected $fillable = [
        'id_pengguna','id_kategori','nama_produk','stok','harga','gambar',
    ];

    public $timestamps = true;
}
