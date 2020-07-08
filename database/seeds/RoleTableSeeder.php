<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::create(['nom_role' => 'administrateur']);
    	Role::create(['nom_role' => 'client']);
    	Role::create(['nom_role' => 'receptionniste']);

    }

}
