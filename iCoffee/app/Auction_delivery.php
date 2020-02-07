<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_delivery extends Model
{
    protected $fillable = [
        'id_order', 'id_kategori_kurir', 'nama', 'ongkos_kirim','invoice'
    ];

    public $timestamps = true;

    public function auction_order()
    {
        return $this->belongsTo('App\Auction_Order', 'id_order');
    }
}
