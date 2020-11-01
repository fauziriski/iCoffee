<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rincian_pengajuan extends Model
{
    protected $fillable = ['pengajuan_dana_id','produk','harga','qty','jumlah'];

    public function pengajuan_dana()
    {
        return $this->belongsTo('App\Pengajuan_dana');
    }
}
