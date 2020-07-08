<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chambre;
use App\Hotel;
use Carbon\Carbon;

class AdminChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chambres = new Chambre;

        $chambres = $chambres->orderBy('id', 'desc');

        $chambres = $chambres->paginate(20);

      
        return view('admin.chambres.index',['chambres'=> $chambres]);   
    }

    public function supprimer(Request $request)
    {
        Chambre::destroy($request->chambre_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }
    
    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            Chambre::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }


    public function afficher(Request $request)
    {
        $chambre    = Chambre::find($request->chambre_id);


        return view('admin.chambres.show',['chambre'=> $chambre]);
    }

    public function redirect_pour_ajouter()
    {
        $hotels = new Hotel;

        $hotels = $hotels->all();

        return view('admin.chambres.ajouter',['hotels' => $hotels]);
    }

    
    public function ajouter(Request $request)
    {
        $hotel_id_but_array = explode(' ..', $request->hotel_id);       //to take the first number of seletion
                                                             // since it is the id of the hotel
        $hotel_id = $hotel_id_but_array[0];

        $last_chambre_number = Hotel::find(intval($hotel_id))->chambres()->max('numero_chambre');

        for($i = 1; $i <= $request->nb_chambres; $i++ )
        {
            $chambre = new Chambre;
            $chambre->titre = $request->titre ;
            $chambre->slug = str_replace(" ", "_", $request->titre) ."_". Carbon::now()->timestamp .$i ;
            $chambre->type_service =  "chambres";
            $chambre->numero_chambre = $last_chambre_number + $i ;
            $chambre->nb_lit = $request->nb_lit ;
            $chambre->superficie = $request->superficie ;
            $chambre->prix = $request->prix ;
            $chambre->promotion_pourcentage = $request->promotion ;
            $chambre->promotion_delai = $request->delai_promotion ;
            $chambre->description = $request->description ;
            $chambre->occupee = 0 ;
            $chambre->hotel_id = intval($hotel_id);

            $chambre->repas = ($request->repas) ? 1 : 0;
            $chambre->avec_enfant = ($request->enfants) ? 1 : 0 ;
            $chambre->annulation = ($request->annulation) ? 1 : 0 ;

            if($request->images1[0] != null)
            {
                $imagesPath = [];
                $path = 'chambres'.DIRECTORY_SEPARATOR;
                foreach ($request->images1 as $file) 
                {
                    $filename = $file;
                    array_push($imagesPath, $path . $filename);
                }
                $chambre->images = json_encode($imagesPath) ;

            }
            $chambre->image = 'chambres'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->image ;

            $chambre->save();
        }
        

        return back()->with('success', $request->nb_chambres . ' chambre(s) ont bien été Ajouetées.');

    }


    public function rechercher()
    {
        $titre     = request()->input('titre');      

        $chambres = new Chambre;

        $chambres = Chambre::where('titre' , 'like', "%$titre%")->orderBy('id', 'desc');

        $chambres = $chambres->paginate(20);
      
        return view('admin.chambres.index',['chambres'=> $chambres]);   

    }

    public function edit(Request $request)
    {
        $chambre    = Chambre::find($request->chambre_id);

        $hotels = new Hotel;

        $hotels = $hotels->all();


        return view('admin.chambres.edit',[
            'chambre'=> $chambre,
            'hotels' => $hotels
        ]);
    }


    public function update(Request $request)
    {
        $hotel_id_but_array = explode(' ..', $request->hotel_id);       //to take the first number of selection
                                                             // since it is the id of the hotel
        $hotel_id = $hotel_id_but_array[0];

        $chambre = Chambre::find($request->chambre_id);
        
        $chambre->titre = $request->input('titre') ;
        $chambre->slug = $request->input('slug') ;
        $chambre->nb_lit = $request->input('nb_lit') ;
        $chambre->superficie = $request->input('superficie') ;
        $chambre->prix = $request->input('prix') ;
        $chambre->promotion_pourcentage = $request->input('promotion');
        $chambre->promotion_delai = $request->input('delai_promotion') ;
        $chambre->description = $request->input('description');
        $chambre->hotel_id = intval($hotel_id);

        $chambre->repas = ($request->input('repas')) ? 1 : 0;
        $chambre->avec_enfant = ($request->input('enfants')) ? 1 : 0 ;
        $chambre->annulation = ($request->input('annulation')) ? 1 : 0 ;

        if($request->images[0] != null)
            {
                $imagesPath = [];
                $path = 'chambres'.DIRECTORY_SEPARATOR;
                foreach ($request->images as $file) 
                {
                    $filename = $file;
                    array_push($imagesPath, $path . $filename);
                }
                $chambre->images = json_encode($imagesPath) ;

            }
        if($request->image != null)
        {    
            $chambre->image = 'chambres'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->image ;
        }
        $chambre->save();

        return back()->with('successEdit', 'La chambre a bien été modifiée.');
    }
}
