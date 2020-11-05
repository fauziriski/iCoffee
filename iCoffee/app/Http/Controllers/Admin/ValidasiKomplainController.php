<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Complaint;
use App\Order;
use Carbon;

class ValidasiKomplainController extends Controller
{
	public function Komplain()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Complaint::latest()->get())
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> Validasi</button>'. '&nbsp&nbsp' .
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
				}elseif ($data->status == "11") {
					$status = '<span class="badge badge-success">komplain success</span>';
				}else{
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}

				return $status;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-komplain');
	}

	public function dataKomplain($id)
	{
		if(request()->ajax())
		{
			$data = Complaint::findOrFail($id);
			return response()->json(['data' => $data]);
		}
	}

	public function lihatKomplain($id)
	{
		if(request()->ajax()){

			$data = Complaint::find($id);

			return response()->json([
				'data' => $data,
			]);
		}
	}

	public function TolakKomplain(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);
		

		Complaint::whereId($request->hidden_id2)->update($form_data);
		$data =  Complaint::whereId($request->hidden_id2)->first();
        $id_order = $data->id_order;
		Order::whereId($id_order)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function ProsesKomplain(Request $request)
	{	
		
		$form_data = array(
			'status' => $request->status,
        );
        

        Complaint::whereId($request->hidden_id2)->update($form_data);
        $data =  Complaint::whereId($request->hidden_id2)->first();
        $id_order = $data->id_order;
        Order::whereId($id_order)->update($form_data);
		return response()->json(['success' => 'Berhasil Diproses']);
	}
}
