<?php
/*
ticketController to show the ticket of Services that Client Reservationed from the company 
    .it will get the slug sent from the Order list page(after hitting the button voir)
    .search the id Order through the slug and get the whole object
    .the function are ceparate sinse i dont want to pass 'type' fron the order list page , and it makes it easy to know whats going to be fetched
    ---->retunr [
                    .the ticket page of 3 page(chambre, voiture, place)
                    .one object 
                ]



*/


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voiture;
use App\Chambre;
use App\Place;
use App\Avion;
use Illuminate\Foundation\Auth\User;
use App\Reservation;

class TicketController extends Controller
{

/*----------------------------------------------------------------*/
    public function showPlace($slug, $id)
    {   
        $vol    = Avion::where('slug', $slug)->first();
        $user       = Auth()->user()->id;
        $theReservation   = Reservation::where('user_id','=',$user)->first();
        $place     = $vol->places->where('id','=',$id)->first();

        if(!$vol)
        {
            abort(404, 'le service n existe pas.');
        }

        return view('tickets.vol',['vol' => $vol ,
                                    'place' => $place,
                                    'order'  => $theReservation
                                        ]);
    }

/*----------------------------------------------------------------*/
    public function showChambre($slug)
    {
        $chambre    = Chambre::where('slug', $slug)->first();
        $user       = Auth()->user()->id;
        $theReservation   = Reservation::where('user_id','=',$user)->first();

        if(!$chambre)
        {
            abort(404, 'le service n existe pas.');
        }

        return view('tickets.chambre',['chambre' => $chambre ,
                                        'order'  => $theReservation
                                        ]);
    }

    
/*----------------------------------------------------------------*/
    public function showVoiture($slug)
    {
        $voiture    = Voiture::where('slug', $slug)->first();
        $user       = Auth()->user()->id;
        $theReservation   = Reservation::where('user_id','=',$user)->first();

        if(!$voiture)
        {
            abort(404, 'le service n existe pas.');
        }
        return view('tickets.voiture',['voiture'    => $voiture ,
                                        'order'     => $theReservation
                                        ]);
    }



}
