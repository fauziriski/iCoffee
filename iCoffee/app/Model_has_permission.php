<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model_has_permission extends Model
{
    protected $fillable = [
        'permission_id','model_id',
    ];

    public $timestamps = true;

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'model_id');
    }

    public function roles()
    {
    	return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function permissions()
    {
    	return $this->hasOne('App\Permission', 'id', 'permission_id');
    }
    
}
