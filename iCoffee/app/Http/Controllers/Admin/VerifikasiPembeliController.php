<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Confirm_payment;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_arus_kas;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use App\Orderdetail;
use Carbon;


class  VerifikasiPembeliController extends Controller
{
	public function dataOrder()
	{
		if(request()->ajax())
		{	
			$jasa = "1";
			$konfirmasi = Confirm_payment::where('jasa',$jasa);

			return datatables()->of($konfirmasi)
			->addColumn('action', function($data){
				
				if ($data->status == "8") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>';
					
				}elseif ($data->status == "2") {
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}elseif ($data->status == "3") {
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}elseif ($data->status == "1") {
					$button = 
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}
				else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = "belum bayar";
				}elseif ($data->status == "2") {
					$status = "ditolak";
				}elseif ($data->status == "3") {
					$status = "diproses";
				}elseif ($data->status == "4") {
					$status = "penjual menerima";
				}elseif ($data->status == "5") {
					$status = "dikirim";
				}elseif ($data->status == "6") {
					$status = "terkirim";
				}elseif ($data->status == "7") {
					$status = "komplain";
				}elseif ($data->status == "8") {
					$status = "konfirmasi diproses";
				}elseif ($data->status == "9") {
					$status = "batalkan pesanan pembeli";
				}elseif ($data->status == "10") {
					$status = "komplain diterima";
				}elseif ($data->status == "11") {
					$status = "komplain ditolak";
				}else{
					$status = "ditolak";
				}

				return $status;
			})

			// blm bayar 1
			// sudah dibbayar 2
			// proses penjual 3
			// penjual menerima 4 menolak 0
			// dikriim 5
			// terkirim 6
			// komplin 7
			// konfirmasi diproses 8
			// batalkan pesanan pembeli 9
			// komplain dterima 1
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-pembeli');
	}


	public function lihatOrder($id)
	{
		if(request()->ajax())
		{
			$data = Confirm_payment::findOrFail($id);
			return response()->json(['data' => $data]);
		}
	}

	public function tolakOrder(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Confirm_payment::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiOrder(Request $request)
	{

		// $id_pelanggan = $request->id_pelanggan2;
		// Orderdetail::where('id_pelanggan',$id_pelanggan)->()

		$catatan = "pembelian kopi robusta 20kg di petani";
		$tujuan_tran = "Bank iCoffee BNI";
		$nama_akun = "Pembelian Produk Jual-Beli";

		$id = "5";
		$id = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$jml_id = count($id)+1;
		$kode = "AKM-JB".$jml_id;

		$bukti = $request->foto_bukti2;
		$timestamps = date('YmdHis');
		$new_name = $kode.$timestamps. '.' . $bukti;

		$id = Adm_jurnal::create([
			'id_kat_jurnal' => '5',
			'kode' => $kode,
			'catatan' => $catatan,
			'tujuan_tran' => $tujuan_tran,
			'bukti' =>  $new_name,
			'nama_tran' => $request->nama_pemilik_pengirim2,
			'total_jumlah' => $request->jumlah_transfer2	
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun,
			'posisi' => 'Debit',
			'jumlah' => $request->jumlah_transfer2
		]);


		$form_data = array(
			'status' => $request->status,
		);
		

		$jumlah = Adm_akun::where('nama_akun',$nama_akun)->select('jumlah')->get();
		$total = 0;
		for($i=0;$i<count($jumlah);$i++){
			$total += $jumlah[$i]->jumlah;
		}

		$data1 = Adm_arus_kas::where('nama_akun',$nama_akun)->select('nama_akun')->get();
		$data = count($data1);

		if($data == '0'){
			$id = Adm_arus_kas::create([
				'kode' => 'AKM-JB',
				'nama_akun' => $nama_akun,
				'total' => $total
			]);
		}else{
			$form = array(	
				'kode' => 'AKM-JB',
				'nama_akun' => $nama_akun,
				'total' => $total
			);
			Adm_arus_kas::where('nama_akun',$nama_akun)->update($form);
		}

		Confirm_payment::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}