<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_tranksaksi extends Model
{
    protected $table = 'adm_tranksaksi';

    protected $fillable = ['nama_tran'];

    public $timestamps = true;


}