<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Address;
use App\Profile_admin;
use App\Model_has_role;
use DataTables;
use App\City;
use App\Province;
use DB;
use Carbon;



class KelolaPenggunaController extends Controller
{
	public function dataPelanggan(){

		if(request()->ajax())
		{	
			
			$pelanggan = Model_has_role::with('user')->whereRoleId(5)->get()->pluck('user');

			 return datatables()->of($pelanggan)
			->addColumn('action', function($data){
				$button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm py-0"mb-1><i class="fa fa-edit"></i> Ubah</button>'.'&nbsp;&nbsp;'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0 delete"><i class="fa fa-trash"></i> Hapus</button>';
				$button .= '&nbsp;&nbsp;';
				if($data->provider_id == "icoffee_id"){
				$button .= 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0 mb-1"><i class="fa fa-eye"></i> Profile</button>'.'&nbsp&nbsp';
				
				}	
				return $button;
			})

			->addColumn('created_at', function($data){
				$waktu =  $data->created_at->diffForHumans();  
				return $waktu;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.super-admin.data-pelanggan');
	}

	public function lihatPelanggan($id)
	{
		if(request()->ajax()){

			$get = User::find($id);
			$data = Address::where('id_pelanggan', $get->id)->where('status',"1")->first();
			$provinsi = $data->province->nama;
			$kota = $data->city->nama;
			
			return response()->json([
				'data' => $data,
				'provinsi' => $provinsi,
				'kota' => $kota
			]);
		}
	}

	public function store(Request $request)
    {
       $rules = array(
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    );

       $error = Validator::make($request->all(), $rules);

       if($error->fails())
       {
        return response()->json(['errors' => $error->errors()->all()]);
    }

	$user = User::create([
		'name' => $request->name,
		'email' => $request->email,
		'password' => Hash::make($request->password),
		'provider_id' => 'icoffee',
	]);

	$user->assignRole('user');

    return response()->json(['success' => 'Data berhasil ditambah.']);
}

public function edit($id)
{
    if(request()->ajax())
    {
		$data = User::findOrFail($id);
        return response()->json([
			'data' => $data
			]);
    }
}

public function update(Request $request)
{
	$rules = array(
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
 );

	$error = Validator::make($request->all(), $rules);

	if($error->fails())
	{
	 return response()->json(['errors' => $error->errors()->all()]);
 }


	$user = User::where('id', $request->hidden_id)->first();

	$user_update = $user->update([
		'name' => $request->name,
		'email' => $request->email,
		'password' => Hash::make($request->password),

	]);

    return response()->json(['success' => 'Data berhasil di ubah.']);
}

	public function hapusPelanggan($id)
	{

		$data1 = User::findOrFail($id);
		$data2 = Model_has_role::where('model_id',$id);
		$data1->delete();
		$data2->delete();
		return response()->json(['success' => 'Data berhasil di hapus.']);

	}


}
