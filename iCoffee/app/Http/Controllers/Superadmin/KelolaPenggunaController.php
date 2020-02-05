<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model_has_role;
use DB;
use DataTables;



class KelolaPenggunaController extends Controller
{
	public function dataPelanggan(){

		if(request()->ajax())
		{	
			
			$pelanggan = Model_has_role::with('user')->whereRoleId(4)->get()->pluck('user');

			 return datatables()->of($pelanggan)
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

	public function dataAdmin(){

		if(request()->ajax())
		{	
			
			$admin = Model_has_role::with('user')->whereRoleId(2)->get()->pluck('user');
			
			 return datatables()->of($admin)
			->addColumn('action', function($data){
				$button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>';
				$button .= '&nbsp;&nbsp;';
				$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.super-admin.data-administrator');
	}

	public function hapusPengguna($id)
	{

		$data = User::findOrFail($id);
		$data->delete();
		return view('admin.super-admin.data-pelanggan');

	}


}
