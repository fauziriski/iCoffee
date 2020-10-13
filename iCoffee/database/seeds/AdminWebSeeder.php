<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin Web',
            'email' => 'adminweb@icoffee.asia',
            'password' =>  bcrypt('icoffee.asia'),
            'provider_id' => 'admin-icoffee',
        ]);

        $user->assignRole('adminweb');
    }
}
