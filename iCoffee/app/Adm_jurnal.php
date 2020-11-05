<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Adm_jurnal extends Model
{
	protected $table = 'adm_jurnal';

	protected $primarykey='id';

	protected $fillable = ['nama_tran','bukti','catatan','no_tran','tujuan_tran','id_kat_jurnal','total_jumlah'];

	public static function noTrans(){
		$tahunSekarang = date('Y');
		$bulanSekarang = date('m');
		$tahunTerakhir = substr($tahunSekarang,2);
		$digitBulan = strlen($bulanSekarang);
		if($digitBulan == 1){
		  $bulanTerakhir = "0".$bulanSekarang;
		} else {
		  $bulanTerakhir = $bulanSekarang;     
	   }
   
	   $transaksiKas = Adm_jurnal::select([DB::raw('MONTH(created_at) bulan'),'no_tran'])
						 ->orderBy('id','DESC')->first();
	   if($transaksiKas != null){
		 $angkaNoKas = explode("/",$transaksiKas->no_tran);
		 $nomor = $angkaNoKas[0];
		 $bulanAkhir = $transaksiKas->bulan;
	   } else {
		 $nomor = 1;
		 $bulanAkhir = 13;
	   }
	   if($bulanAkhir != $bulanSekarang ){
		 $noTrans = "1/KS/". $bulanTerakhir . "/".$tahunTerakhir;      
	   } else {
		 $nomor++;
		 $noTrans = $nomor . "/KS/". $bulanTerakhir ."/". $tahunTerakhir;     
	   }
	   return $noTrans;
	  }


}
	