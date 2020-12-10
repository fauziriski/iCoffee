<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LaporanPenjualanController extends Controller
{
    public function index(){
        return view('investasi.mitra.laporan');
    }

    public function riwayatIndex(){
        return view('investasi.mitra.riwayat-penjualan');
    }
}
