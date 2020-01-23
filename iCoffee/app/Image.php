<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id_pelanggan','id_produk','nama_gambar','kode_produk'
    ];

    public $timestamps = true;

 public function shop_products()
    {
    	return $this->hasOne('App\Shop_products', 'id', 'id_produk');
    }
    
}
