<?php

namespace App;

use App\Chambre;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  	public function getPrice()
    {
        $prix = $this->min_prix / 100;
        return number_format($prix, 2, ',', ' ') . ' DA';
    }

    public function chambres() 
    {
    	return $this->hasMany('App\Chambre'); 		//hotel has many chambres
    } 



}
