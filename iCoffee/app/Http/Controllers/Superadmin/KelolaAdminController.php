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


class KelolaAdminController extends Controller
{
	public function dataAdmin(){

		if(request()->ajax())
		{	
            
			$admin = User::whereIn('provider_id',[97100109105110,11010510910097])->get();
			
		 	return datatables()->of($admin)
			->addColumn('action', function($data){
				$button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm py-0"mb-1><i class="fa fa-edit"></i> Ubah</button>'.'&nbsp;&nbsp;'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0 delete"><i class="fa fa-trash"></i> Hapus</button>';
				$button .= '&nbsp;&nbsp;';
				if($data->provider_id == "11010510910097"){
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

		return view('admin.super-admin.data-admin');
	}


	public function lihat($id)
	{
		if(request()->ajax()){

			$get = User::find($id);
			$data = Profile_admin::where('role', $get->id)->first();

			$role_id = Model_has_role::where('model_id',$id)->first();
			$role = $role_id->roles->name;
			
			return response()->json([
				'data' => $data,
				'get' => $get,
				'role' => $role,
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

    $provider_id = "97100109105110";

	$user = User::create([
		'name' => $request->name,
		'email' => $request->email,
		'password' => Hash::make($request->password),
		'provider_id' => $provider_id,
	]);

	$user->assignRole('adminuser');
	$user->givePermissionTo('read');

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

	public function hapus($id)
	{

		$data1 = User::findOrFail($id);
		$data2 = Model_has_role::where('model_id',$id);
		$data1->delete();
		$data2->delete();
		return response()->json(['success' => 'Data berhasil di hapus.']);

    }
    
    public function adminProfile(){
        $data = Profile_admin::where('role',Auth::user()->id)->first();
		$data2 = User::where('id',Auth::user()->id)->first();
		$role_id = Model_has_role::where('model_id', Auth::user()->id)->first();
		$role = $role_id->roles->name;

		if($data == NULL){
			return view('admin.super-admin.tambah-profile',compact('data2','role'));
		}else{
			return view('admin.super-admin.admin-profile', compact('data','data2','role'));
		}
      
    }

    public function profileUpdate(Request $request){

		$rules = array(
				'nama' => 'required',
			    'no_hp' => 'required|max:13',
			    'alamat' => 'required|string|max:255',
			    'foto' => 'mimes:jpeg,bmp,png|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
		 return response()->json(['errors' => $error->errors()->all()]);
	 }
		
        if (empty($request->file('foto'))) {
			$data2 = Profile_admin::where('role',Auth::user()->id)->first();
            $data2->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
			]);
			$data3 = User::where('id',Auth::user()->id)->first();
			$data3->update([
				'name' => $request->nama,
			]);
			$provider = User::where('id',$id_admin);
            $provider->update([
                'provider_id' => "11010510910097",
			]);
			
        } else {

			$data2 = Profile_admin::where('role',Auth::user()->id)->first();
			Storage::delete($data2->foto);
            $data2->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'foto' => $request->file('foto')->store('Foto_profile'),
			]);
			$data3 = User::where('id',Auth::user()->id)->first();
			$data3->update([
				'name' => $request->nama,
			]);
			
			$provider = User::where('id',$id_admin);
            $provider->update([
                'provider_id' => "11010510910097",
            ]);
			
		}
    
        Alert::success('Berhasil diupdate !');
      
        return view('admin.super-admin.beranda');
        
    }

    public function tambahProfile(Request $request){

		$this->validate($request, [
            'no_hp' => 'required|max:13',
            'alamat' => 'required|string|max:255',
            'foto' => 'required|mimes:jpeg,bmp,png|max:2048'
        ]);
        if (empty($request->file('foto'))) {
            Profile_admin::create([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
			]);
        } else {
            $id_admin = Auth::user()->id;
            Profile_admin::create([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'foto' => $request->file('foto')->store('Foto_profile'),
                'role' => $id_admin,
            ]);
            $provider = User::where('id',$id_admin);
            $provider->update([
                'provider_id' => "11010510910097",
            ]);
        }

		Alert::success('Berhasil disimpan !');
      
		return view('admin.super-admin.beranda');	
        
	}
	
	public function profile2Update(Request $request){

		$rules = array(
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
		 return response()->json(['errors' => $error->errors()->all()]);
	 }

			$data2 = User::where('id',Auth::user()->id)->first();
            $data2->update([
				'email' => $request->email,
				'password' => Hash::make($request->password),
			]);

        Alert::success('Berhasil diupdate !');
      
        return view('admin.super-admin.beranda');
        
    }


}
