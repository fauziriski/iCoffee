<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'bank_name', 'no_rekening',
    ];
    public $timestamps = true;
    
}
