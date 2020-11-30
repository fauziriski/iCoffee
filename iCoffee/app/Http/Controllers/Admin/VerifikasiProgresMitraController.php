<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Joint_account;
use App\Pengajuan_dana;
use App\Rincian_pengajuan;
use App\Mitra;
use App\Progress_investasi;
use App\File_progress;
use App\Invest_order;
use App\Invest_product;
use App\Investor;
use App\User;
use Carbon;


class  VerifikasiProgresMitraController extends Controller
{
	public function dataProgres()
	{
		if(request()->ajax())
		{	            
            $konfirmasi = DB::table('invest_product')
                        ->join('progress_investasis', 'invest_product.kode_produk', '=', 'progress_investasis.kode_produk')
                        ->join('mitras', 'progress_investasis.id_mitra', '=', 'mitras.id_mitra')
                        ->select('invest_product.*', 'progress_investasis.created_at as waktu', 'progress_investasis.judul', 'mitras.nama', 'progress_investasis.status as status1', 'progress_investasis.id as id_progres')
                        ->get();

			return datatables()->of($konfirmasi)
			->addColumn('action', function($data){
				
				if ($data->status1 == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id_progres.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id_progres.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id_progres.'" class="diproses btn btn-secondary btn-sm py-0 mb-1"><i class="fa fa-clock"></i> diproses</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id_progres.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';
					
				}elseif ($data->status1 == "3") {
					$button = '<button type="button" name="lihat" id="'.$data->id_progres.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id_progres.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id_progres.'" class="validasi btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id_progres.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';

				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id_progres.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id_progres.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';
				}
				
				return $button;
			})

			->addColumn('status1', function($data){
				if ($data->status1 == "1") {
					$status1 = '<span class="badge badge-info">belum divalidasi</span>';
				}elseif ($data->status1 == "4") {
					$status1 = '<span class="badge badge-secondary">sedang diproses</span>';
				}elseif ($data->status1 == "3") {
					$status1 = '<span class="badge badge-success">sudah divalidasi</span>';
				}else{
					$status1 = '<span class="badge badge-danger">validasi ditolak</span>';
				}

				return $status1;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

			->rawColumns(['action','status1'])
			->make(true);
		}

		return view('admin.validasi-progres-mitra');
	}


	public function lihatProgres($id)
	{
		if(request()->ajax())
		{
           
            $data = Progress_investasi::findOrFail($id);
            $produk = Invest_product::where('kode_produk',$data->kode_produk)->first();
            $mitra = Mitra::where('id_mitra',$produk->id_mitra)->first();
            $file_foto = Progress_investasi::find($id)->files()->where('type','photo')->first();
            $file_vidio = Progress_investasi::find($id)->files()->where('type','video')->first();
    
            $data_investor = DB::table('invest_orders')
                            ->join('users', 'invest_orders.id_investor', '=', 'users.id')
                            ->select('invest_orders.*', 'invest_orders.created_at as waktu_order', 'users.name')
                            ->where('invest_orders.id_mitra',$produk->id_mitra)
                            ->where('invest_orders.status','2')
                            ->get();

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
				}elseif ($data->status == "3") {
					$status = '<button type="button" class="btn btn-secondary btn-sm py-0">sedang diproses</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">validasi ditolak</button>';
				}
			}

			return response()->json([
				'data' => $data,
				'status' => $status,
                'produk' => $produk,
                'mitra' => $mitra,
                'file_foto' => $file_foto,
                'file_vidio' => $file_vidio,
                'data_investor' => $data_investor

			]);

		}
	}

	public function tolakPencairanPetani(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Pengajuan_dana::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function prosesPencairanPetani(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Pengajuan_dana::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

	public function validasiPencairanPetani(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);


		$up = Mitra::where('id_mitra',$request->id_mitra)->first();
		$up->update([
			'saldo' => $request->total_pengajuan
		]);

		Pengajuan_dana::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}


}