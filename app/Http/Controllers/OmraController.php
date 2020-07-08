<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Omra as Omra;
use App\OmraRendezVous;
use Carbon\Carbon;
use App\User;


class OmraController extends Controller
{
    public function index()
    {
    	$omras = new Omra;

		
		$omras = $omras->inRandomOrder();

		$omras = $omras->paginate(6);
        //$type_object = 'omra';

        return view('omra.index')->with('omras', $omras);
    }

    public function show(Request $request) 
	{
		$omra = Omra::where('slug', $request->slug)->first();						//get the first result only
		
		if(!$omra)																
        {	
        	abort(404, 'le service n existe pas.');	
        }
		
		$omra_id = $omra->id;	

		
		return view('omra.show',['omra' 		=> $omra]);
	}

	public function rendezvous(Request $request)
	{

		$meet = new OmraRendezVous;

		$meet->nom = request()->input('nom');
		$meet->prenom = request()->input('prenom');
		$meet->email = request()->input('email');
		$meet->telephone = request()->input('telephone');




        $start         			= Carbon::now();

        if(Carbon::now()->dayOfWeek == 2)					//means tuesday 
        {
        	$date_rendez_vous = $start->addDays(4)->format('Y-m-d');			//just to escape the case of friday
        }
        else
        {
        	$date_rendez_vous   = $start->addDays(3)->format('Y-m-d');
        }

		$meet->date_rendez_vous = $date_rendez_vous;

		$meet->omra_id = request()->input('omra_id');

		$meet->user_id = Auth()->user() ? Auth()->user()->id  : null;

		$meet->save();

 		return back()->with('success', 'Vous avez votre rendez-vous le: '. $date_rendez_vous);

	}
	

	public function list()
    {
        $rendez_vous = OmraRendezVous::where('user_id',Auth()->user()->id)->get();

        return view('omra.list',['rendez_vous' => $rendez_vous]);

    }


    public function annulerRendezVous(Request $request)
    {
        OmraRendezVous::destroy($request->rendez_vous_id);

        return back()->with('success', 'Le Rendez-vous a été annulé.');    

    }





}
