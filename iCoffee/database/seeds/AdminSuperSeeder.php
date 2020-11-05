<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSuperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $user = User::create([
            'name' => 'Admin Super',
            'email' => 'adminsuper@icoffee.asia',
            'password' =>  bcrypt('icoffee.asia'),
            'provider_id' => 'admin-icoffee',
        ]);

        $user->assignRole('adminsuper');
    }
}
