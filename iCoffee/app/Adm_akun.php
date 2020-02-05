<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_akun extends Model
{
	protected $table = 'adm_akun';

	protected $fillable = ['id_adm_jurnal','nama_akun','posisi','kurs','jumlah'];

	public $timestamps = true;

}