<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;



class KelolaPenggunaController extends Controller
{
	public function dataPelanggan(){

		if(request()->ajax())
		{	
			
			
			// $role = DB::table('model_has_roles')->where('role_id', '3')->get();
			// $pengguna = array();
			// foreach ($role as $data) {
			// 	$pengguna[] = DB::table('users')->where('id', $data->model_id)->get();
			// }

			// $pengguna = array('role' => $pengguna);
			// return json_encode($pengguna);

			return DataTables()->of(User::latest()->get())
			->addColumn('action', function($data){
				$button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>';
				$button .= '&nbsp;&nbsp;';
				$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.super-admin.data-pelanggan');
	}

	public function hapusPengguna($id)
	{

		$data = User::findOrFail($id);
		$data->delete();
		return view('admin.super-admin.data-pelanggan');

	}


}
