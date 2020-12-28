<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Invest_product;
use App\Invest_product_image;
use Carbon;

class ValidasiProdukInvestasiController extends Controller
{
	public function ProdukInvestasi()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Invest_product::latest()->get())
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-secondary btn-sm py-0 mb-1"><i class="fa fa-clock"></i> diproses</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';
					
				}elseif ($data->status == "3") {
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';

				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';
				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = '<span class="badge badge-info">belum divalidasi</span>'; 
				}elseif ($data->status == "3") {
					$status = '<span class="badge badge-secondary">sedang diproses</span>';
				}elseif ($data->status == "2") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}else{
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}

				return $status;
			})

			->addColumn('stok', function($data){
				$stok =  $data->stok." Unit"; 
				return $stok;
			})

			->addColumn('harga', function($data){
				$rp = "Rp. ";
				$unit = " /Unit";
				$harga = $rp. number_format($data->harga).$unit; 
				return $harga;
			})

			->addColumn('periode', function($data){
				$th = " Tahun";
				$periode = $data->periode.$th; 
				return $periode;
			})

			->addColumn('profit_periode', function($data){
				$th = " Tahun";
				$profit_periode = $data->profit_periode.$th; 
				return $profit_periode;
			})

			->addColumn('roi', function($data){
				$ambil = $data->roi;
				$sen = "%";
				$roi = $ambil.$sen;

				return $roi;
			})

			->addColumn('created_at', function($data){
				$created_at =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $created_at;
			})
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-produk-investasi');
	}

	public function dataProdukInvestasi($id)
	{
		if(request()->ajax())
		{
			$data = Invest_product::findOrFail($id);
			return response()->json(['data' => $data]);
		}
	}

	public function lihatProdukInvestasi($id)
	{
		if(request()->ajax()){

			$data = Invest_product::find($id);
			$data_gambar = Invest_product_image::where('id_produk', $data->id)->get();

			return response()->json([
				'data' => $data,
				'data_gambar' => $data_gambar,
			]);
		}
	}

	public function TolakProdukInvestasi(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Invest_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function ValidasiProdukInvestasi(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Invest_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

	public function ProsesProdukInvestasi(Request $request)
	{	
		
		$form_data = array(
			'status' => $request->status,
		);

		Invest_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Diproses']);
	}
}
