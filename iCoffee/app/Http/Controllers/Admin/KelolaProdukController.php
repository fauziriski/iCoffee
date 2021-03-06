<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Category;
use Validator;
use Carbon;


class KelolaProdukController extends Controller
{

    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Category::latest()->get())
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm py-0 mb-1"><i class="fa fa-edit"></i> ubah</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-trash"></i> hapus</button>';
                return $button;
            })

            ->addColumn('updated_at', function($data){
                $waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i');  
                return $waktu;
            })

            ->rawColumns(['action','updated_at'])
            ->make(true);
        }

        return view('admin.kategori-produk');
    }

    public function store(Request $request)
    {
       $rules = array(
        'kategori' =>  'required',
    );

       $error = Validator::make($request->all(), $rules);

       if($error->fails())
       {
        return response()->json(['errors' => $error->errors()->all()]);
    }

    $form_data = array(
        'kategori' => $request->kategori,
    );

    Category::create($form_data);

    return response()->json(['success' => 'Data berhasil ditambah.']);
}

public function edit($id)
{
    if(request()->ajax())
    {
        $data = Category::findOrFail($id);
        return response()->json(['data' => $data]);
    }
}

public function update(Request $request)
{
    $rules = array(
        'kategori' =>  'required',
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails())
    {
        return response()->json(['errors' => $error->errors()->all()]);
    }

    $form_data = array(
        'kategori' => $request->kategori,
    );

    Category::whereId($request->hidden_id)->update($form_data);

    return response()->json(['success' => 'Data berhasil di ubah.']);
}

public function hapusPelanggan($id)
{

    $data = User::findOrFail($id);
    $data->delete();
    return response()->json(['success' => 'Data berhasil di hapus.']);
}

}
