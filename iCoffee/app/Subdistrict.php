<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $fillable = 
    [
        'province_id','city_id','name',
    ];

    public $timestamps = true;
}
