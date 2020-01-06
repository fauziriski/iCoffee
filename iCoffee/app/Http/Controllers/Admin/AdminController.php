<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
    	return view('admin.beranda');
    }

    public function validasiPembeli(){
    	return view('admin.validasi-pembeli');
    }

    public function laporanPenjualan(){
    	return view('admin.laporan-penjualan');
    }

    public function validasiProdukLelang(){
        return view('admin.validasi-produk-lelang');
    }

    public function jenisProduk(){
        return view('admin.jenis-produk');
    }

    public function prosesLelang(){
        return view('admin.proses-lelang');
    }

    public function laporanLelang(){
        return view('admin.laporan-lelang');
    }

    public function kelompokPetani(){
        return view('admin.kelompok-petani');
    }

    public function produkInvestasi(){
        return view('admin.produk-investasi');
    }

    public function progresInvestasi(){
        return view('admin.progres-investasi');
    }

    public function pencairanInvestasi(){
        return view('admin.pencairan-investasi');
    }

    public function laporanInvestasi(){
        return view('admin.laporan-investasi');
    }

}
