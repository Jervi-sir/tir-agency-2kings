<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avion;
use App\Place;
use Carbon\Carbon;

class AdminAvionController extends Controller
{

    /*AFFICHER LES TABLE DE DONNE TA3 avions*/
    public function index()
    {
         $avions = new Avion;

        
        $avions = $avions->orderBy('id', 'desc');

        $avions = $avions->paginate(20);

        return view('admin.avions.index')->with('avions', $avions);
    }

    /*Delete selected Vol*/
    public function supprimer(Request $request)
    {
        Avion::destroy($request->vol_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            Avion::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }


    /*Afficher selected avions*/
    public function afficher(Request $request)
    {
        $vol    = Avion::find($request->vol_id);

        return view('admin.avions.show',['vol'=> $vol]);
    }
        
    /*redirecter l page bah tzid un vol*/
    public function redirect_pour_ajouter()
    {
        return view('admin.avions.ajouter');
    }

    /*OPERATION d ajout f base d donne */
    public function ajouter(Request $request)
    {

        $array_id = explode(' ', $request->nb_place);       
        $nb_place = $array_id[2];

        $titre = str_replace("-", "_", $request->titre);

        $avion = new Avion;
        $avion->titre                 = $request->titre ;
        $avion->slug                  = str_replace(" ", "_", $titre) ."_". Carbon::now()->timestamp;
        $avion->nombre_places         = $nb_place ;
        $avion->etoiles               = $request->etoiles ;
        $avion->nom_avion             = $request->nom_avion ;
        $avion->lieu_depart           = $request->lieu_depart ;
        $avion->lieu_arrivee          = $request->lieu_arrivee ;
        $avion->aeroport_depart       = $request->aeroport_depart ;
        $avion->aeroport_arrivee      = $request->aeroport_arrivee ;
        $avion->date_depart           = $request->date_depart ;
        $avion->date_retour           = $request->date_retour ;
        $avion->duree_vol             = $request->duree_vol ;
        $avion->prix                  = $request->prix ;
        $avion->promotion_pourcentage = $request->promotion ;
        $avion->promotion_delai       = $request->delai_promotion ;

        $avion->annulation            = ($request->annulation) ? 1 : 0;

        $avion->description           = $request->description ;
        $avion->type_service          =  "avions";

        /*immages*/
        if($request->images1[0] != null)                            //if multiple images
        {   //operation to serializer les immages sellected to make then on a single cell in db
            $imagesPath = [];
            $path = 'avions'.DIRECTORY_SEPARATOR;
            foreach ($request->images1 as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $avion->images = json_encode($imagesPath) ;

        }

        $avion->image = 'avions'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->image ;

        $avion->save();

        //add places automatically
        for($i = 1; $i <$nb_place; $i++)
        {
            $places = new Place;
            $places->avion_id = $avion->id ;
            $places->code_place = $i ;
            $places->numero_place = $i ;
            $places->occupee = 0 ;
            $places->type_service = "places" ;
            
            $places->save();
        }


        return back()->with('success', 'L\'avion et ses places ont bien été ajoutées.');

    }


    public function rechercher()
    {
        $titre     = request()->input('titre');      

        $avions = new Avion;

        $avions = Avion::where('titre' , 'like', "%$titre%")->orderBy('id', 'desc');

        $avions = $avions->paginate(20);
      
        return view('admin.avions.index',['avions'=> $avions]);   

    }


    public function later($id)
    {   //the rsult wanted is . A1-B1-C1-D1-E1-F1   A2-B2-C2-D2-E2-F2 .....
        $arr = [];
        $i_arr = 0;
        $i_places = round($request->nb_place / 6);

        for($i = 0; $i < $i_places;$i++)
        {
            foreach(range('A','F') as $letter) 
            { 
               $arr[$i_arr] =  $letter.$i;
               $i_arr++;
            }  
        }
    }
    


    public function edit(Request $request)
    {
        $avion    = Avion::find($request->vol_id);

        return view('admin.avions.edit',['avion'=> $avion]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required'
        ]);

        $array_id = explode(' ', $request->input('nb_place'));       
        $nb_place = $array_id[2];

        $avion    = Avion::find($request->input('avion_id'));

        $avion->titre                 = $request->input('titre');
        $avion->slug                  = $request->input('slug');
        $avion->nombre_places         = $nb_place ;
        $avion->etoiles               = $request->input('etoiles') ;
        $avion->nom_avion             = $request->input('nom_avion') ;
        $avion->lieu_depart           = $request->input('lieu_depart') ;
        $avion->lieu_arrivee          = $request->input('lieu_arrivee') ;
        $avion->aeroport_depart       = $request->input('aeroport_depart') ;
        $avion->aeroport_arrivee      = $request->input('aeroport_arrivee') ;
        $avion->date_depart           = $request->input('date_depart') ;
        $avion->date_retour           = $request->input('date_retour') ;
        $avion->duree_vol             = $request->input('duree_vol') ;
        $avion->prix                  = $request->input('prix') ;
        $avion->promotion_pourcentage = $request->input('promotion') ;
        $avion->promotion_delai       = $request->input('delai_promotion') ;
        $avion->annulation            = ($request->input('annulation')) ? 1 : 0;
        $avion->description           = $request->input('description') ;
        $avion->type_service          =  "avions";
        
        /*immages*/
        if($request->images[0] != null)
        {
            $imagesPath = [];
            $path = 'avions'.DIRECTORY_SEPARATOR;
            foreach ($request->images as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $avion->images = json_encode($imagesPath);

        }

        if($request->image != null)
        {
            $avion->image = 'avions'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->input('image');
        }


        $avion->save();

        // //add places automatically
        // for($i = 1; $i <$nb_place; $i++)
        // {
        //     $places = new Place;
        //     $places->avion_id = $avion->id ;
        //     $places->code_place = $i ;
        //     $places->numero_place = $i ;
        //     $places->occupee = 0 ;
        //     $places->type_service = "places" ;
            
        //     $places->save();
        // }


        return back()->with('successEdit', 'Le vol a été modifiée avec succés.');
    }
 
}
