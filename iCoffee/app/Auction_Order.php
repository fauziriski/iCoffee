<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_Order extends Model
{
    protected $table = 'auction_orders';

    protected $fillable = [
        'id_penjual','id_pembeli','id_alamat_penjual','id_alamat_pembeli','nama','invoice','payment','shipping', 
        'pesan', 'sub_total', 'total_bayar', 'status','id_produk','tawaran_awal','jumlah'
    ];

    public $timestamps = true;
    protected $primaryKey = 'id';

    public function auction_products()
    {
        return $this->belongsTo('App\Auction_product', 'id_produk');
    }

    public function auction_delivery()
    {
        return $this->hasOne('App\Auction_delivery');
    }

    public function addresses_penjual()
    {
    	return $this->belongsTo('App\Address', 'id_alamat_penjual');
    }

    public function addresses_pembeli()
    {
    	return $this->belongsTo('App\Address', 'id_alamat_pembeli');
    }
    

}
