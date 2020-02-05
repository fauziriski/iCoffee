<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Adm_kat_akun;
use Carbon\Carbon;

class Kategori_akun extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adm_kat_akun::create([
          'nama_kat' => 'Aktiva',
          'no_akun' => '1.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Adm_kat_akun::create([
          'nama_kat' => 'Kewajiban',
          'no_akun' => '2.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Adm_kat_akun::create([
          'nama_kat' => 'Ekuitas',
          'no_akun' => '3.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Adm_kat_akun::create([
          'nama_kat' => 'Pendapatan',
          'no_akun' => '4.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Adm_kat_akun::create([
          'nama_kat' => 'Harga Pokok Penjualan',
          'no_akun' => '5.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Adm_kat_akun::create([
          'nama_kat' => 'Biaya Usaha',
          'no_akun' => '6.',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
        

    }
}
