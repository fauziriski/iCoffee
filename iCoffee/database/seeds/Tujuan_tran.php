
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Adm_tranksaksi;
use Carbon\Carbon;

class Tujuan_tran extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Adm_tranksaksi::create([
    		'nama_tran' => 'Internal Perusahaan',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_tranksaksi::create([
    		'nama_tran' => 'Toko ATK/Foto copy',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);
    }

}
