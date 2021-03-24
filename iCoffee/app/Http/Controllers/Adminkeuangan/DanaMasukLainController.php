<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Akt_jurnal;
use App\Akt_akun_jurnal;
use App\Akt_tujuan;
use App\Akt_kat_akun;
use App\Akt_akun;
use DB;
use DataTables;
use Carbon;
use Validator;
use Storage;
use App\Helper\Helper;


class DanaMasukLainController extends Controller
{
	public function dataDanaMasuk(){

		if(request()->ajax())
		{	
			$AKML = DB::table('akt_tujuan')
			->join('akt_jurnal', 'akt_tujuan.id', '=', 'akt_jurnal.id_akt_tujuan')
			->where('akt_jurnal.id_kat_jurnal',4)
			->orderBy('akt_jurnal.created_at')
			->get();


			return datatables()->of($AKML)
			->addColumn('action', function($data){
				$button = 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0 mb-1"><i class="fa fa-eye"></i> Lihat</button>'.'&nbsp&nbsp'.
				'<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm py-0"mb-1><i class="fa fa-edit"></i> Ubah</button>'.'&nbsp;&nbsp;'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0 delete"><i class="fa fa-trash"></i> Hapus</button>';
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

		return view('admin.admin-keuangan.dana-masuk-lain',compact('tran','kategori','satu'));
	}

	public function tambah(Request $request)
	{	

		$rules = array(	
			'id_tujuan' =>  'required',
			'nama_transaksi' => 'required',
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

		$noTrans = Akt_jurnal::noTrans();
		$noJurnal = Akt_akun_jurnal::noJurnal();
		$jumlah = Helper::instance()->removeDot($request->jumlah1);

		$simpan = Akt_jurnal::create([
			'id_kat_jurnal' => 4,
			'id_akt_tujuan' => $request->id_tujuan,
			'no_transaksi' => $noTrans,
			'nama_transaksi' => $request->nama_transaksi,
			'bukti' => $request->file('bukti')->store('Akt_bukti'),
			'catatan' => $request->catatan,
			'total_jumlah' => $jumlah,
				
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => $request->akun_debit,
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

		return response()->json(['success' => 'Data berhasil ditambah.']);
	}

	public function hapus($id)
	{

		$data = Akt_jurnal::findOrFail($id);
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
			$file = Akt_jurnal::find($id);
			Storage::delete($file->bukti);
			$jumlah22 = Helper::instance()->removeDot($request->jumlah22);
			$file->update([
				'bukti' => $request->file('foto_baru22')->store('Akt_bukti/AKML'),
				'nama_transaksi' => $request->nama_transaksi22,
				'catatan' => $request->catatan22,
				'total_jumlah' => $jumlah22,
				'id_akt_tujuan' => $request->tujuan_tran22
			]);
	
			$data = Akt_akun_jurnal::where('id_akt_jurnal', $id);
			$data->delete();

			$noJurnal = Akt_akun_jurnal::noJurnal();
			$jumlah = Helper::instance()->removeDot($request->jumlah22);
		
			Akt_akun_jurnal::create([
				'id_akt_jurnal' => $id,
				'no_jurnal' =>$noJurnal,
				'id_akt_akun' => $request->akun_debit,
				'debit' => $jumlah,
				'kredit' => 0
			]);
	
			Akt_akun_jurnal::create([
				'id_akt_jurnal' => $id,
				'no_jurnal' =>$noJurnal,
				'id_akt_akun' => $request->akun_kredit,
				'debit' => 0,
				'kredit' => $jumlah
			]);
		}
		else
		{
			$rules = array(	
				'nama_transaksi22' =>  'required',
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
		$data = Akt_jurnal::find($id);
		$jumlah22 = Helper::instance()->removeDot($request->jumlah22);
		$data->update([
			'nama_transaksi' => $request->nama_transaksi22,
			'catatan' => $request->catatan22,
			'total_jumlah' => $jumlah22,
			'id_akt_tujuan' => $request->tujuan_tran22	
		]);
	
		$data = Akt_akun_jurnal::where('id_akt_jurnal', $id);
		$data->delete();

		$noJurnal = Akt_akun_jurnal::noJurnal();
		$jumlah = Helper::instance()->removeDot($request->jumlah22);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => $request->akun_debit,
			'debit' => $jumlah,
			'kredit' => 0
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => $request->akun_kredit,
			'debit' => 0,
			'kredit' => $jumlah
		]);

		return response()->json(['success' => 'Data berhasil di ubah.']);
	}


	public function detailDanaMasuk($id)
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