<?php

use Illuminate\Database\Seeder;

class AgenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Agence::create([
                'nom_agence'                => "Tir",
                'logo'                			=> "agence\\logo.png",
               	'email'                			=> "business-yeee@yeee.com",
               	'telephone'                 => "+213 (0) 00 00 00 00",
               	'lieu_lat_long'             => "35.291960, -1.124787",
               	'a_propos_agence'           => 
                "Recherchez des vols, hôtels, locations de voitures, guides touristiques et plus encore sur Tir. Tir parcourt des centaines annonces de voyage et trouve les informations, qu’il vous faut pour prendre la meilleure décision.",
                'reseaux_sociaux'                     => "reseaux_sociaux-yeee@yeee.com",
            ]);
    }
}
