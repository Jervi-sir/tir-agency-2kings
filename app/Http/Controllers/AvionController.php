<?php
/*===================================MAZAL MAkEMELTAH==========================
AvionController that views the index and Avion and searchAvion pages

index()     .search for Avion non occupee then displays them
            --->return  [
                            .redirect to index page
                            .list of objects
                        ]      


searchAvion()         .get requested data (depart , arrivee, date_debut, date_fin)
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

use App\Avion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvionController extends Controller
{

/*----------------------------------------------------------------*/
    function refreshAvion()
    {
        $avions_refresh = Avion::all();    
                                                //since eloquent rls dont work in the mass object at once 
        foreach($avions_refresh as $avion)  
        {
             $date = $avion->promotion_delai;

             if($avion->promotion_delai < \Carbon\Carbon::now())
             {
                $avion->promotion_pourcentage = 0;
             } 

             $avion->nombre_places_libres =  $avion->places->where('occupee',0)->count();  

             $avion->save();
        }
    }
/*----------------------------------------------------------------*/
    public function index() 
    {   
        $this->refreshAvion();              //refresh Avion
        
        $avions = new Avion;

        $avions = $avions->has('places');

        if(request()->has('min_prix'))
        {
            $avions = $avions->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }


        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $avions = $avions->where('etoiles', '=',request('etoiles'));
                                   
            }
            else
            {
                 $avions = $avions;
            }
            
        }


        if(request()->has('sort'))
        {
            $avions =  $avions->orderBy('prix', request('sort'))
                            ->orderBy('promotion_pourcentage', request('sort'));
        }

        else                                                //like no request
        {
            $avions = $avions->inRandomOrder();
        }


        $avions = $avions->paginate(6)->appends(['etoiels' => request('etoiles'),'sort' => request('sort')]);

        $type_object = 'avions';

        return view('vols.index',['type' => $type_object])->with('vols',$avions);
    }

  
/*----------------------------------------------------------------*/
    public function show($slug) 
    {
       $product = Avion::where('slug', $slug)->first();

        if(!$product)
        {
            abort(404, 'le service n existe pas.');
        }
      
       return view('vols.show')->with('vol', $product);
    }
/*----------------------------------------------------------------*/
public function showEscale($slug,$id) 
    {
       $product1 = Avion::where('slug', $slug)->first();
       $product2 = Avion::where('id', $id)->first();

        if(!$product1)
        {
            abort(404, 'le service n existe pas.');
        }
        if(!$product2)
        {
            abort(404, 'le service n existe pas.');
        }
      
       return view('vols.showEscale',['vol' => $product1,'vol2' => $product2]);
    }
/*----------------------------------------------------------------*/
public function searchVol()
    {

        $this->refreshAvion();              //refresh Vol
        
        $avions = new Avion;

        $avions = $avions->where('nombre_places_libres','>',0);
        //request()->validate(['search_vol_depart' => 'required|min:3']);

        $depart             = request()->input('search_vol_depart');
        $arrivee            = request()->input('search_vol_arrivee');
        $date_depart        = request()->input('date_depart');
        $date_retour        = request()->input('date_retour');    
        $days_seconds       = strtotime($date_depart) - strtotime($date_retour);        //no idea why but khaliteh in case
        $days               = (int)($days_seconds / (60 * 60 * 24));                    //same for it 

        /***********For the direct Flight mr man it english **************************/
        $avions             = $avions->where('lieu_depart' , 'like', "%$depart%")
                                    ->Where('lieu_arrivee' , 'like' , "%$arrivee%");

        //if kayen a direct flight

        if($avions->count())                 
        {

            // $avions        = $avions->whereDate('date_depart','>',$date_depart) 
            //                 ->whereDate('date_retour','<',$date_retour);
          
        if(request()->has('min_prix'))
        {
            $avions = $avions->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }   
        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $avions = $avions->where('etoiles', '=',request('etoiles'));
            }
            else
            {
                 $avions = $avions;
            }
        }
        if(request()->has('sort'))
        {
            $avions =  $avions->orderBy('promotion_pourcentage', request('sort'))
                                    ->orderBy('prix', request('sort'));
        }
        else                                                //like no request
        {
            $avions = $avions->inRandomOrder();
        }
        
        $avions = $avions->paginate(6);

        session(['vols_dapart_search'               => $depart]);
        session(['vols_arrivee_retour_search'       => $arrivee]);
        session(['vols_date_depart_search'          => $date_depart]);
        session(['vols_date_retour_search'          => $date_retour]);
        session(['vols_days_search'                 => $days]);

        $type_de_vol = 'Vols directs';

        if($avions->count() == 0)  
        {
            $type_de_vol = '';
        }


        return view('vols.searchVol',['vols'  => $avions,'type_de_vol' =>$type_de_vol ]);

        }
        else
        {   

            $avions = Avion::join('avions as b','avions.lieu_arrivee','b.lieu_depart')
                ->where('avions.lieu_depart','like',"%$depart%")
                ->where('b.lieu_arrivee','like',"%$arrivee%")
                ->get();   

            $type_de_vol = 'Vols en Escale';
            
            return view('vols.escale',['vols'  => $avions,'type_de_vol' =>$type_de_vol ]);
                    
        }

            $type_de_vol = '';

        return view('vols.searchVol',['vols'  => $avions,'type_de_vol' =>$type_de_vol ]);

    }

