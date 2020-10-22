<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $fillable = [
        'name','guard_name',
    ];

    public $timestamps = true;

    public function model_has_permission()
    {
    	return $this->hasMany('App\Model_has_permission');
    }

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
