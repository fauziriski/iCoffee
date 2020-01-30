<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id','nama','id_provinsi'
    ];

    public $timestamps = true;

    public function category()
    {
    	return $this->belongsTo('App\Category', 'id_provinsi');
    }

    public function address(){ 
        return $this->hasMany('App\Address'); 
    }


}
