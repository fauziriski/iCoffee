<?php

use Illuminate\Database\Seeder;
use App\User;


class AdminKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
    {
        
        $user = User::create([
            'name' => 'Admin Keuangan',
            'email' => 'adminkeuangan@icoffee.asia',
            'password' =>  bcrypt('icoffee.asia'),
            'provider_id' => 'admin-icoffee',
        ]);

        $user->assignRole('adminkeuangan');
        
    }
}