<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Joint_account;
use Socialite;
use App\User;
use Auth;

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
    
    protected $redirectTo = '/jual-beli';

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

      if($user->hasRole('adminuser')){

        return redirect()->route('admin.dashboard');

      }elseif ($user->hasRole('adminkeuangan')) {

        return redirect()->route('adminkeuangan.dashboard');

      }elseif ($user->hasRole('adminsuper')) {

        return redirect()->route('superadmin.dashboard');

      }
  }
    //login sosmed
    public function socialLogin($social) {
      return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
      $userSocial = Socialite::driver($social)->user();
      $user = User::where(['email' => $userSocial->getEmail()])->first();
      if ($user) {
        Auth::login($user);
        Alert::success('Berhasil Masuk !');
        return redirect('/jual-beli');
      } else {
        $users = User::firstOrCreate([
          'name'=>$userSocial->getName(),
          'email'=>$userSocial->getEmail(),
          'provider_id'=>$userSocial->getId(),
          'password'=>Hash::make($userSocial->getId()),
        ]);
        $rekber = Joint_account::create([
          'user_id' => $users->id,
          'saldo' => 0
      ]);
        Alert::success('Berhasil Masuk !');
        return redirect('/jual-beli');
      }

    }

  }
