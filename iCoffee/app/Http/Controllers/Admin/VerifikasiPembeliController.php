<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Confirm_payment;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use App\Orderdetail;
use App\Order;
use App\Joint_account;
use App\Shop_product;
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
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> validasi</button>'. '&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';

				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = '<span class="badge badge-info">belum divalidasi</span>';
				}elseif ($data->status == "2") {
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}elseif ($data->status == "3") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}elseif ($data->status == "4") {
					$status = '<span class="badge badge-success">penjual menerima</span>';
				}elseif ($data->status == "5") {
					$status = '<span class="badge badge-success">dikirim</span>';
				}elseif ($data->status == "6") {
					$status = '<span class="badge badge-success">terkirim</span>';
				}elseif ($data->status == "7") {
					$status = '<span class="badge badge-warning">komplain</span>';
				}elseif ($data->status == "8") {
					$status = '<span class="badge badge-success">konfirmasi diproses</span>';
				}elseif ($data->status == "9") {
					$status = '<span class="badge badge-danger">batalkan pesanan</span>';
				}elseif ($data->status == "10") {
					$status = '<span class="badge badge-primary">komplain diterima</span>';
				}elseif ($data->status == "11") {
					$status = '<span class="badge badge-danger">komplain ditolak</span>';
				}else{
					$status = '<span class="badge badge-danger">ditolak</span>';
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
			
			->addColumn('jumlah_transfer', function($data){
				$rp = "Rp. ";
				$jumlah_transfer = $rp. number_format($data->jumlah_transfer); 
				return $jumlah_transfer;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

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
			$invoice = $data->invoice;
			$total_bayar = Orderdetail::where('invoice',$invoice)->select('total')->sum('total');
			$jumlah = Orderdetail::where('invoice',$invoice)->select('jumlah')->sum('jumlah');
			$ambil = Order::where('invoice',$invoice)->first();
			$pay = $ambil->payment;

			$qty = Order::where('invoice',$invoice)->get();
			$jml = count($qty);

			for($i=0; $i < $jml; $i++){
				$ongkir[] = $qty[$i]; 
				$ongkir1 = explode(': ',$ongkir[$i]->shipping);
				$ongkir2[] =  $ongkir1[0];
				// $total_ongkir[] = count($ongkir2);
			}	

			$collection = collect($ongkir2);
			$total_ongkir = $collection->pipe(function ($collection) {
				return $collection->sum();
			});

			$total_dibayar = $total_bayar+$total_ongkir;

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">validasi ditolak</button>';
				}elseif ($data->status == "3") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}elseif ($data->status == "4") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">penjual menerima</button>';
				}elseif ($data->status == "5") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">dikirim</button>';
				}elseif ($data->status == "6") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">terkirim</button>';
				}elseif ($data->status == "7") {
					$status = '<button type="button" class="btn btn-warning btn-sm py-0">komplain</button>';
				}elseif ($data->status == "8") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">konfirmasi diproses</button>';
				}elseif ($data->status == "9") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">batalkan pesanan</button>';
				}elseif ($data->status == "10") {
					$status = '<button type="button" class="btn btn-primary btn-sm py-0">komplain diterima</button>';
				}elseif ($data->status == "11") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">komplain ditolak</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">ditolak</button>';
				}
			}

			return response()->json([
				'data' => $data,
				'jumlah' => $jumlah,
				'total_bayar' => $total_bayar,
				'pay' => $pay,
				'total_ongkir' => $total_ongkir,
				'total_dibayar' => $total_dibayar,
				'status' => $status,

			]);

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

		$ambil = Order::where('invoice',$request->invoice2)->first();
		$bank = $ambil->payment;

		$total_bayar = Orderdetail::where('invoice',$request->invoice2)->select('total')->sum('total');
		$kg = Orderdetail::where('invoice',$request->invoice2)->select('jumlah')->sum('jumlah');

		$qty = Order::where('invoice',$request->invoice2)->get();
		$jml = count($qty);

		for($i=0; $i < $jml; $i++){
			$ongkir[] = $qty[$i]; 
			$ongkir1 = explode(': ',$ongkir[$i]->shipping);
			$ongkir2[] =  $ongkir1[0];
		}	

		$collection = collect($ongkir2);
		$total_ongkir = $collection->pipe(function ($collection) {
			return $collection->sum();
		});

		$catatan = "pembelian kopi sebanyak ".$kg."Kg dengan total harga Rp. ".number_format($total_bayar)." dan total ongkos kirim sebesar Rp. ".number_format($total_ongkir);
		$tujuan_tran = "Bank ".$bank." iCoffee";


		$nama_akun_debit = "Bank ".$request->nama_bank_pengirim2."/".$request->nama_pemilik_pengirim2."-".$request->no_rekening_pengirim2;
		$nama_akun_kredit = "Pembelian Produk Jual-Beli";

		$qty = Orderdetail::where('invoice',$request->invoice2)->get();
		$jml = count($qty);

		for($i=0; $i < $jml; $i++){
			$produk[] = $qty[$i]; 
			$nama_tran1[] = $produk[$i]->nama_produk;
			$produks= implode(",", $nama_tran1);
			$nama_tran = "Beli produk : ".$produks;

		}


		$id = "6";
		$id = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$jml_id = count($id)+1;
		$kode = "AKMJU".$jml_id;

		$bukti = $request->foto_bukti2;
		$new = $request->invoice2." ".$bukti;
		$nama_akun = "Pembelian Produk Jual-Beli";

		$id = Adm_jurnal::create([
			'id_kat_jurnal' => '6',
			'kode' => $kode,
			'catatan' => $catatan,
			'tujuan_tran' => $tujuan_tran,
			'bukti' =>  $new,
			'nama_tran' => $nama_tran,
			'total_jumlah' => $request->jumlah_transfer2	
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_debit,
			'posisi' => 'Debit',
			'jumlah' => $request->jumlah_transfer2
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_kredit,
			'posisi' => 'Kredit',
			'jumlah' => $request->jumlah_transfer2
		]);


		$form_data = array(
			'status' => $request->status,
		);

		$form_status = array(
			'status' => '3',
		);

		Order::where('invoice',$request->invoice2)->update($form_status);
		Confirm_payment::whereId($request->hidden_id2)->update($form_data);

		$qty = Orderdetail::where('invoice',$request->invoice2)->get();
		$jml = count($qty);

		for($i=0; $i < $jml; $i++){
			$produk[] = $qty[$i]; 
		}


		for($i=0; $i < $jml; $i++){
			$shop_produk;
			$stok = 0;
			$shop_produk = Shop_product::where('id',$produk[$i]->id_produk)->where('id_pelanggan', $produk[$i]->id_penjual)->first();
			$stok = $shop_produk->stok - $produk[$i]->jumlah;

			Shop_product::where('id',$produk[$i]->id_produk)->update([
				'stok' => $stok
			]);

		}

		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}