<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id_pelanggan', 'nama', 'provinsi', 'kota_kabupaten','kecamatan', 'kode_pos', 'address', 'no_hp','status',
    ];

    public $timestamps = true;


    public function province(){
    	return $this->belongsTo('App\Province', 'provinsi');
    }


    public function city(){
    	return $this->belongsTo('App\City', 'kota_kabupaten');
    }

    public function orders()
    {
    	return $this->hasMany('App\Jbcart');
    }

    public function orderdetails()
    {
    	return $this->hasMany('App\Jbcart');
    }
}
