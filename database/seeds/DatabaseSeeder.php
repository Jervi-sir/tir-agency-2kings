<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HotelTableSeeder::class);
        $this->call(VoitureTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(VolTableSeeder::class);
        $this->call(PlaceTableSeeder::class);
        $this->call(ChambreTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AgenceTableSeeder::class);

    }
}
