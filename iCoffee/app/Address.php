<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id_pelanggan', 'nama', 'provinsi', 'kota_kabupaten','kecamatan', 'kode_pos', 'address', 'no_hp','status',
    ];

    public $timestamps = true;
}
