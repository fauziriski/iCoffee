<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $fillable = [
        'id_pelanggan','id_penjual','id_order','id_produk','nama_produk','invoice','jumlah','harga','total','kode_produk','gambar',
    ];

    
    public $timestamps = true;
}
