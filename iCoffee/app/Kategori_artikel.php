<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori_artikel extends Model
{
    protected $table = 'kategori_artikel';

    protected $fillable = [
        'nama_kategori','slug',
    ];

    public $timestamps = true;

    public function artikel_blog()
    {
    	return $this->hasMany('App\Artikel_blog');
    }
}
