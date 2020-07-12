<?php
/*
No Auth required 
index()         rturn home page with hotels table
                also it will fill session with currecy user has choosen 
                will store email and send it 


*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chambre;
use App\Hotel;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {

        $this->refreshHotel();              //refresh Hotel 
        
                $hotels = Hotel::where('etoiles','>',3)
                        ->where('chambres_disponible','>',0)
                        ->get();
                        
        if(request()->has('currency'))
        {
            $array = array("dzd","dzd","eur","gbp","usd");

            $currency = $array[request()->input('currency')];
            
            session(['currency' => $currency]);

            return back()->with('hotels',$hotels);
        }

       
        //$currency = $array[request()->input('currency')];


        return view('home')->with('hotels',$hotels);
    }


    public function store()
    {
        request()->validate(['email' => 'required|email']);

        Mail::to(request('email'))
            ->send(new Contact());



        /*Mail::raw('Toutes nos félicitations! Vous venez de vous abonner à notre exemple de newsletter', function ($message)
        {
            $message->to(request('email'))
                ->subject('Merci pour votre abonnement');
        });*/

        return back()->with('successMail', 'Email envoyée!');
    }


    function refreshHotel()
        {
            $hotels_refresh = \App\Hotel::all();    
                                                    //since eloquent rls dont work in the mass object at once 
            foreach($hotels_refresh as $hotel)  
            {
                 $min_of_chambres = $hotel->chambres->min('prix') ?? 0;         //got to turn max_jour , to prix_min in db table
                 $hotel->prix = $min_of_chambres;

                 $count_chambres_libre = $hotel->chambres->where('occupee','=',0)->count();
                 $hotel->chambres_disponible  = $count_chambres_libre;

                 $hotel->save();
            }
        }
    
}
