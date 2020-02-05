<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_sub1_akun extends Model
{
	protected $table = 'adm_sub1_akun';

	protected $fillable = ['id_kat_akun','nama_sub','no_akun','saldo_normal'];

	public $timestamps = true;

	public function adm_kat_akun()
	{
		return $this->belongsTo('App\Adm_kat_akun', 'id_kat_akun');
	}

	public function adm_sub2_akun()
	{
		return $this->hasMany('App\Adm_sub2_akun');
	}

}
