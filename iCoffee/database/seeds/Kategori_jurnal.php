<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Adm_kat_jurnal;
use Carbon\Carbon;

class Kategori_jurnal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Adm_kat_jurnal::create([
            'kode_kat' =>'AKM-A',
            'nama_kat' => 'Arus Kas Masuk - Administrasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Adm_kat_jurnal::create([
            'kode_kat' =>'AKK-A',
            'nama_kat' => 'Arus Kas Keluar - Administrasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Adm_kat_jurnal::create([
            'kode_kat' =>'AKM-I',
            'nama_kat' => 'Arus Kas Masuk - Investasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Adm_kat_jurnal::create([
            'kode_kat' =>'AKK-I',
            'nama_kat' => 'Arus Kas Keluar - Investasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Adm_kat_jurnal::create([
            'kode_kat' =>'AKM-JB',
            'nama_kat' => 'Arus Kas Masuk - Jual/Beli',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Adm_kat_jurnal::create([
            'kode_kat' =>'AKK-JB',
            'nama_kat' => 'Arus Kas Keluar- Jual/Beli',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Adm_kat_jurnal::create([
            'kode_kat' =>'AKM-L',
            'nama_kat' => 'Arus Kas Masuk - Lelang',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Adm_kat_jurnal::create([
            'kode_kat' =>'AKK-L',
            'nama_kat' => 'Arus Kas Keluar- Lelang',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
