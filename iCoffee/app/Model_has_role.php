<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model_has_role extends Model
{
    protected $fillable = [
        'role_id','model_id',
    ];

    public $timestamps = true;

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'model_id');
    }
}

