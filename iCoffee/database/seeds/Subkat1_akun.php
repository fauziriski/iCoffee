<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Adm_sub1_akun;
use Carbon\Carbon;

class Subkat1_akun extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Adm_sub1_akun::create([
    		'id_kat_akun' => '1',
    		'no_akun' => '1.1.',
    		'nama_sub' => 'Kas dan setara Kas',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '1',
    		'no_akun' => '1.2.',
    		'nama_sub' => 'Bank',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);


    	Adm_sub1_akun::create([
    		'id_kat_akun' => '1',
    		'no_akun' => '1.3.',
    		'nama_sub' => 'Uang Muka Pembelian',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '1',
    		'no_akun' => '1.4.',
    		'nama_sub' => 'Piutang usaha',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '1',
    		'no_akun' => '1.5.',
    		'nama_sub' => 'Persediaan',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '2',
    		'no_akun' => '2.1.',
    		'nama_sub' => 'Hutang Usaha',
    		'saldo_normal' => 'Kredit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '2',
    		'no_akun' => '2.2.',
    		'nama_sub' => 'Pendapatan Diterima Dimuka',
    		'saldo_normal' => 'Kredit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '3',
    		'no_akun' => '3.1.',
    		'nama_sub' => 'Modal',
    		'saldo_normal' => 'Kredit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '3',
    		'no_akun' => '3.2.',
    		'nama_sub' => 'Laba Ditahan',
    		'saldo_normal' => 'Kredit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '3',
    		'no_akun' => '3.3.',
    		'nama_sub' => 'Laba / Rugi',
    		'saldo_normal' => 'Debit / Kredit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '4',
    		'no_akun' => '4.1.',
    		'nama_sub' => 'Bagi hasil investasi',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]); 

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '4',
    		'no_akun' => '4.2.',
    		'nama_sub' => 'Promosi dan Iklan',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '4',
    		'no_akun' => '4.3.',
    		'nama_sub' => 'Pendapatan Lain-lain',
    		'saldo_normal' => 'Debit',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '5',
    		'no_akun' => '5.1.',
    		'nama_sub' => 'Investasi Kopi',
    		'saldo_normal' => ' ',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Adm_sub1_akun::create([
    		'id_kat_akun' => '6',
    		'no_akun' => '6.1.',
    		'nama_sub' => 'Beban Penjualan',
    		'saldo_normal' => ' ',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);


    	Adm_sub1_akun::create([
    		'id_kat_akun' => '6',
    		'no_akun' => '6.2.',
    		'nama_sub' => 'Beban Umum dan Administrasi',
    		'saldo_normal' => ' ',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);


    }
}
