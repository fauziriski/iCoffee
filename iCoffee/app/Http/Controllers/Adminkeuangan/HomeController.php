<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Hash;
use Storage;
use App\Confirm_payment;
use DB;
use Carbon;
use App\User;
use Auth;
use App\Profile_admin;
use App\Model_has_role;
Use App\Adm_jurnal;


class HomeController extends Controller
{
	 
    public function index(){

		$year = Carbon::now()->format('Y');
		$month = Carbon::now()->format('m');
			
		//dana masuk jual-beli
		$data_jb[] = 0;
		$data_total_jb = Adm_jurnal::where('id_kat_jurnal','6')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_jb); $i++){
			$data_jb[] = $data_total_jb[$i]->total_jumlah;	
		}
		$masuk_jb = array_sum($data_jb);

		//dana masuk lelang
		$data_le[] = 0;
		$data_total_le = Adm_jurnal::where('id_kat_jurnal','7')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_le); $i++) {
			$data_le[] = $data_total_le[$i]->total_jumlah;
		}
		$masuk_le = array_sum($data_le);

		//dana masuk invest
		$data_in[] = 0;
		$data_total_in = Adm_jurnal::where('id_kat_jurnal','3')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_in); $i++) {
			$data_in[] = $data_total_in[$i]->total_jumlah;
		}
		$masuk_in = array_sum($data_in);

		//total kas masuk
		$total_masuk = $masuk_jb+ $masuk_le + $masuk_in;

		
		//pengeluaran pencairan
		$data_pen[] = 0;
		$data_total_pen = Adm_jurnal::where('id_kat_jurnal','8')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_pen); $i++) {
			$data_pen[] = $data_total_pen[$i]->total_jumlah;
		}
		$keluar_pen = array_sum($data_pen);
		
		//pengeluaran operasional
		$data_op[] = 0;
		$data_total_op = Adm_jurnal::where('id_kat_jurnal','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_op); $i++) {
			$data_op[] = $data_total_op[$i]->total_jumlah;
		}
		$keluar_op = array_sum($data_op);

		//pengeluaran mitra
		$data_mit[]=0;
		$data_total_mit = Adm_jurnal::where('id_kat_jurnal','5')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_mit); $i++) {		
			$data_mit[] = $data_total_mit[$i]->total_jumlah;
		}
		$keluar_mit = array_sum($data_mit);

		//total pengeluaran
		$total_keluar = $keluar_pen+ $keluar_op + $keluar_mit;

		//grafik line

		//total aruskas masuk /bulan
		$jan1[] = 0;
		$jan = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '1')->get();
		for($i=0; $i<count($jan); $i++) {
			$jan1[] = $jan[$i]->total_jumlah;		
		}
		$b1 = array_sum($jan1);

		$feb2[] = 0;
		$feb = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '2')->get();
		for($i=0; $i<count($feb); $i++) {
			$feb2[] = $feb[$i]->total_jumlah;		
		}
		$b2 = array_sum($feb2);

		$mar3[] = 0;
		$mar = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '3')->get();
		for($i=0; $i<count($mar); $i++) {
			$mar3[] = $mar[$i]->total_jumlah;		
		}
		$b3 = array_sum($mar3);

		$apr4[] = 0;
		$apr = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '4')->get();
		for($i=0; $i<count($apr); $i++) {
			$apr4[] = $apr[$i]->total_jumlah;		
		}
		$b4 = array_sum($apr4);
	
		$mei5[] = 0;
		$mei = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '5')->get();
		for($i=0; $i<count($mei); $i++) {
			$mei5[] = $mei[$i]->total_jumlah;		
		}
		$b5 = array_sum($mei5);

		$jun6[] = 0;
		$jun = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '6')->get();
		for($i=0; $i<count($jun); $i++) {
			$jun6[] = $jun[$i]->total_jumlah;		
		}
		$b6 = array_sum($jun6);

		$jul7[] = 0;
		$jul = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '7')->get();
		for($i=0; $i<count($jul); $i++) {
			$jul7[] = $jul[$i]->total_jumlah;		
		}
		$b7 = array_sum($jul7);
	
		$ags8[] = 0;
		$ags = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '8')->get();
		for($i=0; $i<count($ags); $i++) {
			$ags8[] = $ags[$i]->total_jumlah;		
		}
		$b8 = array_sum($ags8);
		
		$sep9[] = 0;
		$sep = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '9')->get();
		for($i=0; $i<count($sep); $i++) {
			$sep9[] = $sep[$i]->total_jumlah;		
		}
		$b9 = array_sum($sep9);

		$okt10[] = 0;
		$okt = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '10')->get();
		for($i=0; $i<count($okt); $i++) {
			$okt10[] = $okt[$i]->total_jumlah;		
		}
		$b10 = array_sum($okt10);

		$nov11[] = 0;
		$nov = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '11')->get();
		for($i=0; $i<count($nov); $i++) {
			$nov11[] = $nov[$i]->total_jumlah;		
		}
		$b11 = array_sum($nov11);

		$des12[] = 0;
		$des = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '12')->get();
		for($i=0; $i<count($des); $i++) {
			$des12[] = $des[$i]->total_jumlah;		
		}
		$b12 = array_sum($des12);

		$pemasukan = array($b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,$b11,$b12);

		// BATASSSSSSSSSSSSSSSSS
		//total aruskas keluar /bulan
		$ke_jan1[] = 0;
		$ke_jan = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '1')->get();
		for($i=0; $i<count($ke_jan); $i++) {
			$ke_jan1[] = $ke_jan[$i]->total_jumlah;
		}
		$ke_b1 = array_sum($ke_jan1);

		$ke_feb2[] = 0;
		$ke_feb = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '2')->get();
		for($i=0; $i<count($ke_feb); $i++) {
			$ke_feb2[] = $ke_feb[$i]->total_jumlah;
		}
		$ke_b2 = array_sum($ke_feb2);

		$ke_mar3[] = 0;
		$ke_mar = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '3')->get();
		for($i=0; $i<count($ke_mar); $i++) {
			$ke_mar3[] = $ke_mar[$i]->total_jumlah;
		}
		$ke_b3 = array_sum($ke_mar3);

		$ke_apr4[] = 0;
		$ke_apr = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '4')->get();
		for($i=0; $i<count($ke_apr); $i++) {
			$ke_apr4[] = $ke_apr[$i]->total_jumlah;
		}
		$ke_b4 = array_sum($ke_apr4);

		$ke_mei5[] = 0;
		$ke_mei = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '5')->get();
		for($i=0; $i<count($ke_mei); $i++) {
			$ke_mei5[] = $ke_mei[$i]->total_jumlah;
		}
		$ke_b5 = array_sum($ke_mei5);

		$ke_jun6[] = 0;
		$ke_jun = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '6')->get();
		for($i=0; $i<count($ke_jun); $i++) {
			$ke_jun6[] = $ke_jun[$i]->total_jumlah;
		}
		$ke_b6 = array_sum($ke_jun6);

		$ke_jul7[] = 0;
		$ke_jul = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '7')->get();
		for($i=0; $i<count($ke_jul); $i++) {
			$ke_jul7[] = $ke_jul[$i]->total_jumlah;
		}
		$ke_b7 = array_sum($ke_jul7);

		$ke_ags8[] = 0;
		$ke_ags = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '8')->get();
		for($i=0; $i<count($ke_ags); $i++) {
			$ke_ags8[] = $ke_ags[$i]->total_jumlah;
		}
		$ke_b8 = array_sum($ke_ags8);

		$ke_sep9[] = 0;
		$ke_sep = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '9')->get();
		for($i=0; $i<count($ke_sep); $i++) {
			$ke_sep9[] = $ke_sep[$i]->total_jumlah;
		}
		$ke_b9 = array_sum($ke_sep9);

		$ke_okt10[] = 0;
		$ke_okt = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '10')->get();
		for($i=0; $i<count($ke_okt); $i++) {
			$ke_okt10[] = $ke_okt[$i]->total_jumlah;
		}
		$ke_b10 = array_sum($ke_okt10);

		$ke_nov11[] = 0;
		$ke_nov = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '11')->get();
		for($i=0; $i<count($ke_nov); $i++) {
			$ke_nov11[] = $ke_nov[$i]->total_jumlah;
		}
		$ke_b11 = array_sum($ke_nov11);

		$ke_des12[] = 0;
		$ke_des = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '12')->get();
		for($i=0; $i<count($ke_des); $i++) {
			$ke_des12[] = $ke_des[$i]->total_jumlah;
		}
		$ke_b12 = array_sum($ke_des12);

		$pengeluaran = array($ke_b1,$ke_b2,$ke_b3,$ke_b4,$ke_b5,$ke_b6,$ke_b7,$ke_b8,$ke_b9,$ke_b10,$ke_b11,$ke_b12);
		
		
		return view('admin.admin-keuangan.beranda',[
			// 'kategori' => $kategori, 
			// 'data' => $data,
			'masuk_jb' => $masuk_jb,
			'masuk_le'=> $masuk_le,
			'masuk_in' => $masuk_in,
			'total_masuk' => $total_masuk,
			'keluar_pen' => $keluar_pen,
			'keluar_op' => $keluar_op,
			'keluar_mit' =>  $keluar_mit,
			'total_keluar' => $total_keluar,
			'pemasukan' => $pemasukan,
			'pengeluaran' => $pengeluaran
			]);
	
	}

	public function filter(Request $request){

		$year = Carbon::now()->format('Y');
		$month = $request->bulan;
			
		//dana masuk jual-beli
		$data_jb[] = 0;
		$data_total_jb = Adm_jurnal::where('id_kat_jurnal','6')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_jb); $i++){
			$data_jb[] = $data_total_jb[$i]->total_jumlah;	
		}
		$masuk_jb = array_sum($data_jb);

		//dana masuk lelang
		$data_le[] = 0;
		$data_total_le = Adm_jurnal::where('id_kat_jurnal','7')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_le); $i++) {
			$data_le[] = $data_total_le[$i]->total_jumlah;
		}
		$masuk_le = array_sum($data_le);

		//dana masuk invest
		$data_in[] = 0;
		$data_total_in = Adm_jurnal::where('id_kat_jurnal','3')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_in); $i++) {
			$data_in[] = $data_total_in[$i]->total_jumlah;
		}
		$masuk_in = array_sum($data_in);

		//total kas masuk
		$total_masuk = $masuk_jb+ $masuk_le + $masuk_in;

		
		//pengeluaran pencairan
		$data_pen[] = 0;
		$data_total_pen = Adm_jurnal::where('id_kat_jurnal','8')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_pen); $i++) {
			$data_pen[] = $data_total_pen[$i]->total_jumlah;
		}
		$keluar_pen = array_sum($data_pen);
		
		//pengeluaran operasional
		$data_op[] = 0;
		$data_total_op = Adm_jurnal::where('id_kat_jurnal','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_op); $i++) {
			$data_op[] = $data_total_op[$i]->total_jumlah;
		}
		$keluar_op = array_sum($data_op);

		//pengeluaran mitra
		$data_mit[]=0;
		$data_total_mit = Adm_jurnal::where('id_kat_jurnal','5')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
		for($i=0; $i<count($data_total_mit); $i++) {		
			$data_mit[] = $data_total_mit[$i]->total_jumlah;
		}
		$keluar_mit = array_sum($data_mit);

		//total pengeluaran
		$total_keluar = $keluar_pen+ $keluar_op + $keluar_mit;

		//grafik line

		//total aruskas masuk /bulan
		$jan1[] = 0;
		$jan = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '1')->get();
		for($i=0; $i<count($jan); $i++) {
			$jan1[] = $jan[$i]->total_jumlah;		
		}
		$b1 = array_sum($jan1);

		$feb2[] = 0;
		$feb = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '2')->get();
		for($i=0; $i<count($feb); $i++) {
			$feb2[] = $feb[$i]->total_jumlah;		
		}
		$b2 = array_sum($feb2);

		$mar3[] = 0;
		$mar = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '3')->get();
		for($i=0; $i<count($mar); $i++) {
			$mar3[] = $mar[$i]->total_jumlah;		
		}
		$b3 = array_sum($mar3);

		$apr4[] = 0;
		$apr = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '4')->get();
		for($i=0; $i<count($apr); $i++) {
			$apr4[] = $apr[$i]->total_jumlah;		
		}
		$b4 = array_sum($apr4);
	
		$mei5[] = 0;
		$mei = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '5')->get();
		for($i=0; $i<count($mei); $i++) {
			$mei5[] = $mei[$i]->total_jumlah;		
		}
		$b5 = array_sum($mei5);

		$jun6[] = 0;
		$jun = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '6')->get();
		for($i=0; $i<count($jun); $i++) {
			$jun6[] = $jun[$i]->total_jumlah;		
		}
		$b6 = array_sum($jun6);

		$jul7[] = 0;
		$jul = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '7')->get();
		for($i=0; $i<count($jul); $i++) {
			$jul7[] = $jul[$i]->total_jumlah;		
		}
		$b7 = array_sum($jul7);
	
		$ags8[] = 0;
		$ags = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '8')->get();
		for($i=0; $i<count($ags); $i++) {
			$ags8[] = $ags[$i]->total_jumlah;		
		}
		$b8 = array_sum($ags8);
		
		$sep9[] = 0;
		$sep = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '9')->get();
		for($i=0; $i<count($sep); $i++) {
			$sep9[] = $sep[$i]->total_jumlah;		
		}
		$b9 = array_sum($sep9);

		$okt10[] = 0;
		$okt = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '10')->get();
		for($i=0; $i<count($okt); $i++) {
			$okt10[] = $okt[$i]->total_jumlah;		
		}
		$b10 = array_sum($okt10);

		$nov11[] = 0;
		$nov = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '11')->get();
		for($i=0; $i<count($nov); $i++) {
			$nov11[] = $nov[$i]->total_jumlah;		
		}
		$b11 = array_sum($nov11);

		$des12[] = 0;
		$des = Adm_jurnal::whereIn('id_kat_jurnal',[1,3,6,7,9])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '12')->get();
		for($i=0; $i<count($des); $i++) {
			$des12[] = $des[$i]->total_jumlah;		
		}
		$b12 = array_sum($des12);

		$pemasukan = array($b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,$b11,$b12);

		// BATASSSSSSSSSSSSSSSSS
		//total aruskas keluar /bulan
		$ke_jan1[] = 0;
		$ke_jan = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '1')->get();
		for($i=0; $i<count($ke_jan); $i++) {
			$ke_jan1[] = $ke_jan[$i]->total_jumlah;
		}
		$ke_b1 = array_sum($ke_jan1);

		$ke_feb2[] = 0;
		$ke_feb = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '2')->get();
		for($i=0; $i<count($ke_feb); $i++) {
			$ke_feb2[] = $ke_feb[$i]->total_jumlah;
		}
		$ke_b2 = array_sum($ke_feb2);

		$ke_mar3[] = 0;
		$ke_mar = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '3')->get();
		for($i=0; $i<count($ke_mar); $i++) {
			$ke_mar3[] = $ke_mar[$i]->total_jumlah;
		}
		$ke_b3 = array_sum($ke_mar3);

		$ke_apr4[] = 0;
		$ke_apr = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '4')->get();
		for($i=0; $i<count($ke_apr); $i++) {
			$ke_apr4[] = $ke_apr[$i]->total_jumlah;
		}
		$ke_b4 = array_sum($ke_apr4);

		$ke_mei5[] = 0;
		$ke_mei = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '5')->get();
		for($i=0; $i<count($ke_mei); $i++) {
			$ke_mei5[] = $ke_mei[$i]->total_jumlah;
		}
		$ke_b5 = array_sum($ke_mei5);

		$ke_jun6[] = 0;
		$ke_jun = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '6')->get();
		for($i=0; $i<count($ke_jun); $i++) {
			$ke_jun6[] = $ke_jun[$i]->total_jumlah;
		}
		$ke_b6 = array_sum($ke_jun6);

		$ke_jul7[] = 0;
		$ke_jul = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '7')->get();
		for($i=0; $i<count($ke_jul); $i++) {
			$ke_jul7[] = $ke_jul[$i]->total_jumlah;
		}
		$ke_b7 = array_sum($ke_jul7);

		$ke_ags8[] = 0;
		$ke_ags = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '8')->get();
		for($i=0; $i<count($ke_ags); $i++) {
			$ke_ags8[] = $ke_ags[$i]->total_jumlah;
		}
		$ke_b8 = array_sum($ke_ags8);

		$ke_sep9[] = 0;
		$ke_sep = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '9')->get();
		for($i=0; $i<count($ke_sep); $i++) {
			$ke_sep9[] = $ke_sep[$i]->total_jumlah;
		}
		$ke_b9 = array_sum($ke_sep9);

		$ke_okt10[] = 0;
		$ke_okt = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '10')->get();
		for($i=0; $i<count($ke_okt); $i++) {
			$ke_okt10[] = $ke_okt[$i]->total_jumlah;
		}
		$ke_b10 = array_sum($ke_okt10);

		$ke_nov11[] = 0;
		$ke_nov = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '11')->get();
		for($i=0; $i<count($ke_nov); $i++) {
			$ke_nov11[] = $ke_nov[$i]->total_jumlah;
		}
		$ke_b11 = array_sum($ke_nov11);

		$ke_des12[] = 0;
		$ke_des = Adm_jurnal::whereIn('id_kat_jurnal',[2,4,5,8,10])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '12')->get();
		for($i=0; $i<count($ke_des); $i++) {
			$ke_des12[] = $ke_des[$i]->total_jumlah;
		}
		$ke_b12 = array_sum($ke_des12);

		$pengeluaran = array($ke_b1,$ke_b2,$ke_b3,$ke_b4,$ke_b5,$ke_b6,$ke_b7,$ke_b8,$ke_b9,$ke_b10,$ke_b11,$ke_b12);
		
		
		return view('admin.admin-keuangan.beranda',[
			// 'kategori' => $kategori, 
			// 'data' => $data,
			'masuk_jb' => $masuk_jb,
			'masuk_le'=> $masuk_le,
			'masuk_in' => $masuk_in,
			'total_masuk' => $total_masuk,
			'keluar_pen' => $keluar_pen,
			'keluar_op' => $keluar_op,
			'keluar_mit' =>  $keluar_mit,
			'total_keluar' => $total_keluar,
			'pemasukan' => $pemasukan,
			'pengeluaran' => $pengeluaran
			]);
	
	}


	public function adminProfile(){
        $data = Profile_admin::where('role',Auth::user()->id)->first();
		$data2 = User::where('id',Auth::user()->id)->first();
		$role_id = Model_has_role::where('model_id', Auth::user()->id)->first();
		$role = $role_id->roles->name;

		if($data == NULL){
			return view('admin.admin-keuangan.tambah-profile',compact('data2','role'));
		}else{
			return view('admin.admin-keuangan.admin-profile', compact('data','data2','role'));
		}
      
    }

    public function profileUpdate(Request $request){

		$rules = array(
				'nama' => 'required',
			    'no_hp' => 'required|max:13',
			    'alamat' => 'required|string|max:255',
			    'foto' => 'mimes:jpeg,bmp,png|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
		 return response()->json(['errors' => $error->errors()->all()]);
	 }
		
        if (empty($request->file('foto'))) {
			$data2 = Profile_admin::where('role',Auth::user()->id)->first();
            $data2->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
			]);
			$data3 = User::where('id',Auth::user()->id)->first();
			$data3->update([
				'name' => $request->nama,
			]);
        } else {

			$data2 = Profile_admin::where('role',Auth::user()->id)->first();
			Storage::delete($data2->foto);
            $data2->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'foto' => $request->file('foto')->store('Foto_profile'),
			]);
			$data3 = User::where('id',Auth::user()->id)->first();
			$data3->update([
				'name' => $request->nama,
			]);
			
		}
    
		Alert::success('Berhasil diupdate !');
		
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

    public function tambahProfile(Request $request){

		$this->validate($request, [
            'no_hp' => 'required|max:13',
            'alamat' => 'required|string|max:255',
            'foto' => 'required|mimes:jpeg,bmp,png|max:2048'
        ]);
        if (empty($request->file('foto'))) {
            Profile_admin::create([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
			]);
        } else {
            $id_admin = Auth::user()->id;
            Profile_admin::create([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'foto' => $request->file('foto')->store('Foto_profile'),
                'role' => $id_admin,
            ]);
            $provider = User::where('id',$id_admin);
            $provider->update([
                'provider_id' => "11010510910097",
            ]);
        }

		Alert::success('Berhasil disimpan !');
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
	
	public function profile2Update(Request $request){

		$rules = array(
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
		 return response()->json(['errors' => $error->errors()->all()]);
	 }

			$data2 = User::where('id',Auth::user()->id)->first();
            $data2->update([
				'email' => $request->email,
				'password' => Hash::make($request->password),
			]);

        Alert::success('Berhasil diupdate !');
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
