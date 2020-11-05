<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile_admin extends Model
{
    protected $table = 'profile_admin';

    protected $fillable = [
       'alamat','no_hp','foto','role',
    ];

    public $timestamps = true;

    public function User_role()
    {
    	return $this->belongsTo('App\User', 'role','id');
    }

    
    public function users()
    {
    	return $this->belongsTo('App\User','role');
    }
}
