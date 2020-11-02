<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan_dana extends Model
{
    protected $fillable = ['id_mitra','judul','deskripsi','total','kode_produk','status'];

    public function rincian_pengajuan()
    {
        return $this->hasMany('App\Rincian_pengajuan');
    }
}
