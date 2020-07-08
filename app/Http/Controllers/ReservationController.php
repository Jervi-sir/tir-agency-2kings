<?php
/*
Reservation Controller :: to manage the Payment and Reservation the services 
index() .will display the Payment page while getting a request() action from previous page
        .the previous page should have a form filled and the id of the service also it type
        .form : nom, prenom, email, etat_personne(M.,Mme,Mlle,Dr), ALSO the id service and its type
        .then it ll store them in a session()->flash() for only the next page
        .will provide a security code called Client_secret -thats what Stripe want-
        .it manages to structure the date and number of days in also a session()->flash()
        .it finds the appropriate service that the client wanted in a type of Object with the help of id gotten 
        ---->retrun [   
                        .session()->flash() of : nom, prenom, email, telephone, date_debut, date_fin, nombre_jour, type
                        .product
                        .paymentIntent
                        .clientSecret
                    ]
store($request)     .will get a request through csrf from the payment page if the payment was succeded
                    .basically will store the service chosen by client in the Reservation table
                    .before storing , it will verify the type of service chosen ,
                        each service has it own way to be stored
                    .will distroy the sessions created if the saving operation succeded
                    ---->return [
                                    .redirect to the search page appropriate 
                                    .with a Success massage
                                ]

show()      .will show what the client has reseved 
            .it will take its Auth()->user()->id then list all Objects where the id is found
            ----->return [
                            .orders : as a list of Objects
                            .redirect to order.index
                        ]

annuler[voiture,chambre,place]($request)       .get a request chained with an id of order wanted to be deleted
                                                .find the order table via that // id and destroy() it
                                                .make the servive non occupee
                                                ---->return     [
                                                                    .back() with a success message
                                                                ]


*/
namespace App\Http\Controllers;
use App\Avion;
use App\Reservation;
use App\Place;
use App\Chambre;
use App\Voiture;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Faker\Factory;

