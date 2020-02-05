<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_kat_akun extends Model
{
	protected $table = 'adm_kat_akun';

	protected $fillable = ['nama_kat','no_akun'];

	public $timestamps = true;

	public function adm_sub1_akun()
	{
		return $this->hasMany('App\Adm_sub1_akun');
	}

	public function adm_sub2_akun()
	{
		return $this->hasMany('App\Adm_sub2_akun');
	}

}
