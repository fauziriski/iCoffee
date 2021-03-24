<?php

use Illuminate\Database\Seeder;
use App\Akt_kat_akun;
use Carbon\Carbon;
class KatAkunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Akt_kat_akun::create([
          'nama_kategori' => 'AKTIVA',
          'saldo_normal' => 'debit',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Akt_kat_akun::create([
          'nama_kategori' => 'LIABILITAS',
          'saldo_normal' => 'kredit',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Akt_kat_akun::create([
          'nama_kategori' => 'EKUITAS',
          'saldo_normal' => 'kredits',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Akt_kat_akun::create([
          'nama_kategori' => 'PENDAPATAN',
          'saldo_normal' => 'kredit',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        Akt_kat_akun::create([
          'nama_kategori' => 'BEBAN PENGELUARAN',
          'saldo_normal' => 'debit',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
        

    }
}
