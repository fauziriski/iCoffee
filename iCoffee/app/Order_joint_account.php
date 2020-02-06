<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_joint_account extends Model
{
    protected $fillable = [
        'id_pelanggan','jumlah_top_up','kode_top_up','status',
    ];
    
    public $timestamps = true;

}
