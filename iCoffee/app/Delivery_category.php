<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_category extends Model
{
    protected $fillable = [
        'id','nama_pengiriman',
    ];

    public $timestamps = true;

    public function delivery()
    {
    	return $this->hasMany('App\Delivery');
    }
}
