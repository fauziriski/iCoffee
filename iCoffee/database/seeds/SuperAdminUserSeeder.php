<?php

use Illuminate\Database\Seeder;
use App\User;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([
            'name' => 'Super Admin Icoffee',
            'email' => 'superadminIcoffee@icoffee.co.id',
            'password' =>  bcrypt('wifinyarusak'),
        ]);

        $user->assignRole('superadmin');
    
    }
}
