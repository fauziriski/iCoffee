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
use App\Permission;
use App\Model_has_permission;


class KelolaAksesController extends Controller
{

    public function dataAkses(){

            
            // $datas = DB::table('users')
            // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->get();
            
            // $datas = DB::table('users')
            // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            // ->whereIn('role_id', ['1', '2', '3', '4'])
			// // ->join('model_has_permissions', 'model_has_roles.model_id', '=', 'model_has_permissions.model_id')
			// // ->groupBy('id')
            // ->get();
                    
			$datas = User::whereIn('provider_id',[97100109105110,11010510910097])->get();
            return view('admin.super-admin.data-akses', compact('datas'));
	}
	
	public function editAkses($id)
	{
			$akses = User::where('id', $id)->first();
			$role = Model_has_permission::where('model_id', $id)->pluck('permission_id')->toArray();
			$permissions = Permission::all();

			return view('admin.super-admin.edit-akses', compact('role', 'permissions','akses'));
			

	}

	public function updateAkses(Request $request)
	{	
		
		$user=User::whereId($request->id)->first();
		$user->syncPermissions($request->input('tampung'));
		$datas = User::whereIn('provider_id',[97100109105110,11010510910097])->get();

	
		Alert::success('Berhasil Diubah !');
        return view('admin.super-admin.data-akses', compact('datas'));
	}
}