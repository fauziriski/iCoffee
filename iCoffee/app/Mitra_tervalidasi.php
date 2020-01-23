<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Mitra_tervalidasi extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $table = 'mitra_tervalidasi';
    protected $guard = 'mitra';
    protected $fillable = ['nama_koperasi','deskripsi','alamat','jumlah_petani','gambar','id_mitra','email','no_hp','password','kode'];
    protected $hidden = ['password'];
    public $timestamps = true;
}