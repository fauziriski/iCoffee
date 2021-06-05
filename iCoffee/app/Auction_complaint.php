<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_complaint extends Model
{
    protected $fillable = [
        'id_pelanggan','id_order','invoice','keterangan','email','gambar','id_penjual','status', 'video_unboxing'
    ];
    
    public $timestamps = true;
}
