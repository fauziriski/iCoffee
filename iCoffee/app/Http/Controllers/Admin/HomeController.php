<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Hash;
use Storage;
use Carbon;
use App\User;
use App\Invest_product;
use App\Shop_product;
use App\Auction_product;
use DB;
use Auth;
use App\Profile_admin;
use App\Model_has_role;
use App\Confirm_payment;
use App\Invest_confirm;
use App\Complaint;
use App\Auction_complaint;
use App\Balance_withdrawal;
use App\Mitra_koperasi;
use App\Mitra_perorangan;
use App\Kelompok_tani;
use App\Transaction;

class HomeController extends Controller
{
    
    public function index(){

    $year = Carbon::now()->format('Y');
    $month = Carbon::now()->format('m');
        
     //grafik pie
    $produk_jb = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $produk_lelang = count(Auction_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $produk_invest = count(Invest_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get()); 

   
    $kategori = array('Jual-Beli', 'Lelang', 'Investasi');
    $data  = array($produk_jb,$produk_lelang,$produk_invest);
  
    //grafik area
    $jan = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '1')->get());
    $feb = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '2')->get());
    $mar = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '3')->get());
    $apr = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '4')->get());
    $mei = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '5')->get());
    $jun = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '6')->get());
    $jul = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '7')->get());
    $ags = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '8')->get());
    $sep = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '9')->get());
    $okt = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '10')->get());
    $nov = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '11')->get());
    $des = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '12')->get());
    $jml_bulan = array($jan,$feb,$mar,$apr,$mei,$jun,$jul,$ags,$sep,$okt,$nov,$des);

        
    //tervalidasi
    $valid1 = count(Confirm_payment::where('status','3')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $valid2 = count(Invest_confirm::where('status','3')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $pem_tervalidasi = $valid1+$valid2;

    //belum tervalidasi
    $novalid1 = count(Confirm_payment::whereIn('status',[1,2])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $novalid2 = count(Invest_confirm::whereIn('status',[1,2])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $pem_novalidasi = $valid1+$valid2;

    //komplain
    $komplain_jb = count(Complaint::All());
    $komplain_lelang = count(Auction_complaint::All());
    $komplain = $komplain_lelang + $komplain_jb;

    //pencairan_saldo
    $saldo = count(Balance_withdrawal::All());
    
    //produktervalidasi
    $produk_lelang = count(Auction_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $produk_invest = count(Invest_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());   
    $prdk_tervalidasi = $produk_lelang + $produk_invest;

    //produk belum tervalidasi
    $produk_lelang1 = count(Auction_product::whereIn('status',[1,3,4])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $produk_invest2 = count(Invest_product::whereIn('status',[1,3,4])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());   
    $prdk_novalidasi = $produk_lelang1 + $produk_invest2;

    //mitra tervalidasi
    $mitra1 = count(Mitra_koperasi::where('status','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $mitra2 = count(Kelompok_tani::where('status','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $mitra3 = count(Mitra_perorangan::where('status','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $mitra_tervalidasi = $mitra1 + $mitra2 + $mitra3;

    //mitra belum tervalidasi
    $nomitra1 = count(Mitra_koperasi::whereIn('status',[1,3])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $nomitra2 = count(Kelompok_tani::whereIn('status',[1,3])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $nomitra3 = count(Mitra_perorangan::whereIn('status',[1,3])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
    $novalid_mitra = $nomitra1 + $nomitra2 + $nomitra3;
    
   
    return view('admin.beranda',[
        'kategori' => $kategori, 
        'data' => $data,
        'pem_tervalidasi' => $pem_tervalidasi,
        'pem_novalidasi'=> $pem_novalidasi,
        'komplain' => $komplain,
        'saldo' => $saldo,
        'prdk_tervalidasi' => $prdk_tervalidasi,
        'prdk_novalidasi' => $prdk_novalidasi,
        'mitra_tervalidasi' =>  $mitra_tervalidasi,
        'novalid_mitra' => $novalid_mitra,
        'jml_bulan' => $jml_bulan,
        ]);

}

//filter
public function filter(Request $request){

$year = Carbon::now()->format('Y');
$month = $request->bulan;
$month_now = Carbon::now()->format('m');

$produk_jb = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_now)->get());
$produk_lelang = count(Auction_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_now)->get());
$produk_invest = count(Invest_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_now)->get()); 

$kategori = array('Jual-Beli', 'Lelang', 'Investasi');
$data  = array($produk_jb,$produk_lelang,$produk_invest);


$jan = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '1')->get());
$feb = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '2')->get());
$mar = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '3')->get());
$apr = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '4')->get());
$mei = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '5')->get());
$jun = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '6')->get());
$jul = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '7')->get());
$ags = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '8')->get());
$sep = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '9')->get());
$okt = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '10')->get());
$nov = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '11')->get());
$des = count(Shop_product::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', '12')->get());
$jml_bulan = array($jan,$feb,$mar,$apr,$mei,$jun,$jul,$ags,$sep,$okt,$nov,$des);

    
//tervalidasi
$valid1 = count(Confirm_payment::where('status','3')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$valid2 = count(Invest_confirm::where('status','3')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$pem_tervalidasi = $valid1+$valid2;

//belum tervalidasi
$novalid1 = count(Confirm_payment::whereIn('status',[1,2])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$novalid2 = count(Invest_confirm::whereIn('status',[1,2])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$pem_novalidasi = $valid1+$valid2;

//komplain
$komplain_jb = count(Complaint::All());
$komplain_lelang = count(Auction_complaint::All());
$komplain = $komplain_lelang + $komplain_jb;

//pencairan_saldo
$saldo = count(Balance_withdrawal::All());

//produktervalidasi
$produk_lelang = count(Auction_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$produk_invest = count(Invest_product::where('status',"2")->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());   
$prdk_tervalidasi = $produk_lelang + $produk_invest;

//produk belum tervalidasi
$produk_lelang1 = count(Auction_product::whereIn('status',[1,3,4])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$produk_invest2 = count(Invest_product::whereIn('status',[1,3,4])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());   
$prdk_novalidasi = $produk_lelang1 + $produk_invest2;

//mitra tervalidasi
$mitra1 = count(Mitra_koperasi::where('status','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$mitra2 = count(Kelompok_tani::where('status','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$mitra3 = count(Mitra_perorangan::where('status','2')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$mitra_tervalidasi = $mitra1 + $mitra2 + $mitra3;

//mitra belum tervalidasi
$nomitra1 = count(Mitra_koperasi::whereIn('status',[1,3])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$nomitra2 = count(Kelompok_tani::whereIn('status',[1,3])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$nomitra3 = count(Mitra_perorangan::whereIn('status',[1,3])->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get());
$novalid_mitra = $nomitra1 + $nomitra2 + $nomitra3;


return view('admin.beranda-update',[
    'kategori' => $kategori, 
    'data' => $data,
    'pem_tervalidasi' => $pem_tervalidasi,
    'pem_novalidasi'=> $pem_novalidasi,
    'komplain' => $komplain,
    'saldo' => $saldo,
    'prdk_tervalidasi' => $prdk_tervalidasi,
    'prdk_novalidasi' => $prdk_novalidasi,
    'mitra_tervalidasi' =>  $mitra_tervalidasi,
    'novalid_mitra' => $novalid_mitra,
    'jml_bulan' => $jml_bulan

    ]);

}


    public function adminProfile(){

   $data = Profile_admin::where('role',Auth::user()->id)->first();
		$data2 = User::where('id',Auth::user()->id)->first();
		$role_id = Model_has_role::where('model_id', Auth::user()->id)->first();
		$role = $role_id->roles->name;

		if($data == NULL){
			return view('admin.tambah-profile',compact('data2','role'));
		}else{
			return view('admin.admin-profile', compact('data','data2','role'));
		}
      
    }

    public function profileUpdate(Request $request){

		$rules = array(
				'nama' => 'required',
			    'no_hp' => 'required|max:13',
			    'alamat' => 'required|string|max:255',
			    'foto' => 'mimes:jpeg,bmp,png|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
		 return response()->json(['errors' => $error->errors()->all()]);
	 }
		
        if (empty($request->file('foto'))) {
			$data2 = Profile_admin::where('role',Auth::user()->id)->first();
            $data2->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
			]);
			$data3 = User::where('id',Auth::user()->id)->first();
			$data3->update([
				'name' => $request->nama,
            ]);
            
            // $provider = User::where('id',$id_admin);
            // $provider->update([
            //     'provider_id' => "11010510910097",
            // ]);
        } else {

			$data2 = Profile_admin::where('role',Auth::user()->id)->first();
			Storage::delete($data2->foto);
            $data2->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'foto' => $request->file('foto')->store('Foto_profile'),
			]);
			$data3 = User::where('id',Auth::user()->id)->first();
			$data3->update([
				'name' => $request->nama,
            ]);
            // $provider = User::where('id',$id_admin);
            // $provider->update([
            //     'provider_id' => "11010510910097",
            // ]);
			
		}
    
        // $produk_jb = count(Shop_product::All());
        // $produk_lelang = count(Auction_product::where('status',"2")->get());
        // $produk_invest = count(Invest_product::where('status',"2")->get());   
    
        // $kategori = array('Jual-Beli', 'Lelang', 'Investasi');
        // $data  = array($produk_jb,$produk_lelang,$produk_invest);
        Alert::success('Berhasil diupdate !');
        // return view('admin.beranda',['kategori' => $kategori, 'Data' => $data]);
        return redirect()->action('Admin\HomeController@index');
        
    }

    public function tambahProfile(Request $request){

		$this->validate($request, [
            'no_hp' => 'required|max:13',
            'alamat' => 'required|string|max:255',
            'foto' => 'required|mimes:jpeg,bmp,png|max:2048'
        ]);
        if (empty($request->file('foto'))) {
            Profile_admin::create([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
			]);
        } else {
            $id_admin = Auth::user()->id;
            Profile_admin::create([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'foto' => $request->file('foto')->store('Foto_profile'),
                'role' => $id_admin,
            ]);
            $provider = User::where('id',$id_admin);
            $provider->update([
                'provider_id' => "11010510910097",
            ]);
        }

      
		// $produk_jb = count(Shop_product::All());
        // $produk_lelang = count(Auction_product::where('status',"2")->get());
        // $produk_invest = count(Invest_product::where('status',"2")->get());   

        // $kategori = array('Jual-Beli', 'Lelang', 'Investasi');
        // $data  = array($produk_jb,$produk_lelang,$produk_invest);
        
        Alert::success('Berhasil disimpan !');
        // return view('admin.beranda',['kategori' => $kategori, 'Data' => $data]);	

        return redirect()->action('Admin\HomeController@index');
        
	}
	
	public function profile2Update(Request $request){

		$rules = array(
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
		 return response()->json(['errors' => $error->errors()->all()]);
	 }

			$data2 = User::where('id',Auth::user()->id)->first();
            $data2->update([
				'email' => $request->email,
				'password' => Hash::make($request->password),
			]);

       
        // $produk_jb = count(Shop_product::All());
        // $produk_lelang = count(Auction_product::where('status',"2")->get());
        // $produk_invest = count(Invest_product::where('status',"2")->get());   
    
        // $kategori = array('Jual-Beli', 'Lelang', 'Investasi');
        // $data  = array($produk_jb,$produk_lelang,$produk_invest);
        
        Alert::success('Berhasil diupdate !');
        // return view('admin.beranda',['kategori' => $kategori, 'Data' => $data]);

        return redirect()->action('Admin\HomeController@index');
        
    }
}
