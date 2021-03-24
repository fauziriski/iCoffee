<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Akt_jurnal extends Model
{
    protected $table = 'akt_jurnal';
	protected $primarykey='id';

	protected $fillable = ['id_kat_jurnal','id_akt_tujuan','no_transaksi','nama_transaksi','bukti','catatan','total_jumlah'];
    public $timestamps = true;

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
   
	   $transaksiKas = Akt_jurnal::select([DB::raw('MONTH(created_at) bulan'),'no_transaksi'])
						 ->orderBy('id','DESC')->first();
	   if($transaksiKas != null){
		 $angkaNoKas = explode("/",$transaksiKas->no_transaksi);
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

      public function akt_tujuan()
      {
          return $this->belongsTo('App\Akt_tujuan', 'id_akt_tujuan','id');
      }

      public function akun_jurnal()
      {
          return $this->hasMany('App\Akt_akun_jurnal');
      }

}
