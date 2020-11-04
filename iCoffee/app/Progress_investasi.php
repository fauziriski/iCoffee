<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress_investasi extends Model
{
    protected $fillable = [
        'kode_produk','judul','deskripsi','status','id_mitra'
    ];

    public function files()
    {
        return $this->hasMany('App\File_progress');
    }
}
