<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel_blog extends Model
{
    protected $table = 'artikel_blog';
    
    protected $fillable = 
    [
        'judul','body','slug','gambar','kategori_artikel_id'
    ];

    public $timestamps = true;

    public function kategori_artikel()
    {
    	return $this->belongsTo('App\Kategori_artikel', 'kategori_artikel_id','id');
    }


}
