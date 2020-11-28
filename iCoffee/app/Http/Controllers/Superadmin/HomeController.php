<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model_has_role;
use App\Shop_product;
use App\Auction_product;
use App\Invest_product;
use App\Artikel_blog;
use App\Kategori_artikel;
use Analytics;
use Spatie\Analytics\Period;

class HomeController extends Controller
{
	public function index(){

		$pelanggan = count(Model_has_role::where('role_id', 5)->get());
		$admin_user = count(Model_has_role::where('role_id', 4)->get());
		$admin_keuangan = count(Model_has_role::where('role_id', 2)->get());
		$super_admin = count(Model_has_role::where('role_id', 1)->get());

		$total = $pelanggan + $admin_user + $admin_keuangan + $super_admin;

		$kategori1 = array('Admin-Keuangan', 'Pelanggan', 'Admin-User' , 'Super-Admin');
		$data1  = array($admin_keuangan,$pelanggan,$admin_user, $super_admin);

		$produk_jb = count(Shop_product::All());
		$produk_lelang = count(Auction_product::where('status',"2")->get());
		$produk_invest = count(Invest_product::where('status',"2")->get()); 
		   
		$kategori2 = array('Jual-Beli', 'Lelang', 'Investasi');
		$data2  = array($produk_jb,$produk_lelang,$produk_invest);
		$total_produk = $produk_jb + $produk_lelang + $produk_invest;

		$user = count(User::All());
		$artikel = count(Artikel_blog::All());
		$kat_artikel = count(Kategori_artikel::All());

		return view('admin.super-admin.beranda',[
		
			'admin_user' => $admin_user,
			'admin_keuangan' => $admin_keuangan,
			'total' => $total,
			'kategori1' => $kategori1,
			'data1' => $data1,
			'kategori2' => $kategori2,
			'data2' => $data2,
			'total_produk' => $total_produk,
			'user' => $user,
			'artikel' => $artikel,
			'kat_artikel' => $kat_artikel
		]);
	}
}
