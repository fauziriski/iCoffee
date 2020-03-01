<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Invest_product;
use App\Invest_product_image;
use DB;
use DataTables;
use App\Mitra;
use App\Investor;
use App\invest_order;
use Illuminate\Support\Str;
use App\Account;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProdukInvestasiController extends Controller
{

    public function produkInvestasi()
    {
        if(request()->ajax())
		{	

			return datatables()->of(Invest_product::where('id_mitra', Auth::user()->id_mitra)->latest()->get())
			->addColumn('action', function($data){
				$button = '<a href="produk/'.$data->kode_produk.'" type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</a>';
				return $button;
            })
            ->addColumn('proses', function($data){
				if ($data->status == 1) {
					$proses = '<span class="badge badge-warning">Belum Divalidasi</span>';

                }
                elseif ($data->status == 2) {
					$proses = '<span class="badge badge-success">Sudah Divalidasi</span>';

                }
                elseif ($data->status == 0) {
					$proses = '<span class="badge badge-danger">Ditolak</span>';

                }
				return $proses;
            })
			
			->rawColumns(['action','proses'])
			->make(true);
        }
        
        return view('investasi.mitra.produk');
    }

    public function pasangInvestasi()
    {
        return view('investasi.mitra.pasang');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'gambar' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $id_mitra = Auth::user()->id_mitra;
        $timestamps = date('YmdHis');
        $code = $timestamps.$id_mitra;
        $size = count(collect($request)->get('gambar'));

        $folderPath = public_path("Uploads\Investasi\Produk\{$code}");
        $response = mkdir($folderPath);
        $nama = array();
        
        if($files = $request->file('gambar')){
            foreach($files as $image){
                $name=$image->getClientOriginalName();
                $image_resize = Images::make($image->getRealPath());
                $image_resize->resize(690, 547);
                $image_resize->crop(500, 500);
                $image_resize->save($folderPath .'/'. $name);
                // $image_resize->move($folderPath,$name);
                $nama[]=$name;
            }
        }

        $product = Invest_product::create([
            'id_mitra' => $id_mitra,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $request->detail_produk,
            'gambar' => $nama[0],
            'harga' => $request->harga,
            'stok' => $request->stok,
            'roi' => $request->roi,
            'periode' => $request->periode,
            'profit_periode' => $request->profit_periode,
            'kode_produk' => $code,
            'status' => '1'
            
        ]);

        $id = $product->id;
        
        for ($i=0; $i < $size ; $i++) {
            Invest_product_image::create([
                'id_mitra' => $id_mitra,
                'id_produk' => $id,
                'nama' => $nama[$i],
                'kode_produk' => $code

            ]);
        }
        Alert::toast('Tambah Produk Investasi Berhasil!', 'success');
        return redirect('/mitra/produk-investasi');
    }

    public function index(){
        $products = Invest_product::where('status', 2)->orderBy('created_at','desc')->paginate(12);
    
        return view('investasi.index',compact('products'));
    }

    public function detail($id)
    {
        $products = Invest_product::find($id);
        $produk_terkait = Invest_product::where('id_kategori', $products->id_kategori)->take(4)->get();
        $image = Invest_product_image::where('id_produk', $products->id)->get();
        $mitra = Mitra::where('id_mitra', $products->id_mitra)->first();
        if(Str::contains($mitra->id_mitra, 'KT')){
            $kode = $mitra->kode;
            $gambar = $mitra->gambar;
            $path = "\Uploads/Kelompok_tani/{{$kode}}/{$gambar}";
        }elseif(Str::contains($mitra->id_mitra, 'KP')){
            $kode = $mitra->kode;
            $gambar = $mitra->gambar;
            $path = "\Uploads/Mitra_Koperasi/{{$kode}}/$gambar";
        }else{
            $kode = $mitra->kode;
            $gambar = $mitra->gambar;
            $path = "\Uploads/Mitra_Perorangan/{{$kode}}/{$gambar}";
        }
    
        return view('investasi.detailproduk',compact('products','image','produk_terkait','mitra','path'));
    }

    public function checkout(Request $request)
    {
        if(Investor::where('status',2)->where('id_pengguna', Auth::id())->first()){
            $produk = Invest_product::find($request->id_produk);
            $mitra = Mitra::where('id_mitra', $request->id_mitra)->first();
            $qty = $request->quantity;
            return view('investasi.checkout',compact('produk','mitra'))->with('qty',$qty);
        }
        else{
            return redirect('/jadi-investor');
        }
    }

    public function pay(Request $request)
    {
        $id_investor = Auth::id();
        $produk = Invest_product::find($request->id_produk);
        $qty = $request->qty;
        $total = $request->total;
        $bank = Account::where('id',$request->id_bank)->first();
        $mitra = Mitra::where('id_mitra', $request->id_mitra)->first();
        invest_order::create([
            'id_produk' => $request->id_produk,
            'id_investor' => $id_investor,
            'id_bank' => $bank->id,
            'id_mitra' => $request->id_mitra,
            'qty' => $qty,
            'total' => $total,
            'status' => 1
        ]);
        Alert::toast('Pembelian Berhasil!', 'success');
        return view('investasi.pembayaran',compact('produk','mitra'))->with('qty',$qty)->with('bank', $bank);
    }
}
