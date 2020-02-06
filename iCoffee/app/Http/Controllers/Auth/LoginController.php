<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Joint_account;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
      $cek_rekber = Joint_account::where('user_id', $user->id)->first();

      if( empty($cek_rekber) )
      {
        $rekber = Joint_account::create([
          'user_id' => $user->id,
          'saldo' => 0
        ]);
      }

      Alert::success('Berhasil Masuk');

      if($user->hasRole('admin')){
        return redirect()->route('admin.dashboard');
      }elseif ($user->hasRole('superadmin')) {
        return redirect()->route('superadmin.dashboard');
      }elseif ($user->hasRole('adminkeuangan')) {
        return redirect()->route('adminkeuangan.dashboard');
      }


      if($user->hasRole('admin'))
      {
        return redirect()->route('admin.dashboard');

      }elseif ($user->hasRole('superadmin')) 
      {
        return redirect()->route('superadmin.dashboard');
      }

    }

  }
