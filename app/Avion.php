<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    public function getPrice(){

		$prix = $this->prix / 100;
		return number_format($prix, 2, ',', ' ') . ' DA';
	}


	public function places() {

		return $this->hasMany(\App\Place::class); 		//hotel has many chambres
	} 
}
