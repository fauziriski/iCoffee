<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mitra_withdraw extends Model
{
    protected $fillable = ['id_mitra','id_bank','jumlah','status'];
}