/*----------------------------------------------------------------*/
      public function promotion() 
    {
        $this->refreshAvion();              //refresh Vol
        
        $avions = new Avion;

        $avions = $avions->has('places');

        $avions = $avions->where('promotion_pourcentage', '>',0);

        if(request()->has('min_prix'))
        {
            $avions = $avions->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }

        if(request()->has('sort'))
        {
            $avions =  $avions->orderBy('promotion_pourcentage', request('sort'))
                            ->orderBy('prix', request('sort'));
        }

        if(request()->has('min_prix'))
        {
            $avions = $avions->whereBetween('prix',[request('min_prix'),request('max_prix')]);      
        }

        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $avions = $avions->where('etoiles', '=',request('etoiles'));
                                   
            }
            else
            {
                 $avions = $avions;
            }
            
        }

        else                                                //like no request
        {
            $avions = $avions->inRandomOrder();
        }
  
        


        $avions = $avions->paginate(6)->appends(['etoiels' => request('etoiles'),
                                             'min_prix' => request('min_prix'),
                                             'max_prix' => request('max_prix')]);

        $type_object = 'avions';

        if($avions->count())
        {
            $exist = 1;
            return view('vols.promotionVol',['exist' => $exist])->with('vols',$avions);
        }
        
        else
        {
            $exist = 0;
            return view('vols.promotionVol',['exist' => $exist])->with('vols',$avions);
        }



    }




}




// QUERIES
    // SQL query 
            
            // select * from `avions` inner join `avions` as `b` on `avions`.`lieu_arrivee` = `b`.`lieu_depart` where `avions`.`lieu_depart` like ? and `b`.`lieu_arrivee` like ?"
            //         array:2 [
            //           0 => "%Alger%"
            //           1 => "%Japon%"
            //         ]

              
            // $avions2 = $avions->crossJoin(Avion::where('lieu_depart','like','%$depart%'));
            // $result = DB::select('select * from avions join avions as b on avions.lieu_arrivee = b.lieu_depart where avions.lieu_depart like "%$depart%" and b.lieu_arrivee like "%$arrivee%');     
            
            // $avions = DB::table('avions')
            //             ->join('avions as b', 'avions.lieu_arrivee', '=', 'b.lieu_depart')
            //             ->where('avions.lieu_depart','like',"%$depart%")
            //             ->where('b.lieu_arrivee','like',"%$arrivee%")
            //             ->get();

            // $result1 = DB::select('select a.*, b.* from avions as a, avions as b where a.lieu_arrivee = b.lieu_depart');
            // $result = Avion::with('avions as b') 
            //             ->where('avions.lieu_arrivee','=','b.lieu_depart')
            //             ->get();
            

