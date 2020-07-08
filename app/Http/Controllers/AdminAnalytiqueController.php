<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voiture;
use App\Avion;
use App\Place;
use App\Hotel;
use App\Chambre;
use App\User;

class AdminAnalytiqueController extends Controller
{
     public function index()
    {	
    	$voitures 		= Voiture::all();
    	$vols 			= Avion::all();
    	$places 		= Place::all();
    	$hotels 		= Hotel::all();
    	$chambres 		= Chambre::all();
    	$utilisateurs	= User::all();
        return view('admin.analytique.index',['voitures' 	=> $voitures,
        										'vols' 		=> $vols,
        										'places' 	=> $places,
        										'hotels' 	=> $hotels,
        										'chambres' 	=> $chambres,
        										'utilisateurs' 	=> $utilisateurs,
    										]);
    }

}
