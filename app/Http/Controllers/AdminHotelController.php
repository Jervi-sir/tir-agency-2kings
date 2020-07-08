<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use Carbon\Carbon;

class AdminHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $hotels = new Hotel;
        
        $hotels = $hotels->orderBy('id', 'desc');

        $hotels = $hotels->paginate(20);

        return view('admin.hotels.index')->with('hotels', $hotels);  
    }

    public function supprimer(Request $request)
    {
        Hotel::destroy($request->hotel_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            Hotel::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }


    public function afficher(Request $request)
    {
        $hotel    = Hotel::find($request->hotel_id);

        return view('admin.hotels.show',['hotel'=> $hotel]);
    }
    
    public function redirect_pour_ajouter()
    {
        return view('admin.hotels.ajouter');
    }


    public function ajouter(Request $request)
    {
        $hotel = new Hotel;
        $hotel->titre = $request->titre ;
        $hotel->slug = str_replace(" ", "_", $request->titre) ."_". Carbon::now()->timestamp;
        $hotel->lieu = $request->lieu ;
        $hotel->type_service =  "hotels";
        $hotel->etoiles = $request->etoiles ;
        $hotel->telephone = $request->telephone ;
        $hotel->description = $request->description ;
        $hotel->langues = $request->language ;
        
        /*logiques */
        $hotel->avec_wifi = ($request->wifi) ? 1 : 0;
        $hotel->avec_gym = ($request->gym) ? 1 : 0 ;
        $hotel->avec_animaux = ($request->animaux) ? 1 : 0 ;
        $hotel->avec_parking = ($request->parking) ? 1 : 0 ;
        $hotel->avec_piscine = ($request->piscine) ? 1 : 0 ;
        $hotel->annulation = ($request->annulation) ? 1 : 0 ;

        if($request->images1[0] != null)
        {
            $imagesPath = [];
            $path = 'hotels'.DIRECTORY_SEPARATOR;
            foreach ($request->images1 as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $hotel->images = json_encode($imagesPath) ;

        }

       
        $hotel->image = 'hotels'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->image ;

        $hotel->save();

        return back()->with('success', 'L\'Hotel a bien été Ajoueté.');
    }

    public function rechercher()
    {
        $titre     = request()->input('titre');      

        $hotels = new Hotel;

        $hotels = Hotel::where('titre' , 'like', "%$titre%")->orderBy('id', 'desc');

        $hotels = $hotels->paginate(20);
      
        return view('admin.hotels.index',['hotels'=> $hotels]);   

    }


    public function edit(Request $request)
    {
        $hotel    = Hotel::find($request->hotel_id);

        return view('admin.hotels.edit',['hotel'=> $hotel]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $hotel    = Hotel::find($request->hotel_id);

        $hotel->titre = $request->input('titre');
        $hotel->slug = $request->input('slug');
        $hotel->lieu = $request->input('lieu');

        $hotel->etoiles = $request->input('etoiles');
        $hotel->telephone = $request->input('telephone');
        $hotel->description = $request->input('description');
        $hotel->langues = $request->input('language') ;
        
        /*logiques */
        $hotel->avec_wifi = ($request->input('wifi')) ? 1 : 0;
        $hotel->avec_gym = ($request->input('gym')) ? 1 : 0;
        $hotel->avec_animaux = ($request->input('animaux')) ? 1 : 0;
        $hotel->avec_parking = ($request->input('parking')) ? 1 : 0;
        $hotel->avec_piscine = ($request->input('piscine')) ? 1 : 0;
        $hotel->annulation = ($request->input('annulation')) ? 1 : 0;


        if($request->images[0] != null)
        {
            $imagesPath = [];
            $path = 'hotels'.DIRECTORY_SEPARATOR;
            foreach ($request->images as $file) 
            {
                $filename = $file;
                array_push($imagesPath, $path . $filename);
            }
            $hotel->images = json_encode($imagesPath);

        }

        if($request->image != null)
        {
            $hotel->image = 'hotels'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->input('image');
        }
        $hotel->save();

        return back()->with('successEdit', 'L\'hotel a été modifiée avec succés.');
    }
    


}
