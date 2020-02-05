<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_winner extends Model
{
    protected $fillable = [
        'id','id_pemenang','id_pelelang','id_produk_lelang','jumlah_penawaran','status'
    ];

    public $timestamps = true;
}
