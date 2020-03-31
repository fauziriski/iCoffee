<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_akun extends Model
{
	protected $table = 'adm_akun';

	protected $fillable = ['id_adm_jurnal','nama_akun','posisi','kurs','jumlah','created_at','updated_at'];

	public function akun()
	{
		return $this->hasOne('App\Adm_jurnal', 'id', 'id_adm_jurnal');
	}

}