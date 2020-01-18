<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id','nama','id_provinsi'
    ];

    public $timestamps = true;
}
