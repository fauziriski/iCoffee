<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jbcart extends Model
{
    protected $fillable = [
        'id_pelanggan','id_produk','nama_produk','jumlah','harga','total','kode_produk','image','id_penjual'
    ];

    public $timestamps = true;

    public function shop_product()
    {
    	return $this->belongsTo('App\Shop_product', 'id_produk');
    }


    

    
}
