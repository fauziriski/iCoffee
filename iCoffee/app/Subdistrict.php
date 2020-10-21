<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $fillable = 
    [
        'province_id','city_id','name',
    ];

    public function province()
    {
    	return $this->belongsTo('App\Province', 'province_id');
    }

    public function city()
    {
    	return $this->belongsTo('App\City', 'city_id');
    }

    public function address()
    { 
        return $this->hasMany('App\Address'); 
    }

    public $timestamps = true;
}
