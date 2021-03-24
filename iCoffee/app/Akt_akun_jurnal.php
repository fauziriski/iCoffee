<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Akt_akun_jurnal extends Model
{
    protected $table = 'akt_akun_jurnal';

	protected $fillable = ['id_akt_jurnal','id_akt_akun','no_jurnal','debit','kredit'];
    public $timestamps = true;

    public function jurnal()
    {
        return $this->belongsTo('App\Akt_jurnal', 'id_akt_jurnal','id');
    }

	public function akt_akun()
    {
    	return $this->belongsTo('App\Akt_akun', 'id_akt_akun','id');
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
   
	   $transaksiJurnal = Akt_akun_jurnal::select([DB::raw('MONTH(created_at) bulan'),'no_jurnal'])
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
