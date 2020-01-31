<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invest_order extends Model
{
    protected $fillable = ['id_produk','id_investor','id_bank','id_mitra','qty','total','status'];
}
