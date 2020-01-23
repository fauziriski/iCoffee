<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:mitra');
    }

    public function index()
    {
        return view('investasi.pasang');
    }
}