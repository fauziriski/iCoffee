<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Confirm_payment;
use DB;
use Carbon;


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
}
