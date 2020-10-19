<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Confirm_payment;
use DB;
use Carbon;
use App\User;
use Auth;
use App\Profile_admin;
use App\Model_has_role;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Hash;
use Storage;


class HomeController extends Controller
{
	public function index(){

		$data = DB::table('Confirm_payments')
		->select(
			DB::raw('YEAR(created_at) as year'),
			DB::raw('SUM(jumlah_transfer) as sum')
		)
		->where('status',"3")
		->groupBy('year')
		->get();     

		for($i=0; $i<count($data); $i++){
			$tahun[] = $data[$i]->year;
			$jumlah[]=$data[$i]->sum;
		}

		return view('admin.admin-keuangan.beranda',['jumlah' => $jumlah, 'tahun' => $tahun]);

	}

	public function adminProfile(){
        $data = Profile_admin::where('role',Auth::user()->id)->first();
		$data2 = User::where('id',Auth::user()->id)->first();
		$role_id = Model_has_role::where('model_id', Auth::user()->id)->first();
		$role = $role_id->roles->name;

		if($data == NULL){
			return view('admin.admin-keuangan.tambah-profile',compact('data2','role'));
		}else{
			return view('admin.admin-keuangan.admin-profile', compact('data','data2','role'));
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
			
		}
    
		Alert::success('Berhasil diupdate !');
		
		$data = DB::table('Confirm_payments')
		->select(
			DB::raw('YEAR(created_at) as year'),
			DB::raw('SUM(jumlah_transfer) as sum')
		)
		->where('status',"3")
		->groupBy('year')
		->get();     

		for($i=0; $i<count($data); $i++){
			$tahun[] = $data[$i]->year;
			$jumlah[]=$data[$i]->sum;
		}

		return view('admin.admin-keuangan.beranda',['jumlah' => $jumlah, 'tahun' => $tahun]);
        
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
		$data = DB::table('Confirm_payments')
		->select(
			DB::raw('YEAR(created_at) as year'),
			DB::raw('SUM(jumlah_transfer) as sum')
		)
		->where('status',"3")
		->groupBy('year')
		->get();     

		for($i=0; $i<count($data); $i++){
			$tahun[] = $data[$i]->year;
			$jumlah[]=$data[$i]->sum;
		}

		return view('admin.admin-keuangan.beranda',['jumlah' => $jumlah, 'tahun' => $tahun]);
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
		$data = DB::table('Confirm_payments')
		->select(
			DB::raw('YEAR(created_at) as year'),
			DB::raw('SUM(jumlah_transfer) as sum')
		)
		->where('status',"3")
		->groupBy('year')
		->get();     

		for($i=0; $i<count($data); $i++){
			$tahun[] = $data[$i]->year;
			$jumlah[]=$data[$i]->sum;
		}

		return view('admin.admin-keuangan.beranda',['jumlah' => $jumlah, 'tahun' => $tahun]);
        
    }
}
