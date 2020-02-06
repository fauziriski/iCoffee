<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Adm_jurnal;
use App\Adm_kat_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use DB;
use DataTables;
use Carbon;
use Validator;

class ArusKasController extends Controller
{
	public function lihat(){
		$id = '2';
		$AKKA = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$dana_masuk = Adm_jurnal::where('id_kat_jurnal',$id)->get('total_jumlah');
		$total = 0;
		for($i=0;$i<count($dana_masuk);$i++){
			$total += $dana_masuk[$i]->total_jumlah;
		}
		return view('admin.admin-keuangan.arus-kas',compact('AKKA','total'));
	}
}
