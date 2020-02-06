<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_Order extends Model
{
    protected $fillable = [
        'id_penjual','id_pembeli','id_alamat_penjual','id_alamat_pembeli','nama','invoice','payment','shipping', 
        'pesan', 'sub_total', 'total_bayar', 'status','id_produk',
    ];

    public $timestamps = true;

    

}
