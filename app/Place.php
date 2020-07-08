<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [];	 		//laravel said it 

	public function getPrice()
	{
		$prixChambre = $this->prix_chambre / 100;
		return number_format($prixChambre, 2, ',', ' ') . ' DA';
	}

	public function order()
	{
		return $this->hasOne(\App\Reservation::class); 	//chambre has one order since if chambre is deleted 
	}											//then cascadely will be deleted from order too

	public function avion() 
	{
		return $this->belongsTo(\App\Avion::class); 	//chambre depends on one hotel existance
	}
}
