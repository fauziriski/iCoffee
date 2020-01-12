<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use \DataTables;

class KelolaPenggunaController extends Controller
{
	public function dataPelanggan(){
		$user = User::select('users.*');
		return DataTables::eloquent($user)->tojson();
	}
}