class ReservationController extends Controller
{
/*----------------------------------------------------------------*/
    /*display payment to complish the reservations*/
    ///get the type of service client requested , 
    //index() will redirect to stripe payment with a data injection: clientSecret code, product, paymentIntent, type(of service)
    public function index()
     {  
       
        if(!request()->input('nom'))                                    //if nothing was requested
        {   
            return abort(404, 'le service n existe pas.');  
        }

        /*if its plane */
        if(request()->has('seats_request') && request()->input('seats_request') == null)//if order was from vol,also no seats selected
        {
            request()->validate(['seats_request' => 'required|min:3']);
        }

        if(request()->input('seats_request'))
        {
            $seats = explode(',', request()->input('seats_request'));       //if request is from vol show page
                                                                             //also the nb_jour means nb_personnes but idk
            if(request()->input('seats_request_vol2'))
            {
                $seats2 = explode(',', request()->input('seats_request_vol2'));       //if request is from vol show page
            }

        }
        /*end if its plane*/

        $array = array("Boiiii","M.","Mme","Mlle","Dr");                //to help to get the etat_personne since it return a number

        $nom            =  request()->input('nom');
        $prenom         =  request()->input('prenom');
        $email          =  request()->input('email');
        $telephone      =  request()->input('telephone');
        $etat_personne   = $array[ request()->input('etat_personne')];

        //to get type of service requested from
        $type =  request()->input('product_type');

        if($type == 'voitures')
        {  
            $product = Voiture::find( request()->input('product_id'));  

            if(session()->get('voiture_date_debut_search'))             //if request came from search form
            {
                $date_debut = session()->get('voiture_date_debut_search');
            }

            else                                                       //or request came from page index no search
            {   
                $date_debut = Carbon::tomorrow('Europe/London')->format('Y-m-d');
            }

            $start          = new \Carbon\Carbon($date_debut);
            $nombre_jour    =  request()->input('jour_reserves');
            $date_fin       = $start->addDays($nombre_jour)->format('Y-m-d');


            $montant = ($product->prix -($product->prix * $product->promotion_pourcentage / 100))* $nombre_jour;
        
        }

        else if($type == 'chambres')
        { 
            $product = Chambre::find( request()->input('product_id'));  
            $montant = $product->prix ;

            if(session()->get('hotel_date_debut_search'))             //if request came from search form
            {
                $date_debut = session()->get('hotel_date_debut_search');
            }

            else                                                       //or request came from page index no search
            {   
                $date_debut = Carbon::tomorrow('Europe/London')->format('Y-m-d');
            }

            $start          = new \Carbon\Carbon($date_debut);
            $nombre_jour    =  request()->input('jour_reserves');
            $date_fin       = $start->addDays($nombre_jour)->format('Y-m-d');

            $montant = ($product->prix -($product->prix * $product->promotion_pourcentage / 100))* $nombre_jour;

        }

        else if($type == 'places')
        {  
            $product = Avion::find( request()->input('product_id')); 
            $montant = ($product->prix -($product->prix * $product->promotion_pourcentage / 100)) * count($seats);
            $date_debut = $product->date_depart;
            $date_fin = $product->date_retour;
            $nombre_jour    =  request()->input('jour_reserves');

            $start = Carbon::parse($product->date_depart);
            $end = Carbon::parse($product->date_retour);
            $nombre_jour = $end->diffInDays($start);

            if(request()->input('product2_id') != NULL)
            {
                $product2 = Avion::find( request()->input('product2_id')); 
                $montant = $montant + ($product2->prix -($product2->prix * $product2->promotion_pourcentage / 100)) * count($seats2);
            }

        }

        else 
        {
            return back()->with('error', 'le reservation nest pas disponible.');
        }




        //[mazal]//optional mazal mareft , idea is to prevent to access payment directly from entring the link
        //if(!$request) { return redirect()->route('voitures.index'); } 

        //stripe my key
        Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');


        //get all stripe"s object
        $intent = PaymentIntent::create([
                          'amount'      => $montant,             //maybe multiply by rate 
                          'currency'    => 'eur',
                          'metadata'    => ['integration_check' => 'accept_a_payment'],
                        ]);

        $clientSecret = Arr::get($intent, 'client_secret');         //code sercret de Strip pour le client

        session()->flash('nom',$nom);
        session()->flash('prenom',$prenom);
        session()->flash('email',$email);
        session()->flash('telephone',$telephone);
        session()->flash('date_fin',$date_fin);
        session()->flash('date_debut',$date_debut);
        session()->flash('nombre_jour',$nombre_jour);
        session()->flash('etat_personne',$etat_personne);
        session()->flash('type',$type);

        if(request()->input('seats_request'))           //also if request is from vol
        {
            session()->flash('seats',$seats);
        }

        $product2 = null;                           //just to make payments work for all the orders

        if(request()->input('product2_id'))           //also if request is from vol
        {
            session()->flash('seats2',$seats2);
        }

        return view('paiement.index', ['product'        => $product , 
                                        'product2' => $product2 ,
                                        'paymentIntent' => $intent ,
                                        'clientSecret'  => $clientSecret ,   
                                        ]);   

    }

    
/*=================================================================================================*/

