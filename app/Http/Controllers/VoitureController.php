<?php
/*
VoitureController that views the index and voiture and searchVoiture pages

index()     .search for voiture non occupee then displays them
            --->return  [
                            .redirect to index page
                            .list of objects
                        ]      

searchVoiture()     .get requested data (location , nb personne, date_debut, date_fin)
                    .will calculate days between these two dates
                    .also it cover the case if no (nb personne, date_debut) were sent by 
                        making nb_personne as 1 and date_debut as tommorow to the current day, and date_fin to after tmrrw
                    .create a permanent session for theses data, (this session will be soon distroyed in OrderContoller)
                    --->return  [
                                    .redirect to searchVoiture page
                                    .list of objects
                                    .session permanent
                                ]  

show($slug)         .will take the slug , search it in db get the first object
                    .if nothing found a 404 page will be displayed
                    --->return  [
                                    .redirect to show page
                                    .object
                                    .404 if somethiing went wrong
                                ]  

*/
namespace App\Http\Controllers;

use App\Voiture as Voiture2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VoitureController extends Controller
{
    function refreshVoiture()
    {
        $voitures_refresh = \App\Voiture::all();    
                                                //since eloquent rls dont work in the mass object at once 
        foreach($voitures_refresh as $voiture)  
        {
             $date = $voiture->promotion_delai;

             if($voiture->promotion_delai < \Carbon\Carbon::now())
             {
                $voiture->promotion_pourcentage = 0;
             }       

             $voiture->save();
        }
    }

/*----------------------------------------------------------------*/
    public function index() 
    {
        
        $this->refreshVoiture();              //refresh Voiture

        $voitures = new Voiture2;

        if(request()->has('min_prix'))
        {
            $voitures = $voitures->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }

        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $voitures = $voitures->where('etoiles', '=',request('etoiles'))
                                    ->where('occupee' , 0);
            }
            else
            {
                 $voitures = $voitures->where('occupee' , 0);
            }
            
        }

        if(request()->has('sort'))
        {
            $voitures =  $voitures->where('occupee' , 0)
                                    ->orderBy('prix', request('sort'))
                                    ->orderBy('promotion_pourcentage', request('sort'));
        }

        else                                                //like no request
        {
            $voitures = $voitures->where('occupee' , 0)->inRandomOrder();
        }

        $voitures = $voitures->paginate(6)->appends(['etoiles'   => request('etoiles'),
                                                     'sort'      => request('sort') ,
                                                     'min_prix'  =>request('min_prix'),
                                                     'max_prix'  =>request('max_prix')]);

        return view('voitures.index')->with('voitures',$voitures);

    }

        // $voitures = Voiture2::where('occupee' , 0)->inRandomOrder()->paginate(6);
        // return view('voitures.index')->with('voitures',$voitures);
        //         $voitures = new Voiture2;

        // $queries = [];

        // $columns = [
        //         'etoiles' , 'portes' , 'nombre_places',
        // ];

        // foreach ($columns as $column) 
        // {
        //     if(request()->has($column))
        //     {
        //         $voitures = $voitures->where($column, request($column));
        //         $queries[$column] = request($column);
        //     }
        // }

/*----------------------------------------------------------------*/
    public function show($slug) 
    {   
        $product = Voiture2::where('slug', $slug)->first();
        if(!$product)
        {
            abort(404, 'le service n existe pas.');
        }

        return view('voitures.show')->with('voiture', $product);
    }


/*----------------------------------------------------------------*/
    public function searchVoiture()
    {
        $this->refreshVoiture();              //refresh Voiture

        $voitures = new Voiture2;

        /*get number of days client wanted, and show appropriate price */
        $marque     = request()->input('search_voiture');                               //search la marque (titre)
        $location   = request()->input('search_voiture_location');                    //serach the location

        $date_fin   = request()->input('date_fin');
        $date_debut = request()->input('date_debut');               

        if($date_debut == null)                                                     //if date wasnt selected
        {
            $days = 1;
        }

        else                                                                        //mean date is selected , so need to calculated days
        {   
            $days_seconds   = strtotime($date_fin) - strtotime($date_debut);          //calculate by seconds
            $days           = (int)($days_seconds / (60 * 60 * 24));                          //seconds to number of days
        }

        $check = request()->input('check');                                         //idk

        if($marque == null)                 //if marque left in black
        {
            $voitures = Voiture2::where('lieu' , 'like', "%$location%");
        }

        else                                //means we got location also une marque to search for
        {
            $voitures = Voiture2::where('lieu' , 'like', "%$location%")
                                    ->where('titre', 'like', "%$marque%");
        }



        if(request()->has('min_prix'))
        {
            $voitures = $voitures->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }



        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $voitures = $voitures->where('etoiles', '=',request('etoiles'))
                                    ->where('occupee' , 0);
            }
            else
            {
                 $voitures = $voitures->where('occupee' , 0);
            }
            
        }

        if(request()->has('sort'))
        {
            $voitures =  $voitures->orderBy('promotion_pourcentage', request('sort'))
                                    ->orderBy('prix', request('sort'));
        }

        else                                                //like no request
        {
            $voitures = $voitures->where('occupee' , 0)
                                    ->inRandomOrder();
        }

        session(['voiture_location_search'      => $location]);
        session(['voiture_marque_search'        => $marque]);
        session(['voiture_date_fin_search'      => $date_fin]);
        session(['voiture_date_debut_search'    => $date_debut]);
        session(['voiture_days_search'          => $days]);
        
        $voitures = $voitures->paginate(6);

        /*turn all shit into a session permanent till we destroy it*/
        

        return view('voitures.searchVoiture',['voitures' => $voitures]);

    }

/*----------------------------------------------------------------*/
  public function promotion() 
    {
        $this->refreshVoiture();              //refresh Voiture


        $voitures = Voiture2::where('promotion_pourcentage', '>' ,0);


        if(request()->has('min_prix'))
        {
            $voitures = $voitures->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }

        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $voitures = $voitures->where('etoiles', '=',request('etoiles'))
                                    ->where('occupee' , 0);
            }
            else
            {
                 $voitures = $voitures->where('occupee' , 0);
            }
            
        }

        if(request()->has('sort'))
        {
            $voitures =  $voitures->where('occupee' , 0)
                                    ->orderBy('prix', request('sort'))
                                    ->orderBy('promotion_pourcentage', request('sort'));
        }

        else                                                //like no request
        {
            $voitures = $voitures->where('occupee' , 0)->inRandomOrder();
        }

        
        
        if($voitures->count())
        {
            $exist = 1;
            $voitures = $voitures->paginate(6)->appends(['etoiles'   => request('etoiles'),
                                                     'sort'      => request('sort') ,
                                                     'min_prix'  =>request('min_prix'),
                                                     'max_prix'  =>request('max_prix')]);
            return view('voitures.promotionVoiture',['exist' => $exist])->with('voitures',$voitures);
        }
        
        else
        {
            $exist = 0;
            $voitures = $voitures->paginate(6)->appends(['etoiles'   => request('etoiles'),
                                                     'sort'      => request('sort') ,
                                                     'min_prix'  =>request('min_prix'),
                                                     'max_prix'  =>request('max_prix')]);
            return view('voitures.promotionVoiture',['exist' => $exist])->with('voitures',$voitures);
        }


    }

}
