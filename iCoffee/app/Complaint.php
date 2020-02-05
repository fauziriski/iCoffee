<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'id_pelanggan','id_order','invoice','keterangan','email','gambar','id_penjual','status',
    ];
    
    public $timestamps = true;
}
