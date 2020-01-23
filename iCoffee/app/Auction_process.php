<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_process extends Model
{
    protected $fillable = [
        'id_produk', 'id_pelelang', 'id_penawar', 'penawaran', 'pemenang', 'kelipatan', 'status','nama'
    ];

    public $timestamps = true;
}
