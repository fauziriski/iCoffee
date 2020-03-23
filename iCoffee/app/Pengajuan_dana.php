<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan_dana extends Model
{
    protected $fillable = ['produk','harga','jumlah','total','kode_produk','progress','status'];
}
