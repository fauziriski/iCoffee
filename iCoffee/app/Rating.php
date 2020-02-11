<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'id_penjual','id_pembeli','id_order','invoice','rating','jasa'
    ];

    public $timestamps = true;
}
