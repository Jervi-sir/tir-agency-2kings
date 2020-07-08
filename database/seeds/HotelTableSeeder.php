<?php
use App\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 5; $i++) 
        {
            Hotel::create([
            /*important*/
                'titre'             => $faker->sentence(4),
                'slug'              => $faker->slug,
                'image'             => 'https://via.placeholder.com/200x250',
                'type_service'      => 'hotels',

            /*ziyada*/
                'description'       => $faker->text,
                'email'             => $faker->sentence(10) ,

                /*prix*/
                // 'type_payment'      => $faker->sentence(1) ,

            /*geo*/
                'lieu'          => $faker->sentence(2) ,

            /*ranking*/
                // 'reviews'           => $faker->numberBetween(1,200),
                'etoiles'           => $faker->numberBetween(1,5),


            /*booleans*/
                'avec_wifi'           => $faker->boolean(50) ,
                'avec_gym'            => $faker->boolean(50) ,
                'avec_animaux'      => $faker->boolean(50) ,
                'avec_parking'        => $faker->boolean(50) ,
                'avec_piscine'        => $faker->boolean(50) ,
                'annulation'       => $faker->boolean(50) ,


            /*Others*/
                'chambres_disponible'          => $faker->numberBetween(1,10),
                'prix'          => $faker->numberBetween(1,10),

                
            ]);



        }    }
}
