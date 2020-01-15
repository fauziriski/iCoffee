<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'kategori','updated_at',
    ];

    public $timestamps = true;

    public function shop_product()
    {
    	return $this->hasMany('App\Shop_product');
    }
    
}
