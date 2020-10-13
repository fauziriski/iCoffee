<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'name' => 'adminsuper'

        ]);

        Role::create([
            'name' => 'adminkeuangan'

        ]);

        Role::create([
            'name' => 'adminweb'

        ]);

        Role::create([
            'name' => 'adminuser'

        ]);

        Role::create([
            'name' => 'user'

        ]);

    }
}
