<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat_penjualan extends Model
{
    protected $fillable = ['id_mitra','kode_produk','total_berat','total_penjualan','bank','nama','gambar','status'];
}