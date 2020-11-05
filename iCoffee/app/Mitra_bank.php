<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mitra_bank extends Model
{
    protected $fillable = ['id_mitra','bank_name','name','norek'];

    public function mitra()
    {
        return $this->belongsTo('App\Mitra');
    }
}
