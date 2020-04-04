<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Balance_withdrawal;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_arus_kas;
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
			
			$id = '10';
			$AKKSP = Adm_jurnal::where('id_kat_jurnal',$id)->get();

			return datatables()->of($AKKSP)
			->addColumn('action', function($data){
				$button = 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i></button>'.'&nbsp&nbsp'.
				'<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>'.'&nbsp;&nbsp;'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
				return $button;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
				return $waktu;       
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

	public function lihatPencairan($id)
	{
		if(request()->ajax())
		{
			$data = Balance_withdrawal::findOrFail($id);
			$user_id = $data->user_id;

			$ambil = Joint_account::where('user_id',$user_id)->first();
			$saldo_pengguna = $ambil->saldo;

			return response()->json([
				'data' => $data,
				'saldo_pengguna' => $saldo_pengguna

			]);

		}
	}

	public function tolakPencairan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Balance_withdrawal::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	
	public function dataPenarikan()
	{
		$status = '4';
		$penarikan = Balance_withdrawal::where('status',$status)->get();

		return datatables()->of($penarikan)
		->addColumn('action', function($data){
			$button = 
			'<button type="button" name="tambah" id="'.$data->id.'" class="tambah btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>';
			return $button;
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
	
	public function hapusPencairan($id)
	{

		$data = Adm_jurnal::findOrFail($id);
		$data->delete();

		return view('admin.admin-keuangan.pencairan-dana-pelanggan');

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
		$id = "10";
		$ido = Adm_jurnal::select('id')->latest()->first();
		$jml_id = $ido->id+1;
		$kode = "AKKLA".$jml_id;

		$new_name = $kode.$timestamps. '.' . $bukti->getClientOriginalExtension();

		$bukti->move(public_path('Uploads/Adm_bukti/AKKPS'), $new_name);

		$total_jumlah = $request->jumlah2;

		$data = Balance_withdrawal::findOrFail($request->hidden_id);
		$user_id = $data->user_id;

		$nama_tran = "Penarikan saldo pelanggan";
		$catatan = "Penarikan saldo pelanggan dengan total saldo Rp.".number_format($data->jumlah).": Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;

		$tujuan_tran = "Bank ".$data->bank."/Atas nama ".$data->pemilik_rekening;
		$nama_akun1 = "Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;
		$jumlah1 = $data->jumlah;
		$posisi1 = "Debit";

		$id = Adm_jurnal::create([
			'id_kat_jurnal' =>'10',
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
		

		$nama_akun = $nama_akun1;
		
		$jumlah = Adm_akun::where('nama_akun',$nama_akun)->select('jumlah')->get();
		$total = 0;
		for($i=0;$i<count($jumlah);$i++){
			$total += $jumlah[$i]->jumlah;
		}

		$data1 = Adm_arus_kas::where('nama_akun',$nama_akun)->select('nama_akun')->get();
		$data = count($data1);

		if($data == '0'){
			$id = Adm_arus_kas::create([
				'kode' => 'AKK-PS',
				'nama_akun' => $nama_akun,
				'total' => $total
			]);
		}else{
			$form = array(	
				'kode' => 'AKK-PS',
				'nama_akun' => $nama_akun,
				'total' => $total
			);
			Adm_arus_kas::where('nama_akun',$nama_akun)->update($form);
		}

		$form_data = array(
			'status' => '3',
		);

		Balance_withdrawal::whereId($request->hidden_id)->update($form_data);

		return response()->json(['success' => 'Data berhasil ditambah.']);
	}


}