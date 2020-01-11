<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class KelolaPenggunaController extends Controller
{
	public function dataPelanggan(){
		$user = User::all();
		return view('admin.super-admin.data-pelanggan',['user' => $user]);
	}
}
