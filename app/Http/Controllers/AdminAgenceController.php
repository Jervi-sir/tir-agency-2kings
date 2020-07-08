<?php

namespace App\Http\Controllers;

use App\Agence;
use Illuminate\Http\Request;

class AdminAgenceController extends Controller
{
    public function index()
    {
        $agence = new Agence;

        $agence = Agence::first();

        return view('admin.agence.index')->with('agence', $agence);
    }

    public function edit()
    {
        $agence = Agence::first();

        return view('admin.agence.edit',['agence'=> $agence]);
    }


    public function update(Request $request)
    {

        $agence = Agence::first();
        $agence->nom_agence = $request->input('nom_agence');
        $agence->email = $request->input('email');
        $agence->telephone = $request->input('telephone');

        $imagesPath = [];

        array_push($imagesPath,$request->input('facebook'));
        array_push($imagesPath,$request->input('twitter'));
        array_push($imagesPath,$request->input('instagram'));
        array_push($imagesPath,$request->input('linkedin'));

        $agence->reseaux_sociaux = json_encode($imagesPath) ;

        $agence->a_propos_agence = $request->input('description');
        $agence->logo = 'agence'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->input('image');

        $agence->save();

        return back()->with('successEdit', 'Votre Agence a été modifiée avec succées.');
    }



}
