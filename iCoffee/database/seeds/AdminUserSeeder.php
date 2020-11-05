<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'adminuser@icoffee.asia',
            'password' =>  bcrypt('icoffee.asia'),
            'provider_id' => 'admin-icoffee',
        ]);

        $user->assignRole('adminuser');
    }
}
