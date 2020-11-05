<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use DB;
use DataTables;
use Carbon;
use Validator;
use Illuminate\Support\Str;
use Storage;
use App\Helper\Helper;



class AdministrasiController extends Controller
{
	public function dataAdministrasi(){

		if(request()->ajax())
		{	
			
			$id = '2';
			$AKKOP = Adm_jurnal::where('id_kat_jurnal',$id)->get();

			return datatables()->of($AKKOP)
			->addColumn('action', function($data){
				$button = 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0"><i class="fa fa-eye"></i> Lihat</button>'.'&nbsp&nbsp'.
				'<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm py-0"><i class="fa fa-edit"></i> Ubah</button>'.'&nbsp;&nbsp;'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0 delete"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})

			->addColumn('total_jumlah', function($data){
				$rp = "Rp. ";
				$total_jumlah = $rp. number_format($data->total_jumlah); 
				return $total_jumlah;
			})
			
			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

			
			->rawColumns(['action','created_at'])
			->make(true);
		}

		$tran = Adm_tranksaksi::All();

		$kategori = Adm_kat_akun::All();

		$satu = Adm_sub1_akun::All();

		$dua = Adm_sub2_akun::All();

		return view('admin.admin-keuangan.administrasi',compact('tran','kategori','satu','dua'));
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
			'id_kat_jurnal' => 2,
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

	public function update(Request $request)
	{

		$image_name = $request->bukti22;
		$foto_baru = $request->file('foto_baru22');
		if($foto_baru != '')
		{	
			$id = $request->hidden_id22;
			$file = Adm_jurnal::find($id);
			Storage::delete($file->bukti);
			$jumlah22 = Helper::instance()->removeDot($request->jumlah22);
			$file->update([
				'bukti' => $request->file('foto_baru22')->store('Adm_bukti/AKKOP'),
				'nama_tran' => $request->nama_tran22,
				'catatan' => $request->catatan22,
				'total_jumlah' => $jumlah22,
				'tujuan_tran' => $request->tujuan_tran22
			]);
			$file2 = Adm_akun::where('id_adm_jurnal', $id);
			$file2->update([
				'akun_debit' => $request->akun_debit,
				'akun_kredit' => $request->akun_kredit,
				'kredit' => $jumlah22
			]);
		}
		else
		{
			$rules = array(	
				'nama_tran22' =>  'required',
				'catatan22' =>  'required',
				'tujuan_tran22' => 'required',
				'jumlah22.*' =>  'required_unless:type_of_content,is_information'
		
			);

			$error = Validator::make($request->all(), $rules);

			if($error->fails())
			{
				return response()->json(['errors' => $error->errors()->all()]);
			}
		}
		
		$id = $request->hidden_id22;
		$data = Adm_jurnal::find($id);
		$jumlah22 = Helper::instance()->removeDot($request->jumlah22);
		$data->update([
			'nama_tran' => $request->nama_tran22,
			'catatan' => $request->catatan22,
			'total_jumlah' => $jumlah22,
			'tujuan_tran' => $request->tujuan_tran22
		]);
	
		$data2 = Adm_akun::where('id_adm_jurnal', $id);
		$data2->update([
			'akun_debit' => $request->akun_debit,
			'akun_kredit' => $request->akun_kredit,
			'kredit' => $jumlah22
		]);

		return response()->json(['success' => 'Data berhasil di ubah.']);
	}


	public function detailAdministrasi($id)
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
