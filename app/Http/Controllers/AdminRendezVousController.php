<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OmraRendezVous;


class AdminRendezVousController extends Controller
{

	public function index()
    {
        $meets = new OmraRendezVous;

		$meets = $meets->orderBy('id', 'asc');
        
        $meets = $meets->paginate(6);

        return view('admin.rendezVous.index')->with('meets', $meets);
    }

    public function supprimer(Request $request)
    {
        OmraRendezVous::destroy($request->meet_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            OmraRendezVous::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }
    
    /*Afficher selected meet*/
    public function afficher(Request $request)
    {
        $meet    = OmraRendezVous::find($request->meet_id);

        return view('admin.rendezVous.show',['meet'=> $meet]);
    }


    public function rechercher()
    {
        $titre     = request()->input('titre');      

        $meets = new OmraRendezVous;

        $meets = OmraRendezVous::where('nom' , 'like', "%$titre%")
                                ->orWhere('prenom' , 'like', "%$titre%")
                                ->orderBy('id', 'asc');

        $meets = $meets->paginate(20);
      
        return view('admin.rendezVous.index',['meets'=> $meets]);   

    }




}
