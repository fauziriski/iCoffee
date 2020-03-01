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


class  PencairanDanaController extends Controller
{
	public function dataPencairan()
	{
		if(request()->ajax())
		{	
			
			$status = '4';
			$diproses = Balance_withdrawal::where('status',$status)->get();

			return datatables()->of($diproses)
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-secondary btn-sm"><i class="fa fa-clock"></i> Diproses</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>'; 
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}
				
				return $button;
			})

			->addColumn('jumlah', function($data){
				$rp = "Rp. ";
				$jumlah = $rp. number_format($data->jumlah); 
				return $jumlah;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
				return $waktu;
			})

			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.admin-keuangan.pencairan-dana-pelanggan');
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

	public function validasiPencairan(Request $request)
	{

		$ambil = Pencairan::where('invoice',$request->invoice2)->first();
		$bank = $ambil->payment;

		$total_bayar = Pencairandetail::where('invoice',$request->invoice2)->select('total')->sum('total');
		$kg = Pencairandetail::where('invoice',$request->invoice2)->select('jumlah')->sum('jumlah');

		$qty = Pencairan::where('invoice',$request->invoice2)->get();
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

		$catatan = "pencairanan kopi sebanyak ".$kg."Kg dengan total harga Rp.".number_format($total_bayar)." dan total ongkos kirim sebesar Rp.".$total_ongkir;
		$tujuan_tran = "Bank ".$bank." iCoffee";


		$nama_akun_debit = "Bank ".$request->nama_bank_pengirim2."/".$request->nama_pemilik_pengirim2."-".$request->no_rekening_pengirim2;
		$nama_akun_kredit = "pencairanan Produk Jual-Beli";

		$qty = Pencairandetail::where('invoice',$request->invoice2)->get();
		$jml = count($qty);

		for($i=0; $i < $jml; $i++){
			$produk[] = $qty[$i]; 
			$nama_tran1[] = $produk[$i]->nama_produk;
			$produks= implode(",", $nama_tran1);
			$nama_tran = "Beli produk : ".$produks;

		}


		$id = "5";
		$id = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$jml_id = count($id)+1;
		$kode = "AKM-JB".$jml_id;

		$bukti = $request->foto_bukti2;
		$timestamps = date('YmdHis');
		$new_name = $kode.$timestamps. '.' . $bukti;

		$nama_akun = "pencairanan Produk Jual-Beli";

		$id = Adm_jurnal::create([
			'id_kat_jurnal' => '5',
			'kode' => $kode,
			'catatan' => $catatan,
			'tujuan_tran' => $tujuan_tran,
			'bukti' =>  $new_name,
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

		$form_status = array(
			'status' => '3',
		);

		Pencairan::where('invoice',$request->invoice2)->update($form_status);
		Balance_withdrawal::whereId($request->hidden_id2)->update($form_data);

		$qty = Pencairandetail::where('invoice',$request->invoice2)->get();
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