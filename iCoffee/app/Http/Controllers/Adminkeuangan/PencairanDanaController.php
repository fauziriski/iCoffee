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
use Storage;
use App\Helper\Helper;


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
			$nama_tran = "Penarikan saldo pelanggan";
			$catatan = "Penarikan saldo pelanggan dengan total saldo Rp.".number_format($data->jumlah).": Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;

			$tujuan_tran = "Bank ".$data->bank;
			$nama_akun_debit = "Pencairan Saldo Pelanggan";
			$jumlah_debit = number_format($data->jumlah);
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
			'akun_kredit' => 'required',
			'jumlah2' => 'required',
			'bukti' =>  'required|image|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
			return response()->json(['errors' => $error->errors()->all()]);
		}

		$data = Balance_withdrawal::findOrFail($request->hidden_id);
		$user_id = $data->user_id;
		$jumlah_kredit = Helper::instance()->removeDot($request->jumlah2);

		$nama_tran = "Penarikan saldo pelanggan";
		$tujuan_tran = "Bank ".$data->bank;
		$nama_akun_debit = "Pencairan Saldo Pelanggan";
		$catatan = "Penarikan saldo pelanggan dengan total saldo Rp.".number_format($data->jumlah).": Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;

		$data_saldo = Joint_account::where('user_id',$user_id)->first();
		$saldo_awal = $data_saldo->saldo;
		$sisa_saldo = $saldo_awal - $jumlah_kredit;

		$noTrans = Adm_jurnal::noTrans();
		$noJurnal = Adm_akun::noJurnal();
		

		$simpan = Adm_jurnal::create([
			'id_kat_jurnal' => 8,
			'nama_tran' => $nama_tran,
			'bukti' => $request->file('bukti')->store('Adm_bukti/AKKJULE'),
			'catatan' => $catatan,
			'no_tran' => $noTrans,
			'total_jumlah' => $jumlah_kredit,
			'tujuan_tran' => $tujuan_tran			
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'akun_debit' => $nama_akun_debit,
			'akun_kredit' => $request->akun_kredit,
			'debit' => 0,
			'kredit' => $jumlah_kredit
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
			'akun_kredit' => 'required',
			'akun_debit' => 'required',
			'jumlah1' => 'required',
			'bukti' =>  'required|image|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
			return response()->json(['errors' => $error->errors()->all()]);
		}

		$noTrans = Adm_jurnal::noTrans();
		$noJurnal = Adm_akun::noJurnal();
		$jumlah = Helper::instance()->removeDot($request->jumlah1);

		$simpan = Adm_jurnal::create([
			'id_kat_jurnal' => 8,
			'nama_tran' => $request->nama_tran,
			'bukti' => $request->file('bukti')->store('Adm_bukti/AKKOP'),
			'catatan' => $request->catatan,
			'no_tran' => $noTrans,
			'total_jumlah' => $jumlah,
			'tujuan_tran' => $request->tujuan_tran			
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'akun_debit' => $request->akun_debit,
			'akun_kredit' => $request->akun_kredit,
			'debit' => 0,
			'kredit' => $jumlah
		]);

		return response()->json(['success' => 'Data berhasil ditambah.']);
	}


	public function hapus($id)
	{

		$data = Adm_jurnal::findOrFail($id);
		Storage::delete($data->bukti);
		$data->delete();

		return response()->json();

	}


	public function detailpencairan($id)
	{
		if(request()->ajax())
		{	
			$data2 = Adm_akun::where('id_adm_jurnal',$id)->first();

			$data = Adm_jurnal::findOrFail($id);
			return response()->json([
				'data' => $data,
				'data2' => $data2
			]);
		}
	}


}