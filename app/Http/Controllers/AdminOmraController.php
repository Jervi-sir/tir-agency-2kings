<?php

namespace App\Http\Controllers;
use App\Omra;

use Illuminate\Http\Request;

class AdminOmraController extends Controller
{
    public function index()
    {
        $omras = new Omra;

        $omras = $omras->orderBy('id', 'desc');
        
        $omras = $omras->paginate(6);

        return view('admin.omras.index')->with('omras', $omras);
    }

     /*Delete selected omra*/
    public function supprimer(Request $request)
    {
        Omra::destroy($request->omra_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            Omra::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }
    
    /*Afficher selected omra*/
    public function afficher(Request $request)
    {
        $omra    = Omra::find($request->omra_id);

        return view('admin.omras.show',['omra'=> $omra]);
    }

    /*redirecter l page bah tzid un omra*/
   public function redirect_pour_ajouter()
    {
        return view('admin.omras.ajouter');
    }

    /*OPERATION d ajout f base d donne */
    public function ajouter(Request $request)
    {
        $omra = new Omra;
        $omra->titre = $request->titre ;
        $omra->slug = $request->slug ;
        $omra->vol_titre = $request->titre ;
        $omra->hotel_titre = $request->titre ;
        $omra->lieu = $request->lieu ;
        $omra->type_service = "omras";
        $omra->type_payment = "espece";
        $omra->email = $request->email ;
        $omra->description = $request->description ;
        $omra->prix = $request->prix ;
        $omra->max_jour = $request->max_jour ;


        if($request->images1[0] != null)
        {
            $imagesPath = [];
            $path = 'omras'.DIRECTORY_SEPARATOR;
            foreach ($request->images1 as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $omra->images = json_encode($imagesPath) ;

        }
       
        $omra->image = 'omras'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->image ;

        $omra->save();

        return back()->with('success', 'La omra a bien été ajoutée.');
    }

    public function rechercher()
    {
        $titre = request()->input('titre');      

        $omra = new Omra;

        $omra = Omra::where('titre' , 'like', "%$titre%")->orderBy('id', 'desc');

        $omra = $omra->paginate(6);
      
        return view('admin.omras.index',['omra'=> $omra]);
    }

     public function edit(Request $request)
    {
        $omra    = omra::find($request->omra_id);

        return view('admin.omras.edit',['omra'=> $omra]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required'
        ]);

        $omra    = omra::find($request->omra_id);

        $omra->titre = $request->input('titre');
        $omra->vol_titre = $request->input('vol_titre');
        $omra->hotel_titre = $request->input('hotel_titre'); 
        $omra->lieu = $request->input('lieu');
        $omra->max_jour = $request->input('max_jour');
        $omra->email = $request->input('email');
        
        $omra->description = $request->input('description');

        $omra->prix = $request->input('prix');

        if($request->images[0] != null)
        {
            $imagesPath = [];
            $path = 'omras'.DIRECTORY_SEPARATOR;
            foreach ($request->input('images') as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $omra->images = json_encode($imagesPath);
        }
        
        if($request->image != null)
        {
            $omra->image = 'omras'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->input('image');
        }

        $omra->save();

        return back()->with('successEdit', 'La omra a été modifiée avec succés.');
    }
}
