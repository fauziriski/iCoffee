<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_product extends Model
{

    protected $fillable = 
    [
        'id_pelanggan','id_kategori','nama_produk','detail_produk','stok','harga','gambar','kode_produk', 'status'
    ];

    public $timestamps = true;

    public function category()
    {
    	return $this->belongsTo('App\Category', 'id_kategori');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id_pelanggan');
    }

    public function jbcart()
    {
    	return $this->hasMany('App\Jbcart');
    }


}
