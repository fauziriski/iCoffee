<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Balance_withdrawal;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use App\Joint_account;
use Carbon;
use Validator;


class  PencairanDanaController extends Controller
{
	public function dataPencairan()
	{
		if(request()->ajax())
		{	
			
			$id = '8';
			$AKKJULE = Adm_jurnal::where('id_kat_jurnal',$id)->get();

			return datatables()->of($AKKJULE)
			->addColumn('action', function($data){
				$button = 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0 mb-1"><i class="fa fa-eye"></i> Lihat</button>'.'&nbsp&nbsp'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

			
			->addColumn('total_jumlah', function($data){
				$rp = "Rp. ";
				$total_jumlah = $rp. number_format($data->total_jumlah); 
				return $total_jumlah;
			})
			
			->rawColumns(['action','created_at'])
			->make(true);
		}

	// return view('admin.admin-keuangan.pencairan-dana-pelanggan');
		$tran = Adm_tranksaksi::All();

		$kategori = Adm_kat_akun::All();

		$satu = Adm_sub1_akun::All();

		$dua = Adm_sub2_akun::All();

		return view('admin.admin-keuangan.pencairan-dana-pelanggan',compact('tran','kategori','satu','dua'));
	}


	public function dataPenarikan()
	{
		$status = '4';
		$penarikan = Balance_withdrawal::where('status',$status)->get();

		return datatables()->of($penarikan)
		->addColumn('action', function($data){
			$button = 
			'<button type="button" name="lihatPenarikan" id="'.$data->id.'" class="lihatPenarikan btn btn-success btn-sm py-0"><i class="fa fa-check"></i> Validasi</button>';
			return $button;
		})

		->addColumn('jumlah', function($data){
			$rp = "Rp. ";
			$jumlah = $rp. number_format($data->jumlah); 
			return $jumlah;
		})

		->rawColumns(['action'])
		->make(true);
		

		return view('admin.admin-keuangan.pencairan-dana-pelanggan');
	}

	public function lihatPenarikan($id)
	{
		if(request()->ajax())
		{
			$data = Balance_withdrawal::findOrFail($id);
			$user_id = $data->user_id;

			$nama_tran = "Penarikan saldo pelanggan";
			$catatan = "Penarikan saldo pelanggan dengan total saldo Rp.".number_format($data->jumlah).": Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;

			$tujuan_tran = "Bank ".$data->bank."/Atas nama ".$data->pemilik_rekening;
			$nama_akun_debit = "Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;
			$jumlah_debit = $data->jumlah;
			$debit = "Debit";
			
			return response()->json([
				'data' => $data,
				'nama_tran' => $nama_tran,
				'tujuan_tran' => $tujuan_tran,
				'catatan' => $catatan,
				'nama_akun_debit' => $nama_akun_debit,
				'jumlah_debit' => $jumlah_debit,
				'debit' => $debit

			]);

		}
	}


	public function validasiPenarikan(Request $request)
	{	
	
		$rules = array(	
			'nama_akun2' => 'required',
			'jumlah2' => 'required',
			'bukti' =>  'required|image|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
			return response()->json(['errors' => $error->errors()->all()]);
		}

		$bukti = $request->file('bukti');
		$timestamps = date('YmdHis');
		$id = "8";
		$ido = Adm_jurnal::select('id')->latest()->first();
		$jml_id = $ido->id+1;
		$kode = "AKKJULE".$jml_id;

		$new_name = $kode.$timestamps. '.' . $bukti->getClientOriginalExtension();

		$bukti->move(public_path('Uploads/Adm_bukti/AKKJULE'), $new_name);

		$total_jumlah = $request->jumlah2;

		$data = Balance_withdrawal::findOrFail($request->hidden_id);
		$user_id = $data->user_id;

		$nama_tran = "Penarikan saldo pelanggan";
		$catatan = "Penarikan saldo pelanggan dengan total saldo Rp.".number_format($data->jumlah).": Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;

		$tujuan_tran = "Bank ".$data->bank."/Atas nama ".$data->pemilik_rekening;
		$nama_akun1 = "Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;
		$jumlah1 = $data->jumlah;
		$posisi1 = "Debit";

		$data_saldo = Joint_account::where('user_id',$user_id)->first();
		$saldo_awal = $data_saldo->saldo;
		$sisa_saldo = $saldo_awal - $jumlah1;

		$id = Adm_jurnal::create([
			'id_kat_jurnal' =>'8',
			'nama_tran' => $nama_tran,
			'bukti' =>  $new_name,
			'catatan' => $catatan,
			'kode' => $kode,
			'total_jumlah' => $total_jumlah,
			'tujuan_tran' => $tujuan_tran		
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun1,
			'posisi' => $posisi1,
			'jumlah' => $jumlah1
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $request->nama_akun2,
			'posisi' => $request->posisi2,
			'jumlah' => $request->jumlah2
		]);
		

		$form_data = array(
			'status' => '3',
		);

		$form_data2 = array(
			'saldo' => $sisa_saldo,
		);

		Balance_withdrawal::whereId($request->hidden_id)->update($form_data);
		Joint_account::where('user_id',$user_id)->update($form_data2);

		return response()->json(['success' => 'Data berhasil ditambah.']);
	}

	public function tambah(Request $request)
	{	

		$rules = array(	
			'nama_tran' =>  'required',
			'tujuan_tran' => 'required',
			'catatan' =>  'required',
			'akun1' => 'required',
			'akun2' => 'required',
			'jumlah1' => 'required',
			'jumlah2' => 'required',
			'bukti' =>  'required|image|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
			return response()->json(['errors' => $error->errors()->all()]);
		}

		$bukti = $request->file('bukti');
		$timestamps = date('YmdHis');
		$id = "8";
		$ido = Adm_jurnal::select('id')->latest()->first();
		$jml_id = $ido->id+1;
		$kode = "AKKJULE".$jml_id;

		$new_name = $kode.$timestamps. '.' . $bukti->getClientOriginalExtension();

		$bukti->move(public_path('Uploads/Adm_bukti/AKKJULE'), $new_name);

		$total_jumlah = $request->jumlah2;

		$id = Adm_jurnal::create([
			'id_kat_jurnal' =>'8',
			'nama_tran' => $request->nama_tran,
			'bukti' =>  $new_name,
			'catatan' => $request->catatan,
			'kode' => $kode,
			'total_jumlah' => $total_jumlah,
			'tujuan_tran' => $request->tujuan_tran,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()

				
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $request->akun1,
			'posisi' => $request->posisi1,
			'jumlah' => $request->jumlah1,
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $request->akun2,
			'posisi' => $request->posisi2,
			'jumlah' => $request->jumlah2
		]);
	
		return response()->json(['success' => 'Data berhasil ditambah.']);
	}

	public function hapus($id)
	{

		$data = Adm_jurnal::findOrFail($id);
		$data->delete();

		return response()->json();

	}


	public function detailpencairan($id)
	{
		if(request()->ajax())
		{	
			$akun = Adm_akun::where('id_adm_jurnal',$id)->get();

			$data = Adm_jurnal::findOrFail($id);
			return response()->json([
				'data' => $data,
				'akun' => $akun
			]);
		}
	}


}