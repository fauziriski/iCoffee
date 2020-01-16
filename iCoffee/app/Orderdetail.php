<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $fillable = [
        'id_pelanggan','id_penjual','id_order','id_produk','nama_produk','invoice','jumlah','harga','total',
    ];

    
    public $timestamps = true;
}
