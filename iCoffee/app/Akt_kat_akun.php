<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akt_kat_akun extends Model
{

    protected $table = 'akt_kat_akun';

	protected $fillable = ['nama_kategori','saldo_normal'];
    public $timestamps = true;

    public function akun()
    {
    	return $this->hasMany('App\Akt_akun');
    }

   
}
