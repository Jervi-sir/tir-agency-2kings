<?php
/*===================================MAZAL MAkEMELTAH==========================
VolController that views the index and vol and searchvol pages

index()     .search for vol non occupee then displays them
            --->return  [
                            .redirect to index page
                            .list of objects
                        ]      


searchVol()         .get requested data (depart , arrivee, date_debut, date_fin)
                    .will calculate days between these two dates

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

use App\Vol;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VolController extends Controller
{

    function refreshVol()
    {
        $vols_refresh = Vol::all();    
                                                //since eloquent rls dont work in the mass object at once 
        foreach($vols_refresh as $vol)  
        {
             $date = $vol->promotion_delai;

             if($vol->promotion_delai < \Carbon\Carbon::now())
             {
                $vol->promotion_pourcentage = 0;
             }       

             $vol->save();
        }
    }

/*----------------------------------------------------------------*/
    public function index() 
    {   
        $this->refreshVol();              //refresh Vol
        
        $vols = new Vol;

        $vols = $vols->has('places');

        if(request()->has('min_prix'))
        {
            $vols = $vols->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }


        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $vols = $vols->where('etoiles', '=',request('etoiles'));
                                   
            }
            else
            {
                 $vols = $vols;
            }
            
        }


        if(request()->has('sort'))
        {
            $vols =  $vols->orderBy('prix', request('sort'))
                            ->orderBy('promotion_pourcentage', request('sort'));
        }

        else                                                //like no request
        {
            $vols = $vols->inRandomOrder();
        }


        $vols = $vols->paginate(6)->appends(['etoiels' => request('etoiles'),'sort' => request('sort')]);

        $type_object = 'vols';

        return view('vols.index',['type' => $type_object])->with('vols',$vols);
    }

  
/*----------------------------------------------------------------*/
	public function show($slug) 
    {
	   $product = Vol::where('slug', $slug)->first();

        if(!$product)
        {
            abort(404, 'le service n existe pas.');
        }
	  
       return view('vols.show')->with('vol', $product);
	}


/*----------------------------------------------------------------*/
    public function searchVol()
    {

        $this->refreshVol();              //refresh Vol
        
        $vols = new Vol;

        $vols = $vols->has('places');

    	//request()->validate(['search_vol_depart' => 'required|min:3']);

		$dapart             = request()->input('search_vol_depart');
        $arrivee            = request()->input('search_vol_arrivee');
        $date_depart        = request()->input('date_depart');
        $date_retour        = request()->input('date_retour');    
		
        $days_seconds       = strtotime($date_depart) - strtotime($date_retour);        //no idea why but khaliteh in case
        $days               = (int)($days_seconds / (60 * 60 * 24));                    //same for it 

        // $date_depart    = new \Carbon\Carbon($date_de);
        // $date_retour    = new \Carbon\Carbon($date_re);
        $vols        = $vols->where('ligne_depart' , 'like', "%$dapart%")
                               ->Where('ligne_arrivee' , 'like' , "%$arrivee%");

        $vols        = $vols->whereDate('date_depart','<',$date_depart) 
                            ->whereDate('date_arrivee','>',$date_retour);


        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $vols = $vols->where('etoiles', '=',request('etoiles'));
                                   
            }
            else
            {
                 $vols = $vols;
            }
            
        }


        else                                                //like no request
        {
            $vols = $vols->inRandomOrder();
        }
        
        if(request()->has('min_prix'))
        {
            $vols = $vols->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }

        $vols = $vols->paginate(6);

        session(['vols_dapart_search'               => $dapart]);
        session(['vols_arrivee_retour_search'       => $arrivee]);
        session(['vols_date_depart_search'          => $date_depart]);
        session(['vols_date_retour_search'          => $date_retour]);
        session(['vols_days_search'                 => $days]);




    	return view('vols.searchVol',['vols'  => $vols]);

    }

/*----------------------------------------------------------------*/
      public function promotion() 
    {
        $this->refreshVol();              //refresh Vol
        
        $vols = new Vol;

        $vols = $vols->has('places');

        $vols = $vols->where('promotion_pourcentage', '>',0);

        if(request()->has('min_prix'))
        {
            $vols = $vols->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }


        if(request()->has('sort'))
        {
            $vols =  $vols->orderBy('promotion_pourcentage', request('sort'))
                            ->orderBy('prix', request('sort'));
                            
        }

        if(request()->has('min_prix'))
        {
            $vols = $vols->whereBetween('prix',[request('min_prix'),request('max_prix')]);      
        }

        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $vols = $vols->where('etoiles', '=',request('etoiles'));
                                   
            }
            else
            {
                 $vols = $vols;
            }
            
        }

        else                                                //like no request
        {
            $vols = $vols->inRandomOrder();
        }
  
        


        

        $type_object = 'vols';

        if($voitures->count())
        {
            $exist = 1;
            $vols = $vols->paginate(6)->appends(['etoiels' => request('etoiles'),
                                             'min_prix' => request('min_prix'),
                                             'max_prix' => request('max_prix')]);
            return view('vols.promotionVol',['exist' => $exist])->with('vols',$vols);
        }
        
        else
        {
            $exist = 0;
            $vols = $vols->paginate(6)->appends(['etoiels' => request('etoiles'),
                                             'min_prix' => request('min_prix'),
                                             'max_prix' => request('max_prix')]);
            return view('vols.promotionVol',['exist' => $exist])->with('vols',$vols);
        }



    }



}


