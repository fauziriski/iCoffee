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
            'email' => 'adminkeuanganicoffee@icoffee.co.id',
            'password' =>  bcrypt('wifinyarusak'),
        ]);

        $user->assignRole('adminkeuangan');
        
    }
}