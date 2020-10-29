<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Address;
use App\Profile_admin;
use App\Model_has_role;
use DataTables;
use App\City;
use App\Province;
use DB;
use Carbon;
use Storage;


class KelolaRoleController extends Controller
{

    public function dataRole(){

    
        if(request()->ajax())
		{	
            
            $datas = DB::table('users')
			->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
			->whereIn('provider_id',[97100109105110,11010510910097,117115101114,114101115117])->get();
					
             return datatables()->of($datas)
             
			->addColumn('action', function($data){
				$button ='<button type="button" name="edit" id="'.$data->id.'" class="edit role btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-edit"></i> ganti role</button>'. '&nbsp';
				return $button;
			
            })
            
            ->addColumn('role', function($data){
				if ($data->role_id == "1") {
					$role = '<span class="badge badge-danger">admin-super</span>';
				}elseif ($data->role_id == "2") {
					$role = '<span class="badge badge-warning">admin-keuangan</span>';
				}elseif ($data->role_id == "3") {
					$role = '<span class="badge badge-secondary">admin-web</span>';
				}elseif ($data->role_id == "4") {
					$role = '<span class="badge badge-success">admin-user</span>';
				}else{
					$role = '<span class="badge badge-info">user-pelanggan</span>';
				}

				return $role;
            })
            
            ->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

		
			->rawColumns(['action','role'])
			->make(true);
		}

		$list = Role::All();
		return view('admin.super-admin.data-role', compact('list'));
	}
	
	public function editRole($id)
	{
		if(request()->ajax())
		{	
			$data = Model_has_role::where('model_id',$id)->first();
			$role = $data->roles->name;
			
			return response()->json([
				'role' => $role,
				'data' => $data,
			]);
		}

	}

	public function updateRole(Request $request)
	{		
		$profile = Profile_admin::where('role',$request->hidden_id)->first();
		if($request->role_baru == '5'){

		$user=User::whereId($request->hidden_id)->first();
		$user->roles()->sync($request->role_baru);
		$user->revokePermissionTo(['create','read','update','delete','verification']);
		$up = $user->update([
			'provider_id' => "117115101114",
		]);
		
		}elseif($profile == NULL){
			
		$user=User::whereId($request->hidden_id)->first();
		$user->roles()->sync($request->role_baru);
		$user->revokePermissionTo(['create','update','delete','verification']);
		$user->givePermissionTo('read');
		$up = $user->update([
			'provider_id' => "97100109105110",
		]);
	}else{
		$user=User::whereId($request->hidden_id)->first();
		$user->roles()->sync($request->role_baru);
		$user->revokePermissionTo(['create','update','delete','verification']);
		$user->givePermissionTo('read');
		$up = $user->update([
			'provider_id' => "11010510910097",
		]);
	}
		
		return response()->json(['success' => 'Berhasil diubah']);

	}
}