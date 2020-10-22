<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investor_Bank extends Model
{
    protected $table = 'investor_banks';
    protected $fillable = ['investor_id','bank_name','name','norek'];
}
