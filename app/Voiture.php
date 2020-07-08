<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
  public function getPrice($i) 
  {
    $prix = $this->prix - 1 * $i / 100;
    return number_format($prix , 2, '.', ' ');
  }


  public function order() 
  {
    return $this->hasOne(Reservation::class); 			//voiture is ordered only one time till it got free
  }

}
