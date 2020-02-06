<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_winner extends Model
{
    protected $fillable = [
        'id','id_pemenang','id_pelelang','id_produk_lelang','jumlah_penawaran','status'
    ];

    public $timestamps = true;

    public function auction_product()
    {
    	return $this->belongsTo('App\Auction_product', 'id_produk_lelang');
    }

    public function pemenang()
    {
    	return $this->belongsTo('App\User', 'id_pemenang');
    }

    public function pelelang()
    {
    	return $this->belongsTo('App\User', 'id_pelelang');
    }


}
