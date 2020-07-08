<?php
use App\Chambre;
use Illuminate\Database\Seeder;

class ChambreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create();

        for ($i=0; $i < 60; $i++) 
        {
            Chambre::create([


                'titre'             => $faker->sentence(3),
                'slug'              => $faker->slug,
                'image'             => 'https://via.placeholder.com/200x250',
                'type_service'      => 'chambres',
                'occupee'           => $faker->boolean(50) ,
                'etage'             => $faker->numberBetween(1, 10),
                'numero_chambre'    => $faker->numberBetween(1, 100),
                'nb_lit'            => $faker->numberBetween(1, 5),
                'superficie'        => $faker->numberBetween(5, 100),
                // 'reviews'           => $faker->numberBetween(0, 100),
                
                'description'       => $faker->text,
                // 'options'           => $faker->sentence(4) ,
                
                'prix'              => $faker->numberBetween(15, 300) * 100 ,
                
                'repas'             => $faker->boolean(50) ,
                'annulation'       => $faker->boolean(50) ,
                'avec_enfant'            => $faker->boolean(50) ,
                
                'hotel_id'          => $faker->numberBetween(1, 6),

                'promotion_pourcentage'    => 0,
                'promotion_delai'       => $faker-> dateTime('2020-07-21 08:00:00', 'GMT+1'),
                
    ]);
        }
            }
}
