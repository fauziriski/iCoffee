<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mitra_tervalidasi;

class MitraController extends Controller
{

    public function index()
    {
        return view('investasi.pasang');
    }

    public function showLoginForm()
    {
        return view('investasi.mitra.login-mitra');
    }

    public function login(Request $request)
    {
        if(Mitra_tervalidasi::where('email',$request->email)->where('password',$request->password)->first()){
            dd($request->email);
        }
        dd($request);
    }
}