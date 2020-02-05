<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_kat_jurnal extends Model
{
	protected $table = 'adm_kat_jurnal';

	protected $fillable = ['nama_kat','kode_kat'];

	public $timestamps = true;

}
