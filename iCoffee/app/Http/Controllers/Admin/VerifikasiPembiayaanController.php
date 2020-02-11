<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invest_confirm;
use App\invest_order;
use App\Invest_product;
use App\Invest_product_image;
use App\User;
use DB;
use DataTables;
use Carbon;

class VerifikasiPembiayaanController extends Controller
{
	public function dataPembiayaan()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Invest_confirm::latest()->get())
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>';

				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';
				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = "belum divalidasi";
				}elseif ($data->status == "2") {
					$status = "divalidasi";
				}else{
					$status = "ditolak";
				}

				return $status;
			})

			->addColumn('created_at', function($data){
				$created_at =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
				return $created_at;
			})

			->addColumn('nominal', function($data){
				$rp = "Rp. ";
				$nominal = $rp. number_format($data->nominal); 
				return $nominal;
			})
			
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.validasi-pembiayaan');
	}

	public function lihatPembiayaan($id)
	{
		if(request()->ajax())
		{
			$data = Invest_confirm::findOrFail($id);

			$id_pengguna = $data->id_investor;
			$data2 = User::where('id',$id_pengguna)->first();

			$id_order = $data->id_order;
			$order = invest_order::whereId($id_order)->first();

			$id_produk = $order->id_produk;
			$produk = Invest_product::whereId($id_produk)->first();

			$data_gambar = Invest_product_image::where('id_produk',$id_produk)->get();

			return response()->json([
				'data' => $data,
				'data2' => $data2,
				'order' => $order,
				'produk' => $produk,
				'data_gambar' => $data_gambar,

			]);
		}
	}

	public function tolakPembiayaan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);
		
		Invest_confirm::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiPembiayaan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Invest_confirm::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}


}

