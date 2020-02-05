<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Adm_kat_jurnal;
use Carbon\Carbon;

class Kategori_pencatatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Adm_kat_jurnal::create([
    		'nama_kat' => 'Administrasi',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_kat_jurnal::create([
    		'nama_kat' => 'Pembelian Aset',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_kat_jurnal::create([
    		'nama_kat' => 'Lain-lain',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    }
}
