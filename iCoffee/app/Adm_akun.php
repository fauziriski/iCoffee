<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Adm_akun extends Model
{
	protected $table = 'adm_akun';

	protected $fillable = ['id_adm_jurnal','no_jurnal','akun_debit','akun_kredit','debit','kredit'];

	public function akun()
	{
		return $this->hasOne('App\Adm_jurnal', 'id', 'id_adm_jurnal');
	}

	public static function noJurnal(){
		$tahunSekarang = date('Y');
		$bulanSekarang = date('m');
		$tahunTerakhir = substr($tahunSekarang,2);
		$digitBulan = strlen($bulanSekarang);
		if($digitBulan == 1){
		  $bulanTerakhir = "0".$bulanSekarang;
		} else {
		  $bulanTerakhir = $bulanSekarang;     
	   }
   
	   $transaksiJurnal = Adm_akun::select([DB::raw('MONTH(created_at) bulan'),'no_jurnal'])
						 ->orderBy('id','DESC')->first();
	   if($transaksiJurnal != null){
		 $angkaNoJurnal = explode("/",$transaksiJurnal->no_jurnal);
		 $nomor = $angkaNoJurnal[0];
		 $bulanAkhir = $transaksiJurnal->bulan;
	   } else {
		 $nomor = 1;
		 $bulanAkhir = 13;
	   }
	   if($bulanAkhir != $bulanSekarang ){
		 $noJurnal = "1/JR/". $bulanTerakhir . "/".$tahunTerakhir;      
	   } else {
		 $nomor++;
		 $noJurnal = $nomor . "/JR/". $bulanTerakhir ."/". $tahunTerakhir;     
	   }
	   return $noJurnal;
   
	  }

}