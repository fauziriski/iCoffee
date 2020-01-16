<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invest_product extends Model
{
    protected $table = 'invest_product';
    protected $fillable = ['id_mitra','id_kategori','nama_produk','detail_produk','gambar','harga','stok','roi','periode','profit_periode'];
    public $timestamps = true;

    public function category()
    {
    	return $this->belongsTo('App\Category', 'id_kategori');
    }
}
