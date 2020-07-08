<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
// use TCG\Voyager\Models\Role;
// use TCG\Voyager\Models\User;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            //$role = Role::where('name', 'admin')->firstOrFail();
            $role = Role::select('id')->where('nom_role','administrateur')->first()->id;

            User::create([
                'role_id'        => $role,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
            ]);

        }
    }
}
