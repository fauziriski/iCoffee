<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  $this->call(RolesTableSeeder::class);
        //  $this->call(AdminUserSeeder::class);
        //  $this->call(AdminSuperSeeder::class);
        //  $this->call(AdminKeuanganSeeder::class);
        //  $this->call(AdminWebSeeder::class);
         $this->call(TermCondisionTableSeeder::class);

        //  $this->call(Adm_kat_akun::class);
        //  $this->call(Adm_sub1_akun::class);
        //  $this->call(Adm_sub2_akun::class);
        //  $this->call(Adm_tranksaksi::class);
        //  $this->call(Kategori_jurnal::class);

    }
}
