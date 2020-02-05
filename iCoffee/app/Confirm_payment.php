<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirm_payment extends Model
{
    protected $fillable = [
        'id','email','no_rekening_pengirim','nama_bank_pengirim', 'nama_pemilik_pengirim', 'jasa', 'no_telp', 'jumlah_transfer','invoice', 'id_pelanggan',
        'foto_bukti', 'status'
    ];

    public $timestamps = true;
}
