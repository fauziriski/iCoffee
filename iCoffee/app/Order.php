<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id_pelanggan','id_alamat','nama','status','invoice','payment','shipping','pesan','id_penjual','total_bayar',
    ];
    
    public $timestamps = true;

    public function addresses()
    {
    	return $this->belongsTo('App\Address', 'id_alamat');
    }
}

