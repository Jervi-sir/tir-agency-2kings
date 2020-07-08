<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;

class AdminPlaceVolController extends Controller
{
    
    /*AFFICHER LES TABLE DE DONNE TA3 VOITURES*/
    public function index()
    {
        $places = new Place;
        
        $places = $places->orderBy('id', 'desc');

        $places = $places->paginate(20);

        return view('admin.volsPlaces.index')->with('places', $places); 
    }

    public function supprimer(Request $request)
    {
        Place::destroy($request->place_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            Place::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function afficher(Request $request)
    {
        $place    = Place::find($request->place_id);

        return view('admin.volsPlaces.show',['place'=> $place]);
    }

    public function redirect_pour_ajouter()
    {
        return view('admin.volsPlaces.ajouter');
    }


}
