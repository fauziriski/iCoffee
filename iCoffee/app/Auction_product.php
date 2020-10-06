<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_product extends Model
{
    protected $fillable = [
        'id_pelelang', 'nama_produk', 'desc_produk','stok', 'kelipatan', 'harga_awal', 'lama_lelang', 'status', 'gambar', 'kode_lelang','id_kategori',
        'tanggal_mulai','tanggal_berakhir','id'
    ];

    public $timestamps = true;

    public function Auction_process()
    {
        return $this->hasMany('App\Auction_process');
    }

    public function Auction_winner()
    {
        return $this->hasMany('App\Auction_winner');
    }

    public function Auction_order()
    {
        return $this->hasMany('App\Auction_Order');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category', 'id_kategori');
    }

  
}
