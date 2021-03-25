<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms_and_condition extends Model
{
    protected $fillable = [
        'type', 'branch', 'text', 'status'
    ];

    public $timestamps = true;
}
