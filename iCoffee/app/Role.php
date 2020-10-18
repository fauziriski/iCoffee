<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name','guard_name',
    ];

    public $timestamps = true;

    public function model_has_role()
    {
    	return $this->hasMany('App\Model_has_role');
    }

}
