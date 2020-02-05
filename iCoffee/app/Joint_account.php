<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joint_account extends Model
{
    protected $fillable = [
        'user_id','saldo',
        ];

    public $timestamps = true;

    public function users()
    {
    	return $this->belongsTo('App\User','user_id');
    }

}
