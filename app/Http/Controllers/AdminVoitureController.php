<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voiture;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminVoitureController extends Controller
{
    /*AFFICHER LES TABLE DE DONNE TA3 VOITURES*/
    public function index()
    {
         $voitures = new Voiture;
        
        $voitures = $voitures->orderBy('id', 'desc');

        $voitures = $voitures->paginate(20);

        return view('admin.voitures.index')->with('voitures', $voitures);
    }

    /*Delete selected VOITURE*/
    public function supprimer(Request $request)
    {
        Voiture::destroy($request->voiture_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            Voiture::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }
    
    /*Afficher selected Voiture*/
    public function afficher(Request $request)
    {
        $voiture    = Voiture::find($request->voiture_id);

        return view('admin.voitures.show',['voiture'=> $voiture]);
    }

    /*redirecter l page bah tzid un voiture*/
   public function redirect_pour_ajouter()
    {
        return view('admin.voitures.ajouter');
    }

    /*OPERATION d ajout f base d donne */
    public function ajouter(Request $request)
    {
        $voiture = new Voiture;
        $voiture->titre = $request->titre ;
        $voiture->slug = $request->slug ;
        $voiture->lieu = $request->lieu ;
        $voiture->type_service =  "voitures";
        $voiture->occupee =  0;
        $voiture->portes = $request->portes ;
        $voiture->etoiles = $request->etoiles ;
        $voiture->nombre_places = $request->places ;
        $voiture->type_voiture = $request->type_voiture ;
        $voiture->description = $request->description ;
        $voiture->annee = $request->annee ;
        $voiture->prix = $request->prix ;
        $voiture->promotion_pourcentage = $request->promotion ;
        $voiture->promotion_delai = $request->delai_promotion ;

        /*logiques */
        $voiture->km_illimite = ($request->km_ilimitee) ? 1 : 0;
        $voiture->assurance = ($request->assurance) ? 1 : 0 ;
        $voiture->climatiseur = ($request->climatiseur) ? 1 : 0 ;
        $voiture->manuel = ($request->manuel) ? 1 : 0 ;
        $voiture->electric = ($request->electric) ? 1 : 0 ;
        $voiture->annulation = ($request->annulation) ? 1 : 0 ;

        if($request->images1[0] != null)
        {
            $imagesPath = [];
            $path = 'voitures'.DIRECTORY_SEPARATOR;
            foreach ($request->images1 as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $voiture->images = json_encode($imagesPath) ;

        }
       
        $voiture->image = 'voitures'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->image ;

        $voiture->save();

        return back()->with('success', 'La Voiture a bien été Ajouetée.');
    }

    public function rechercher()
    {
        $titre     = request()->input('titre');      

        $voitures = new Voiture;

        $voitures = Voiture::where('titre' , 'like', "%$titre%")->orderBy('id', 'desc');

        $voitures = $voitures->paginate(20);
      
        return view('admin.voitures.index',['voitures'=> $voitures]);   

    }


    public function edit(Request $request)
    {
        $voiture    = Voiture::find($request->voiture_id);

        return view('admin.voitures.edit',['voiture'=> $voiture]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required'
        ]);

        $voiture    = Voiture::find($request->voiture_id);

        $voiture->titre = $request->input('titre');
        
        $voiture->lieu = $request->input('lieu');
        $voiture->portes = $request->input('portes');
        $voiture->etoiles = $request->input('etoiles');
        $voiture->nombre_places = $request->input('nombre_places');
        $voiture->type_voiture = $request->input('type_voiture');
        $voiture->description = $request->input('description');
        $voiture->annee = $request->input('annee');
        $voiture->prix = $request->input('prix');
        $voiture->promotion_pourcentage = $request->input('promotion');
        $voiture->promotion_delai = $request->input('delai_promotion');

        /*logiques */
        $voiture->km_illimite = ($request->input('km_illimite')) ? 1 : 0;
        $voiture->assurance = ($request->input('assurance')) ? 1 : 0;
        $voiture->climatiseur = ($request->input('climatiseur')) ? 1 : 0;
        $voiture->manuel = ($request->input('manuel')) ? 1 : 0;
        $voiture->electric = ($request->input('electric')) ? 1 : 0;
        $voiture->annulation = ($request->input('annulation')) ? 1 : 0;


        if($request->images[0] != null)
        {
            $imagesPath = [];
            $path = 'voitures'.DIRECTORY_SEPARATOR;
            foreach ($request->input('images') as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $voiture->images = json_encode($imagesPath);
        }
        if($request->image != null)
        {
            $voiture->image = 'voitures'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->input('image');
        }

 

        $voiture->save();

        return back()->with('successEdit', 'La voiture a été modifiée avec succés.');
    }
}
