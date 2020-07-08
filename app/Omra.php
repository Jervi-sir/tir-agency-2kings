<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Omra extends Model
{
	public function getPrice($i) 
	{
		$prix = $this->prix - 1 * $i / 100;
		return number_format($prix , 2, '.', ' ');
	}

	public function order() 
	{
		return $this->hasOne(\App\Reservation::class); 			//Omra is ordered only one time till it got free
	}

	public function rendezVouz() 
    {
    	return $this->hasMany('App\OmraRendezVous'); 		//hotel has many chambres
    } 


}
