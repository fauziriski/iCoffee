<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'id','nama'
    ];

    public $timestamps = true;

    public function address(){ 
        return $this->hasMany('App\Address'); 
    }

    public function city(){ 
        return $this->hasMany('App\City'); 
    }
}
