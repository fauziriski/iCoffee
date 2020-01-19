<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kelompok_tani;
use DB;
use DataTables;


class MitraKelompokController extends Controller
{
    public function kelompokTani()
	{
		if(request()->ajax())
		{
			return datatables()->of(Kelompok_tani::latest()->get())
			->addColumn('action', function($data){
				$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>';
				$button .= '&nbsp;&nbsp;';
				$button .= '<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.kelompok-tani');
	}
}