    /*store client's Reservation with success*/
    //store the order if payment succeded , the service has a type , so each type have it won deal
    public function store(Request $request) 
     {   
        $type = session()->get('type');

        //reservation voiture
        if($type == 'voitures')             
        {
            $product = Voiture::find($request->product_id);
            
            $order          = new Reservation;
            $order->user_id = Auth()->user() ? Auth()->user()->id  : null;
            
            $order->chambre_id  = NULL;
            $order->voiture_id  = $product->id;
            $order->place_id   = NULL;

            $order->code_reservation    = Carbon::now()->timestamp;
            $order->payment_intent_id   = $request->paymentIntent_id;
            $order->paiment_cree_a  = Carbon::now();

            $order->montant          = ($product->prix - ($product->prix * $product->promotion_pourcentage / 100)) * session()->get('nombre_jour');    
 
            $order->prix_original      = $product->prix;

            $order->etat_personne    = session()->get('etat_personne');
            $order->nom             = session()->get('nom');
            $order->prenom          = session()->get('prenom');
            $order->email           = session()->get('email');
            $order->telephone       = session()->get('telephone');
            $order->nb_personne     = NULL;
            $order->quantite        = session()->get('nombre_jour');                  //incase but idk , its nb jour btw
            $order->type_de_paiment = 'online';
            

            $order->date_debut  = session()->get('date_debut');    
            $order->date_fin    = session()->get('date_fin');

            // if(session()->get('voiture_date_debut_search'))                     //if request came from search form
            // {       
            //      $order->date_debut = session()->get('voiture_date_debut_search');
            //      $order->date_fin   = session()->get('date_fin');                 //cuz of the spinner time range
            // }

            // else 
            // {
            //     $order->date_debut  = session()->get('date_debut');      //the supposed to solve ma shit
            //     $order->date_fin    = session()->get('date_fin');
            // }

           

            $order->save();

            $product->occupee = 1;
            $product->save();

            if(session()->get('voiture_location_search'))                     //if request came from search form
            { 
                session()->forget('voiture_marque_search');
                session()->forget('voiture_date_fin_search');
                session()->forget('voiture_location_search');
                session()->forget('voiture_date_debut_search');
                session()->forget('voiture_days_search');
            }
            return redirect()->route('voitures.index')
                             ->with('success', 'La Voiture a bien été reservee.');

        }


        //reservation chambre
        if($type == 'chambres')
        {  
           
            $product = Chambre::find($request->product_id);
            
            $order          = new Reservation;
            $order->user_id = Auth()->user() ? Auth()->user()->id  : null;
    
            $order->chambre_id  = $product->id;
            $order->voiture_id  = NULL;
            $order->place_id   = NULL;

            $order->code_reservation    = Carbon::now()->timestamp;
            $order->payment_intent_id   = $request->paymentIntent_id;
            $order->paiment_cree_a  = Carbon::now();

            $order->montant          = ($product->prix - ($product->prix * $product->promotion_pourcentage / 100)) * session()->get('nombre_jour');    //
            $order->prix_original      = $product->prix;

            $order->etat_personne    = session()->get('etat_personne');
            $order->nom             = session()->get('nom');
            $order->prenom          = session()->get('prenom');
            $order->email           = session()->get('email');
            $order->telephone       = session()->get('telephone');
            $order->nb_personne     = NULL;
            $order->quantite        = session()->get('nombre_jour');                  //incase but idk , its nb jour btw
            $order->type_de_paiment = 'online';

            $order->date_debut = session()->get('date_debut');      //the supposed to solve ma shit
            $order->date_fin    = session()->get('date_fin');

            $order->save();

            $product->occupee = 1;
            $product->save();

            if(session()->get('hotel_location_search'))                     //if request came from search form
            { 
                session()->forget('hotel_marque_search');
                session()->forget('hotel_date_fin_search');
                session()->forget('hotel_location_search');
                session()->forget('hotel_date_debut_search');
                session()->forget('hotel_days_search');
            }
            return redirect()->route('hotels.index')
                                ->with('success', 'La Chambre a bien été reservee.');
        
        }

        //reservation voiture
        if($type == 'places')
        {  
            $vol = Avion::find($request->product_id);

            $array_place_id = session()->get('seats');
            $size_array = count($array_place_id);
            $code_reservation = Carbon::now()->timestamp;

            for($i = 0 ; $i < $size_array ; $i++)
            {
                $place_single = $vol->places->where('numero_place','=',$array_place_id[$i])->first();              //get id of place
                $order          = new Reservation;
                $order->user_id = Auth()->user() ? Auth()->user()->id  : null;
                $order->chambre_id  = NULL;
                $order->voiture_id  = NULL;
                $order->place_id   = $place_single->id;
                $order->code_reservation    = $code_reservation;

                $order->payment_intent_id   = $request->paymentIntent_id;
                $order->paiment_cree_a  = Carbon::now();

                $montant              = $place_single->avion->prix;
                $order->montant          = $montant - ($montant * $place_single->avion->promotion_pourcentage / 100);

                $order->prix_original      = $place_single->avion->prix;

                $order->etat_personne        = session()->get('etat_personne');
                $order->nom                 = session()->get('nom');
                $order->prenom              = session()->get('prenom');
                $order->email               = session()->get('email');
                $order->telephone           = session()->get('telephone');
                $order->nb_personne         = 1;
                $order->quantite            = 1;                  //incase but idk , its nb jour btw
                $order->type_de_paiment     = 'online';

                $order->date_debut = $place_single->avion->date_depart;
                $order->date_fin   = $place_single->avion->date_retour;             //cuz of spinner range time

                $order->save();

                //$place_single->nombre_places = $place_single->nombre_places - 1;
                $place_single->occupee = 1;
                $place_single->save();
            } 
            if($request->product2_id)
            {
                $vol2 = Avion::find($request->product2_id);

                $array_place_id2 = session()->get('seats2');
                $size_array2 = count($array_place_id2);
                $code_reservation2 = Carbon::now()->timestamp;


                for($i = 0 ; $i < $size_array2 ; $i++)
                {
                    $place_single2              = $vol2->places->where('numero_place','=',$array_place_id2[$i])->first();              //get id of place
                    $order                      = new Reservation;
                    $order->user_id             = Auth()->user() ? Auth()->user()->id  : null;
                    $order->chambre_id          = NULL;
                    $order->voiture_id          = NULL;
                    $order->place_id            = $place_single2->id;
                    $order->code_reservation    = $code_reservation;

                    $order->payment_intent_id   = $request->paymentIntent_id;
                    $order->paiment_cree_a      = Carbon::now();

                    $montant                    = $place_single2->avion->prix;
                    $order->montant             = $montant - ($montant * $place_single2->avion->promotion_pourcentage / 100);

                    $order->prix_original       = $place_single2->avion->prix;

                    $order->etat_personne       = session()->get('etat_personne');
                    $order->nom                 = session()->get('nom');
                    $order->prenom              = session()->get('prenom');
                    $order->email               = session()->get('email');
                    $order->telephone           = session()->get('telephone');
                    $order->nb_personne         = 1;
                    $order->quantite            = 1;                  //incase but idk , its nb jour btw
                    $order->type_de_paiment     = 'online';

                    $order->date_debut          = $place_single2->avion->date_depart;
                    $order->date_fin            = $place_single2->avion->date_retour;             //cuz of spinner range time

                    $order->save();

                    //$place_single2->nombre_places = $place_single2->nombre_places - 1;
                    $place_single2->occupee = 1;
                    $place_single2->save();
                } 


            } 


            return redirect()->route('vols.index')
                    ->with('success', 'Les Places a bien été ajoutés.');
        
        }
           

    }

/*=================================================================================================*/
    /*Display what the client reserved*/
    public function show()
    {
        $orders = Auth()->user() ? \App\Reservation::where('user_id',Auth()->user()->id)->get() 
                                    : \App\Reservation::where('user_id',null)->get() ;

        return view('orders.index',['orders' => $orders]);

    }
    
/*=================================================================================================*/
    /*cancel reservations*/
    public function annulerReservation(Request $request)
    {
        $order_row = Reservation::find($request->product_id);              //select the Reservation row
        $type = $request->type_product;                               //get selected type

        if($type == 'voiture')
        {
            $voiture = Voiture::find($order_row->voiture_id);      //get voiture as object
            $voiture->occupee = 0;
            $voiture->save();
        }

        elseif($type == 'chambre')
        {
            $chambre = Chambre::find($order_row->chambre_id);      //get chambre as object
            $chambre->occupee = 0;
            $chambre->save();
        }

        elseif($type == 'place')
        {
            $place = Place::find($order_row->place_id);      //get place as object
            $place->occupee = 0;
            $place->save();
        }

        else
        {
            return back()->with('error', 'Error.');    
        }   

        Reservation::destroy($request->product_id);

        return back()->with('success', 'La reservation a ete supprime.');    

    }
/*    annulation Old
    public function annulerVoiture(Request $request)
    {
        $product = Reservation::find($request->product_id);       //get Reservation as object
        $voiture = Voiture::find($product->voiture_id);      //get voiture as object

        $voiture->occupee = 0;

        $voiture->save();

        Reservation::destroy($product_id);

        return back()->with('success', 'La reservation Voiture a ete supprime.');    
    }

    public function annulerAvion(Request $request)
    {

        $product        = Reservation::find($request->product_id);
        $product_find   = Reservation::where('user_id', Auth()->user()->id)
                            ->where('vol_id', $request->product_id)->first(); 

        Avion::destroy($product_find->id);
        
        return back()->with('success', 'La reservation de Avion a ete supprime.');    
    }

    public function annulerChambre(Request $request)
    {
        $product = Reservation::find($request->product_id);       //get Reservation as object
        $chambre = Chambre::find($product->voiture_id);      //get Chambre as object
        
        $chambre->occupee = 0;

        $voiture->save();
        
        Reservation::destroy($product_id);
        
        return back()->with('success', 'La reservation de Chambre a ete supprime.');    
    }*/




}



