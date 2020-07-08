<?php

use App\Place;
use Illuminate\Database\Seeder;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create();

        for ($i=0; $i < 300; $i++) 
        {
            Place::create([
                'vol_id'                    => $faker->numberBetween(1, 5),
                'code_place'                => $faker->numberBetween(1, 300),
                'numero_place'              => $i,
                // 'prix_place'                => $faker->numberBetween(15, 300) * 100 ,
                'occupee'                   => $faker->boolean(50) ,
                // 'economique'                => $faker->boolean(50) ,
                'type_service'              => 'places',
                // 'type_place'                => $faker->sentence(1),

            ]);
    }
}
}
