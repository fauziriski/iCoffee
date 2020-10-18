<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countrydialcode extends Model
{
    protected $fillable = 
    [
        'name', 'code', 'callingCode',
    ];

    public $timestamps = true;
}
