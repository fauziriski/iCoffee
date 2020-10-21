<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider_id','telephone','photo',
    ];

    protected $guarded = [
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

     public function model_has_role()
    {
        return $this->belongsTo('App\Model_has_role', 'role_id');
    }

    public function shop_product()
    {
    	return $this->hasMany('App\Shop_product');
    }

    public function joint_accounts()
    {
    	return $this->hasOne('App\Joint_account');
    }
    

    public function pemenang_lelang()
    {
    	return $this->hasMany('App\Auction_winner');
    }

    public function pelelang()
    {
    	return $this->hasMany('App\Auction_winner');
    }

    public function profile_admin()
    {
    	return $this->hasOne('App\Profile_admin');
    }


   
}
