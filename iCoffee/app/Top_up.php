<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Top_up extends Model
{
    protected $table = 'top_up';
    protected $fillable = [
        'user_id', 'invoice', 'jumlah', 'status','email','payment'
    ];

    public $timestamps = true;
}
