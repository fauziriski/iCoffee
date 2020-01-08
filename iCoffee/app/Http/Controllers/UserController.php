<?php

// namespace App\Http\Controllers;

// use App\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Session;
// use Alert;

// class UserController extends Controller
// {	

// 	public function daftar(){
// 		return view('daftar');
// 	}

// 	public function masuk(){
// 		return view('masuk');
// 	}

// 	public function prosesDaftar(Request $request){
// 		$this->validate($request,[
// 			'name'=>'required|string|max:255',
// 			'email'=>'required|string|email|unique:users,email',
// 			'password'=>'required|min:6|confirmed',
// 		]);

// 		$input_data=$request->all();
// 		$input_data['password']=Hash::make($input_data['password']);
// 		User::create($input_data);

// 		Alert::success('Berhasil terdaftar, silahkan login')->autoClose(2000);
// 		return redirect('masuk');
// 	}

// 	public function prosesMasuk(Request $request){
//         $input_data=$request->all();
//         if(Auth::attempt(['email'=>$input_data['email'],'password'=>$input_data['password']])){
//             Session::put('userSession',$input_data['email']);
//             Alert::success('Berhasil masuk!')->autoClose(2000);
//             return redirect('/');
//         }else{
//             Alert::error('Akun tidak valid!')->autoClose(2000);
//             return back();
//         }
//     }

//      public function keluar(){
//         Auth::logout();
//         Session::forget('userSession');
//         Alert::success('Berhasil keluar!')->autoClose(2000);
//         return redirect('/');
//     }

//     public function adminMasuk(){
// 		return view('admin.masuk-admin');
// 	}

// 	public function prosesAdminMasuk(Request $request){
//         $input_data=$request->all();
//         if(Auth::attempt(['email'=>$input_data['email'],'password'=>$input_data['password']])){
//             Session::put('adminSession',$input_data['email']);
//             Alert::success('Berhasil masuk!')->autoClose(2000);
//             return redirect('beranda');
//         }else{
//             Alert::error('Akun tidak valid!')->autoClose(2000);
//             return redirect('/');
//         }
//     }
// }