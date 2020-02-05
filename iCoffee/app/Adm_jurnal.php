<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_jurnal extends Model
{
	protected $table = 'adm_jurnal';

	protected $fillable = ['nama_tran','bukti','catatan','kode','tujuan_tran','id_kat_jurnal','total_jumlah'];

	public $timestamps = true;

}
