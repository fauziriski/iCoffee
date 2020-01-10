<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
	public function validasiPembeli(){
		return view('admin.validasi-pembeli');
	}
}
