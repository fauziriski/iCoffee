<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akt_tujuan extends Model
{
    protected $table = 'akt_tujuan';

	protected $fillable = ['nama_tujuan'];
    public $timestamps = true;

    public function tujuan()
    {
    	return $this->hasMany('App\Akt_jurnal');
    }
}
