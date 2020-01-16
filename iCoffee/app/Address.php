<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id_pelanggan', 'nama', 'provinsi', 'kabupaten/kota', 'kode_pos', 'address', 'no_hp'
    ];

    public $timestamps = true;
}