/*Old SHits */
/*    public function reserverChambre(Request $request) 
    
    {

        $product = Chambre::find($request->product_id);
        $product_find = Reservation::where('chambre_id', $product->id)->count(); //to check if it already purchased by user
        if($product->occupee == 1){
            return back()->with('error', 'cette chambre est deja occupee.');

        }
        if ($product_find == 0) {
                $order = new Reservation;

                $order->user_id = Auth()->user()->id;
                $order->chambre_id = $product->id;
                $order->voiture_id = NULL;
                $order->code_reservation = 'aBe91';
                $order->place_id = NULL;

                $order->payment_intent_id = 669;
                $order->paiment_cree_a = Carbon::now();
                $order->montant = $product->prix_chambre;

                $order->save();
                $product->occupee = 1;
                $product->save();
            return back()->with('success', 'La Chambre a bien été ajouté.');

        }

        return back()->with('error', 'La Chambre a déjà été reserver.');
    }
    public function reserverAvion(Request $request) 
    
    {
        $product = Avion::find($request->product_id);
        $product_find = Reservation::where('place_id', $product->id)->count(); //to check if it already purchased by user
        if($product->code_palce <= 0){
            return back()->with('error', 'tous les places sont occupee.');

        }
        if($product->dernier_delai_de_vol > Carbon::now()){
            return back()->with('error', 'le delai de la reservation sont depassee.');

        }
        if ($product_find == 0) {
                $order = new Reservation;

                $order->user_id = Auth()->user()->id;
                $order->chambre_id = NULL;
                $order->voiture_id = NULL;
                $order->place_id = $product->id;
                $order->code_reservation = 'aBe5';

                $order->payment_intent_id = 665;
                $order->paiment_cree_a = Carbon::now();
                $order->montant = $product->prix;

                $order->save();
                $product->nombre_places = $product->nombre_places - 1;
                $product->save();
            return back()->with('success', 'La Chambre a bien été ajouté.');

        }

        return back()->with('error', 'La Chambre a déjà été reserver.');
    }
    public function reserverVoiture(Request $request) 
    
    {
       dd($request);

        $product = Voiture::find($request->product_id);
        $product_find = Reservation::where('voiture_id', $product->id)->count(); //to check if it already purchased by user
        if($product->occupee == 1){
            return redirect()->route('voitures.index')->with('error', 'cette chambre est deja occupee.');

        }
        if ($product_find == 0) {
                $order = new Reservation;

                $order->user_id = Auth()->user()->id;
                $order->chambre_id = NULL;
                $order->voiture_id = $product->id;
                $order->place_id = NULL;
                $order->code_reservation = 'aBe8';
                $order->payment_intent_id = 660;
                $order->paiment_cree_a = Carbon::now();
                $order->montant = $product->prix;

                $order->save();
                $product->occupee = 1;
                $product->save();
            return redirect()->route('voitures.index')->with('success', 'La Voiture a bien été ajouté.');

        }

        return redirect()->route('voitures.index')->with('error', 'La Voiture a déjà été reserver.');
    }
*/



