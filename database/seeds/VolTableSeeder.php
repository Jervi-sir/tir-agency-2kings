<?php
use App\Vol;
use Illuminate\Database\Seeder;

class VolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create();

        for ($i=0; $i < 5; $i++) {
            Vol::create([
                'titre'                 => $faker->sentence(2),
                'slug'                  => $faker->slug,
                'nombre_places'         => $faker->numberBetween(1, 300),
                'type_service'          => 'vols',
                'image'                 => 'https://via.placeholder.com/200x250',
                'type_Vol'              => $faker->sentence(1) ,
                'lieu'              => $faker->sentence(1) ,
                // 'code_palce'            => $faker->numberBetween(1, 300),
                
                'etoiles'               => $faker->numberBetween(1, 5),
                'nom_avion'             => $faker->sentence(1),
                'code_vol'              => $faker->sentence(1),
                'ligne_nom'          => $faker->sentence(1),
                'description'           => $faker->text,

                'ligne_depart'          => $faker->sentence(1),
                'ligne_arrivee'         => $faker->sentence(1),
                'date_depart'           => $faker-> dateTime('2020-04-20 08:00:00', 'GMT+1'),
                'date_arrivee'          => $faker-> dateTime('2020-04-20 08:00:00', 'GMT+1'),
                'dernier_delai_de_vol'  => $faker-> dateTime('2020-04-21 08:00:00', 'GMT+1'),
                'promotion_delai'       => $faker-> dateTime('2020-07-21 08:00:00', 'GMT+1'),
                
                'prix'                  => $faker->numberBetween(15, 300) * 100 ,
                // 'type_payment'          => $faker->sentence(1) ,

                'annulation'           => $faker->boolean(50),
                
                // 'escal'                 => $faker->sentence(1),
                // 'airport'               => $faker->sentence(1),

                'promotion_pourcentage'     => 0,

            ]);
        }
    }
}
