<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'id_pengiriman','asal','tujuan','ongkos_kirim',
    ];

    public $timestamps = true;

    public function delivery_category()
    {
    	return $this->belongsTo('App\Delivery_category', 'id_pengiriman');
    }

}
