<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akt_akun extends Model
{
    protected $table = 'akt_akun';

	protected $fillable = ['id_kat_akun','no_akun','nama_akun'];
    public $timestamps = true;

    public function kat_akun()
    {
    	return $this->belongsTo('App\Akt_kat_akun', 'id_kat_akun','id');
    }

    public function akun_jurnal()
    {
    	return $this->belongsToMany('App\Akt_akun_jurnal');
    }
   
}
