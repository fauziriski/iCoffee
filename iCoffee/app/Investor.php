<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = ['id_pengguna','no_ktp','no_npwp','ktp','npwp','status'];
}
