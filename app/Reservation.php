<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = []; 			//laravel mentioned it where Reservation is as a child


    public function paymentDateFormat()
    {
        $date = $this->paiment_cree_a->format('d-m-Y');
        return $date;
    }


    public function voiture()
    {
        return $this->belongsTo('App\Voiture');  //depend on Voiture existance table
    }

    
    public function chambre()
    {
    	return $this->belongsTo('App\Chambre');	    //depend on Chambre existance table
    }


    public function place()
    {
    	return $this->belongsTo('App\Place'); 	//depend on Vol existance table
    }


    public function user()
    {
        return $this->belongsTo('App\User');        //depend on User existance table
    } 

}
