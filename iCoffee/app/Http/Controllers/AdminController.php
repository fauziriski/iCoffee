<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function validasiPembeli(){
    	return view('admin.validasi-pembeli');
    }

}
