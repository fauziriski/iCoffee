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

class ProdukInvestasiController extends Controller
{

    public function produkInvestasi()
    {
        if(request()->ajax())
		{	

			return datatables()->of(Invest_product::where('id_mitra', Auth::user()->id_mitra)->latest()->get())
			->addColumn('action', function($data){
				$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>';
				return $button;
            })
            ->addColumn('proses', function($data){
				if ($data->status == 1) {
					$proses = 'Belum Divalidasi';

                }
                elseif ($data->status == 2) {
					$proses = 'Sudah Divalidasi';

                }
                elseif ($data->status == 0) {
					$proses = 'Ditolak';

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
        
        $id_mitra = Auth::user()->id_mitra;
        $timestamps = date('YmdHis');
        $code = $timestamps.$id_mitra;
        $size = count(collect($request)->get('gambar'));

        $this->validate($request,[
            'gambar' => 'required'
        ]);

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
        $mitra = Mitra::where('id_mitra', $products->id_mitra)->get();
    
        return view('investasi.detailproduk',compact('products','image','produk_terkait','mitra'));
    }

    public function checkout(Request $request)
    {
        if(Investor::where('status',1)->where('id_pengguna', Auth::id())->first()){
            return redirect('/jadi-investor');
        }
        else{
            $produk = Invest_product::find($request->id_produk);
            $mitra = Mitra::where('id_mitra', $request->id_mitra)->first();
            $qty = $request->quantity;
            return view('investasi.checkout',compact('produk','mitra'))->with('qty',$qty);
        }
    }

    public function pay(Request $request)
    {
        dd($request);
    }
}
