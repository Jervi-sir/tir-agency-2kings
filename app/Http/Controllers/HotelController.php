<?php
/*
HotelController that views the index and voiture and searchVoiture pages

Hotel --one------to---------many--- Chambre 		hotel->chambres 		rls

index()     .search for hotel that has chambre non occupee then displays them
            --->return  [
                            .redirect to index page
                            .list of objects
                        ]      

searchHotel()     .get requested data (location , nb personne, date_debut, date_fin)
                    .will calculate days between these two dates
                    .also it cover the case if no (nb personne, date_debut) were sent by 
                        making nb_personne as 1 and date_debut as tommorow to the current day, and date_fin to after tmrrw
                    .create a permanent session for theses data, (this session will be soon distroyed in OrderContoller)
                    --->return  [
                                    .redirect to searchHotel page
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

showAfterSearch($slug) 			.//aborted//
								.but in general it return the hotel after search requests
*/
namespace App\Http\Controllers;

use App\Voiture;
use App\Chambre;
use App\Hotel as Hotel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class HotelController extends Controller
{
		/*update hotels table*/

/*------------------side functions----------------------------------------------*/
//just to update the table i side of min price of each hotel related with its all chambres
         function refreshHotel()
        {
	        $hotels_refresh = \App\Hotel::all();	
			 										//since eloquent rls dont work in the mass object at once 
	        foreach($hotels_refresh as $hotel) 	
	        {
	             $min_of_chambres = $hotel->chambres->min('prix') ?? 0;			//got to turn max_jour , to prix_min in db table
	             $hotel->prix = $min_of_chambres;

	             $count_chambres_libre = $hotel->chambres->where('occupee','=',0)->count();
	             $hotel->chambres_disponible  = $count_chambres_libre;


	             foreach($hotel->chambres->all() as $chambre)
	             {
	             	$date = $chambre->promotion_delai;

		             if($chambre->promotion_delai < \Carbon\Carbon::now())
		             {
		                $chambre->promotion_pourcentage = 0;
		             }       

		             $chambre->save();
	             }


	             $hotel->save();
	        }
        }

/*-------------Controller index-------------------------------------------------------*/
	public function index() 
	{	
		$this->refreshHotel(); 				//refresh Hotel 

        /*the manipulation*/
		$hotels = new Hotel;
		$hotels = $hotels->has('chambres');

		if(request()->has('min_prix'))						//if there is min_prix
        {
			$hotels = $hotels->whereBetween('prix',[request('min_prix'),request('max_prix')]);
		}	

        if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $hotels = $hotels->where('etoiles','=', request('etoiles'));
                                   
            }
            else
            {
                 $hotels = $hotels;
            }
            
        }


        if(request()->has('sort'))							//if sort is requested 
        {
			$hotels = $hotels->orderBy('prix', request('sort'));
        }

		else                                                //like no request
        {
            $hotels = $hotels->inRandomOrder();
        }

        $hotels = $hotels->paginate(6)->appends(['etoiels' => request('etoiles')]);

        $type_object = 'hotels';

        return view('hotels.index',['type' => $type_object])->with('hotels',$hotels);
		
	}


/*------------------------------------------------------------------------------*/
	public function show(Request $request) 
	{
		$hotel = Hotel::where('slug', $request->slug)->first();						//get the first result only
		
		if(!$hotel)																
        {	
        	abort(404, 'le service n existe pas.');	
        }
		
		$hotel_id = $hotel->id;		
		$chambres = Chambre::where('hotel_id', $hotel_id)
								->where('occupee',0)
								->orderBy('promotion_pourcentage','desc')
								->paginate(4);
		
		return view('hotels.show',['hotel' 		=> $hotel,
									'chambres' 	=> $chambres 
									]);
	}


/*------------------------------------------------------------------------------*/
	public function searchHotel () 
	{
		$this->refreshHotel(); 				//refresh Hotel 
		//request()->validate(['search_hotel_location' => 'required|min:2']); 		//make the field required min 2 letter

		$nb_personne 	= request()->input('nb_personne');	 					//numbers of lit in room
		$location 		= request()->input('search_hotel_location');				//serach the location

		/*get number of days client want to stay, and show appropriate price and hotel that can handle it*/
		$date_fin 		= request()->input('date_fin');
		$date_debut 	= request()->input('date_debut'); 				
		$days_seconds 	= strtotime($date_fin) - strtotime($date_debut);		//calculate by seconds

		if($date_debut == null)
        {
            $days = 1;
        }

        else
        {
            $days_seconds 	= strtotime($date_fin) - strtotime($date_debut);      //calculate by seconds
            $days 			= (int)($days_seconds / (60 * 60 * 24));                      //seconds to number of days
        }

        if($nb_personne == null)												// if client didnt enter nb_person
        {
             $nb_personne = 1;
        }


		$check = request()->input('check');									//idk
		//result of the search
		$results = Hotel::where('lieu' , 'like', "%$location%")
							->where('prix' , '>' , $days);							
       

        if(request()->has('min_prix'))
        {
            $hotels = $hotels->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }

		if(request()->has('sort'))
        {
			$hotels = $hotels->orderBy('prix', request('sort'));
			
        }
        
		if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $hotels = $hotels->where('etoiles','=', request('etoiles'));
                                   
            }
            else
            {
                 $hotels = $hotels;
            }
            
        }

		else                                                //like no request
        {
            $results = $results->inRandomOrder();
        }

        $results = $results->paginate(6);

		session(['hotel_days_search'		=> $days]);
        session(['hotel_date_fin_search'	=> $date_fin]);
		session(['hotel_location_search' 	=> $location]);
        session(['hotel_date_debut_search'	=> $date_debut]);
        session(['hotel_nb_personne_search'	=> $nb_personne]);

		return view('hotels.searchHotel',['hotels' 	=> $results,'days' => $days]); 	// without rls

					//->orWhere('description' , 'like' , "%$location%")
					//->orwhere('etoiles', '=', "$nb_personne")
					//wherseDate('date_debut', '=', date($date_debut))
					//->whereDate('date_fin', '<=', date($date_fin))
					//where('annulation', '=', "$check")
	}



