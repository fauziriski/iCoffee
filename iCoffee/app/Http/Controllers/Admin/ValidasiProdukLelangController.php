<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Auction_product;
use App\Auction_image;
use App\Auction_process;
use App\User;
use Carbon;


class ValidasiProdukLelangController extends Controller
{
	public function ProdukLelang()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Auction_product::latest()->get())
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-secondary btn-sm py-0 mb-1"><i class="fa fa-clock"></i> diproses</button>'. '&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';
					
				}elseif ($data->status == "3") {
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
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
					$status = '<button type="button" class="btn btn-info btn-sm py-0 btn-block">belum divalidasi</button>';
				}elseif ($data->status == "3") {
					$status = '<button type="button" class="btn btn-secondary btn-sm py-0 btn-block">sedang diproses</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0 btn-block">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0 btn-block">validasi ditolak</button>';
				}

				return $status;
			})


			->addColumn('stok', function($data){
				$stok =  $data->stok." Kg"; 
				return $stok;
			})

			->addColumn('harga_awal', function($data){
				$rp = "Rp. ";
				$harga_awal = $rp. number_format($data->harga_awal); 
				return $harga_awal;
			})

			->addColumn('kelipatan', function($data){
				$rp = "Rp. ";
				$kelipatan = $rp. number_format($data->kelipatan); 
				return $kelipatan;
			})


			->addColumn('created_at', function($data){
				$created_at =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $created_at;
			})
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-produk-lelang');
	}

	public function dataProdukLelang($id)
	{
		if(request()->ajax())
		{
			$data = Auction_product::findOrFail($id);
			$data_email = User::where('id',$data->id_pelelang)->first();

			return response()->json([
				'data' => $data,
				'data_email' => $data_email,
			]);

		}
	}

	public function lihatProdukLelang($id)
	{
		if(request()->ajax()){

			$data = Auction_product::find($id);
			$data_gambar = Auction_image::where('id_produk', $data->id)->get();

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<span class="badge badge-info">belum divalidasi</span>';
				}elseif ($data->status == "3") {
					$status = '<span class="badge badge-secondary">barang diproses</span>';
				}elseif ($data->status == "2") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}else{
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}

			}

			return response()->json([
				'data' => $data,
				'data_gambar' => $data_gambar,
				'status' => $status,
			]);
		}
	}

	public function TolakProdukLelang(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Auction_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	
	public function ValidasiProdukLelang(Request $request)
	{
		$lama = $request->lama_lelang;
        $split = explode('-', $lama);

        $timestamps = date('YmdHis');
        $tanggal_mulai = date('Y-m-d H:i:s');

        if ($split[1] == 'Hari') {
            $tanggal_selesai = date("Y-m-d H:i:s", strtotime("+". $split[0] ."days"));
        } elseif($split[1] =='Jam') {
            $tanggal_selesai = date("Y-m-d H:i:s", strtotime("+". $split[0] ."hours"));
		}
		
		$form_data = array(
			'status' => $request->status,
			'tanggal_mulai' => $tanggal_mulai,
			'tanggal_berakhir' => $tanggal_selesai
		);

		Auction_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

	public function ProsesProdukLelang(Request $request)
	{	
		
		$form_data = array(
			'status' => $request->status,
		);

		Auction_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Diproses']);
	}
}