/* if($type == 'chambres')
        {  
            $product = Chambre::find($request->product_id);

            if($product->occupee == 0)
            {
                $order = new Reservation;

                $order->user_id = Auth()->user() ? Auth()->user()->id  : null;
                
        
                $order->chambre_id = $product->id;
                $order->voiture_id = NULL;
                $order->place_id = NULL;
                $order->code_reservation = Carbon::now()->timestamp;        //unique key by second 
                $order->payment_intent_id = $request->paymentIntent_id;
                $order->paiment_cree_a = Carbon::now();
                $order->montant = $product->prix * $request->multiply;
                $order->prix_original = $product->prix;

                $order->etat_personne = $request->etat_personne;
                $order->nom = $request->nom;
                $order->prenom = $request->prenom;
                $order->email = $request->email;
                $order->telephone = $request->telephone;
                $order->nb_personne = session()->get('nb_personne');
                $order->quantite = $request->multiply;                  //incase but idk , its nb jour btw
                $order->type_de_paiment = 'online';

                $order->date_debut = $request->date_debut;
                $order->date_fin = $request->date_fin;

                $order->save();

                $product->occupee = 1;
                $product->save();

                session()->forget('days');
                session()->forget('date_debut');
                session()->forget('nb_personne');
                return redirect()
                        ->route('hotels.index')
                            ->with('success', 'La Chambre a bien été reservee.');
            }

            return redirect()
                    ->route('hotels.index')
                        ->with('error', 'La Chambre a deja été reservee.');
        }*/