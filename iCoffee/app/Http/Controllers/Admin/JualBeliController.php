<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Shop_product;
use App\Image;

class JualBeliController extends Controller
{
    public function jenisProduk()
    {
        if(request()->ajax())
        {
            return datatables()->of(Shop_product::latest()->get())
            ->addColumn('action', function($data){
                $button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.jenis-produk');
    }

    public function hapus($id)
{

    $data = Shop_product::findOrFail($id);
    $data->delete();
    return response()->json(['success' => 'Data berhasil di hapus.']);
}
}