/*------------------------------------------------------------------------------*/
	public function promotion() 
	{	
		$this->refreshHotel(); 				//refresh Hotel 

		$hotels = new Hotel;

		$hotels = $hotels->has('chambres');

		if(request()->has('min_prix'))
        {
            $hotels = $hotels->whereBetween('prix',[request('min_prix'),request('max_prix')]);
        }

		if(request()->has('etoiles'))
        {
            if(request('etoiles'))
            {
                $hotels = $hotels->where('etoiles','=', request('etoiles'));
                                   
            }
            else
            {
                 $hotels = $hotels;
            }
            
        }

		if(request()->has('sort'))
        {
			$hotels = $hotels->orderBy('prix', request('sort'));
			
        }

		else                                                //like no request
        {
            $hotels = $hotels->inRandomOrder();
        }

        $hotels = $hotels->paginate(6)->appends(['etoiels' => request('etoiles')]);

        $type_object = 'hotels';

        return view('hotels.promotionHotel')->with('hotels',$hotels);

	}
        

/*------------------------------------------------------------------------------*/
	public function showAfterSearch(Request $request) 
	{
		$hotel = Hotel::where('slug', $request->slug)->first();		//get the first result only
		
		$hotel_id = $hotel->id;		//without relations
		$chambres = Chambre::where('hotel_id', $hotel_id)
								->where('occupee',0)
								->inRandomOrder()->paginate(4);
		//get the appropriate rooms without rls
        if(!$hotel)
        {
            abort(404, 'le service n existe pas.');
        }
		//return view('hotels.show',['hotel' => $hotel]);
		return view('hotels.showAfterSearch',['hotel' 		=> $hotel,
											 'days' 		=> $request->days ,
											 'chambres' 	=> $chambres ,
											 'nb_personne' 	=> $request->nb_personne]); // without rls
	}



}


/*OLD shits*/

     	//$hotels = DB::select(DB::raw("SELECT * FROM `hotels` INEER JOIN `chambres` ON chambres.hotel_id = `hotels.id` AND `chambres`.`occupee` = 0"))->inRandomOrder()->paginate(6);
     	//$hotels = DB::table('hotels')->select(DB::raw("SELECT * FROM `hotels` INEER JOIN `chambres` ON chambres.hotel_id = hotels.id AND chambres.occupee = 0"))->inRandomOrder()->paginate(6);
     	//$hotels = Hotel::inRandomOrder()->paginate(6);

     	// $hotels = Hotel::leftjoin('chambres', 'hotels.id', '=', 'chambres.hotel_id')
     	// 	->where('')
      //       ->select('users.*', 'contacts.phone', 'orders.price')
      //       ->get();

     	// $hotels = DB::table('hotels')
				  //       ->join('chambres', function ($join) {
				  //           $join->on('hotels.id', '=', 'chambres.hotel_id')
				  //                ->where('chambres.occupee', '=', 0);
				  //       })
				  //       ->get();
		// $hotels = DB::table('hotels')
		// 		->join('chambres', 'hotels.id', '=' , 'chambres.hotel_id')
		// 		->where('chambres.occupee', '=', '0')
		// 		->inRandomOrder()->paginate(6);

		// 		$hotels = DB::table('hotels')
  //           ->join('chambres','hotels.id','=','chambres.hotel_id')
  //           ->where('chambres.occupee', '=' ,0)
  //           ->inRandomOrder()->paginate(6);
		// DB::table('hotels')
  //           ->join('chambres','chambres.hotel_id','=','hotels.id')
  //           ->where('chambres.occupee', '=' ,0)
  //           ->inRandomOrder()->paginate(6); 		 


// 	public function show($slug) 
// 	{
		
// 		$hotel = Hotel::where('slug', $slug)->first();		//get the first result only

// 		$hotel_id = $hotel->id;		//without relations

// 		$chambres = Chambre::where('hotel_id', $hotel_id)
// 					->where('occupee',0)
// 					->inRandomOrder()->paginate(4);
// //get the appropriate rooms without rls

//         if(!$hotel)
//         {
//             abort(404, 'le service n existe pas.');
//         }

// 		//return view('hotels.show',['hotel' => $hotel]);
// 		return view('hotels.show',['hotel' => $hotel, 'chambres' => $chambres]); // without rls
// 	}
