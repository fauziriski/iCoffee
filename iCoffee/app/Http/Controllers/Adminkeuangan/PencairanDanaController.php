<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Balance_withdrawal;
use App\Akt_jurnal;
use App\Akt_akun_jurnal;
use App\Akt_tujuan;
use App\Akt_kat_akun;
use App\Akt_akun;
use App\Joint_account;
use Carbon;
use Validator;
use Storage;
use App\Helper\Helper;
use DB;



class  PencairanDanaController extends Controller
{
	public function dataPencairan()
	{
		if(request()->ajax())
		{	
				$AKKU = DB::table('akt_tujuan')
				->join('akt_jurnal', 'akt_tujuan.id', '=', 'akt_jurnal.id_akt_tujuan')
				->where('akt_jurnal.id_kat_jurnal',5)
				->orderBy('akt_jurnal.created_at')
				->get();
	
				return datatables()->of($AKKU)
				->addColumn('action', function($data){
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0"><i class="fa fa-eye"></i> Lihat</button>'.'&nbsp&nbsp'.
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
	
			$tran = Akt_tujuan::All();
			$kategori = Akt_kat_akun::All();
			$satu = Akt_akun::orderBy('no_akun','asc')->get();
	
			
		return view('admin.admin-keuangan.pencairan-dana-pelanggan',compact('tran','kategori','satu'));
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
			$akun = Akt_akun::where('nama_akun', 'LIKE', "%$data->bank%")->first();
			$id_akt_akun = $akun->id;
			$tujuan = Akt_tujuan::where('nama_tujuan', 'LIKE', "%$data->bank%")->first();
			$id_tujuan = $tujuan->nama_tujuan;

			$jumlah_debit = number_format($data->jumlah);
			$akun_debit = "Pendapatan Penjualan/Saldo Pelanggan";
			$debit = "Debit";
			
			return response()->json([
				'data' => $data,
				'nama_tran' => $nama_tran,
				'tujuan_tran' => $id_tujuan,
				'catatan' => $catatan,
				'nama_akun_debit' => $akun_debit,
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
		$jumlah = Helper::instance()->removeDot($request->jumlah2);

		$nama_tran = "Penarikan saldo pelanggan";
		$akun = Akt_akun::where('nama_akun', 'LIKE', "%$data->bank%")->first();
		$id_akt_akun = $akun->id;
		$tujuan = Akt_tujuan::where('nama_tujuan', 'LIKE', "%$data->bank%")->first();
		$id_tujuan = $tujuan->id;

		$catatan = "Penarikan saldo pelanggan dengan total saldo Rp.".number_format($data->jumlah).": Bank ".$data->bank."/".$data->pemilik_rekening."-".$data->no_rekening;

		$data_saldo = Joint_account::where('user_id',$user_id)->first();
		$saldo_awal = $data_saldo->saldo;
		$sisa_saldo = $saldo_awal - $jumlah;

		$noTrans = Akt_jurnal::noTrans();
		$noJurnal = Akt_akun_jurnal::noJurnal();
		

		$simpan = Akt_jurnal::create([
			'id_kat_jurnal' => 5,
			'id_akt_tujuan' => $id_tujuan,
			'no_transaksi' => $noTrans,
			'nama_transaksi' => $nama_tran,
			'bukti' => $request->file('bukti')->store('BuktiAKKU'),
			'catatan' => $catatan,
			'total_jumlah' => $jumlah,
				
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => 41,
			'debit' => $jumlah,
			'kredit' => 0
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => $request->akun_kredit,
			'debit' => 0,
			'kredit' => $jumlah
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

	public function hapus($id)
	{

		$data = Akt_jurnal::findOrFail($id);
		Storage::delete($data->bukti);
		$data->delete();

		return response()->json();

	}


	public function detailpencairan($id)
	{
		if(request()->ajax())
		{	
			$data2 = Akt_akun_jurnal::where('id_akt_jurnal',$id)->get();
			$data = Akt_jurnal::findOrFail($id);
			$nama_tujuan = $data->akt_tujuan->nama_tujuan;

			foreach($data2 as $a){
				$ambil1[] = $a->id_akt_akun;
				$ambil2[] = $a->debit;
				$ambil3[] = $a->kredit;
				$ambil4[] = $a->no_jurnal;
			}

			$d = $ambil1[0];
			$k = $ambil1[1];
			$debit = $ambil2[0];
			$kredit = $ambil3[1];
			$no_jurnal = $ambil4[0];
			$akun1 = Akt_akun::whereId($d)->first();
			$akun2 = Akt_akun::whereId($k)->first();

			return response()->json([
				'data' => $data,
				'data2' => $data2,
				'nama_tujuan' => $nama_tujuan,
				'akun_debit' => $akun1->nama_akun,
				'akun_kredit' => $akun2->nama_akun,
				'debit' => $debit,
				'kredit' => $kredit,
				'no_jurnal' => $no_jurnal,
				'akun1' => $akun1->id,
				'akun2' => $akun2->id,
			]);
		}
	}


}