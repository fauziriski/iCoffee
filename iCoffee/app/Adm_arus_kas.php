<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_arus_kas extends Model
{
	protected $table = 'adm_arus_kas';

	protected $fillable = ['kode','nama_akun','total'];

	public $timestamps = true;
}
