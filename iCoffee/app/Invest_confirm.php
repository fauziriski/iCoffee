<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invest_confirm extends Model
{
    protected $fillable = ['id_investor','id_order','bank','nama','nominal','gambar','status','norek'];
}
