<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OmraRendezVous extends Model
{
    public function omra() 
	{
		return $this->belongsTo('App\Omra'); 	//chambre depends on one hotel existance
	}
}
