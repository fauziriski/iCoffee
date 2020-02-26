<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance_withdrawal extends Model
{
    protected $fillable = [
        'user_id', 'invoice', 'jumlah', 'status','email','bank','no_rekening','pemilik_rekening',
    ];

    public $timestamps = true;
}
