<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan_penjualan extends Model
{
    protected $fillable = ['kode_produk','berat_produk','harga_jual','foto_produk','foto_nota','status'];
}
