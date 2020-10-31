<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model_has_role;
use App\Shop_product;
use App\Auction_product;
use App\Invest_product;

class HomeController extends Controller
{
	public function index(){

		$pelanggan = count(Model_has_role::where('role_id', 5)->get());
		$admin_user = count(Model_has_role::where('role_id', 4)->get());
		$admin_keuangan = count(Model_has_role::where('role_id', 2)->get());
		$admin_web = count(Model_has_role::where('role_id', 3)->get());

		$total = $pelanggan + $admin_user + $admin_keuangan + $admin_web;

		$kategori1 = array('Admin-Keuangan', 'Pelanggan', 'Admin-User','Admin-Web');
		$data1  = array($admin_keuangan,$pelanggan,$admin_user,$admin_web);

		$produk_jb = count(Shop_product::All());
		$produk_lelang = count(Auction_product::where('status',"2")->get());
		$produk_invest = count(Invest_product::where('status',"2")->get()); 
		   
		$kategori2 = array('Jual-Beli', 'Lelang', 'Investasi');
		$data2  = array($produk_jb,$produk_lelang,$produk_invest);
		$total_produk = $produk_jb + $produk_lelang + $produk_invest;

		return view('admin.super-admin.beranda',[
			'pelanggan' => $pelanggan,
			'admin_user' => $admin_user,
			'admin_keuangan' => $admin_keuangan,
			'admin_web' => $admin_web,
			'total' => $total,
			'kategori1' => $kategori1,
			'data1' => $data1,
			'kategori2' => $kategori2,
			'data2' => $data2,
			'total_produk' => $total_produk
		]);
	}
}
