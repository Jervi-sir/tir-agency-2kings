<?php

use App\Voiture;
use Illuminate\Database\Seeder;

class VoitureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create();

        for ($i=0; $i < 30; $i++) {
            Voiture::create([

                'titre'         => $faker->sentence(2),
                'slug'          => $faker->slug,
                'image'         => 'https://via.placeholder.com/150x100',
                'lieu'      => $faker->sentence(10) ,
                'type_service'  => 'voitures',

                'occupee'       => $faker->boolean(50) ,
                'portes'        => $faker->numberBetween(2, 5),
                'etoiles'       => $faker->numberBetween(1, 5),
                // 'reviews'       => $faker->numberBetween(2, 100),
                'nombre_places' => $faker->numberBetween(2, 10),
                'type_voiture'  => $faker->sentence(2) ,

                'description'   => $faker->text,
                // 'options'       => $faker->sentence(4) ,
                'annee'         => $faker->numberBetween(2010, 2020),

                'prix'          => $faker->numberBetween(15, 300) * 100 ,
                // 'type_payment'  => $faker->sentence(1) ,
                'promotion_delai'  => $faker-> dateTime('2020-07-21 08:00:00', 'GMT+1'),

                'km_illimite' => $faker->boolean(50),
                'assurance'     => $faker->boolean(50),
                'climatiseur'   => $faker->boolean(50),
                'manuel'        => $faker->boolean(50),
                'electric'      => $faker->boolean(50) ,
                'annulation'   => $faker->boolean(50),

                'promotion_pourcentage'     => 0,

            ]);
        }
    }
}
