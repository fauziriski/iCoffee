<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invest_product_image extends Model
{
    protected $table = 'invest_product_images';
    protected $fillable = [
        'id_mitra','id_produk','nama','kode_produk'
    ];

    public $timestamps = true;
}
