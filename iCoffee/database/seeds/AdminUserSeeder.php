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
            'name' => 'Admin Icoffee',
            'email' => 'adminicoffee@icoffee.co.id',
            'password' =>  bcrypt('wifinyarusak'),
        ]);

        $user->assignRole('admin');
    }
}
