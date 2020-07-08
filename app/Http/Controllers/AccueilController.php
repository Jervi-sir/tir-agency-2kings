<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{

    function refreshHotel()
        {
            $hotels_refresh = \App\Hotel::all();    
                                                    //since eloquent rls dont work in the mass object at once 
            foreach($hotels_refresh as $hotel)  
            {
                 $min_of_chambres = $hotel->chambres->min('prix') ?? 0;         //got to turn max_jour , to prix_min in db table
                 $hotel->prix = $min_of_chambres;

                 $count_chambres_libre = $hotel->chambres->where('occupee','=',0)->count();
                 $hotel->chambres_disponible  = $count_chambres_libre;

                 $hotel->save();
            }
        }
        
    public function index() 
    {
        $this->refreshHotel();              //refresh Hotel 
        
        $hotels = \App\Hotel::has('chambres')->where('etoiles','>',3)->get();

        if(request()->has('currency'))
        {
            $array = array("dzd","dzd","eur","gbp","usd");

            $currency = $array[request()->input('currency')];
            
            session(['currency' => $currency]);

            return back()->with('hotels',$hotels);
        }

    	return view('accueils.index',['hotels' => $hotels]);
    }

    

}
