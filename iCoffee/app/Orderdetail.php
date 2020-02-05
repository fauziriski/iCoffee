<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $fillable = [
        'id_pelanggan','id_penjual','id_order','id_produk','nama_produk','invoice','jumlah','harga','total','kode_produk','gambar', 
        'id_alamat_penjual',
    ];

    
    public $timestamps = true;

    public function addresses()
    {
    	return $this->belongsTo('App\Address', 'id_alamat_penjual');
    }
}
