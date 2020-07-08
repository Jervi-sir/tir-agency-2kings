<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

class AdminUtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $users = new User;

        $users = $users->orderBy('id', 'desc');

        $users = $users->paginate(20);

        return view('admin.utilisateurs.index')->with('users', $users);
    }

    public function supprimer(Request $request)
    {
        User::destroy($request->user_id);

        return back()->with('successDelete', 'Suppression réussie.');    
    }

    public function supprimerBulk(Request $request)
    {
        $array_id = explode(',', $request->array_id);       

        for($i=0; $i < count($array_id);$i++)
        {
            User::destroy($array_id[$i]);
        }

        return back()->with('successDelete', 'Suppression réussie.');    
    }


    public function afficher(Request $request)
    {
        $user    = User::find($request->user_id);

        return view('admin.utilisateurs.show',['user'=> $user]);
    }

    public function redirect_pour_ajouter()
    {
        return view('admin.utilisateurs.ajouter');
    }

    public function ajouter(Request $request)
    {
        $utilisateur = new User;
        $utilisateur->name = $request->nom ;
        $utilisateur->email = $request->email ;
        $utilisateur->password = bcrypt($request->mot_de_pass) ;
        $utilisateur->avatar = 'utilisateurs'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->image ;

        $role_id_but_array = explode(' ..', $request->role_id);       //to take the first number of seletion
        $role_id = $role_id_but_array[0];                            // since it is the id of the role
        
        $utilisateur->role_id = $role_id;
        $utilisateur->remember_token = Str::random(60);

        $utilisateur->save();
        return back()->with('success', 'Le compte a bien été Ajoueté.');

    }

    public function rechercher()
    {
        $titre     = request()->input('titre');      

        $users = new User;

        $users = User::where('name' , 'like', "%$titre%")->orderBy('id', 'desc');

        $users = $users->paginate(20);
      
        return view('admin.utilisateurs.index',['users'=> $users]);   

    }

   public function edit(Request $request)
    {
        $user    = User::find($request->user_id);

        return view('admin.utilisateurs.edit',['user'=> $user]);
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

        $utilisateur    = User::find($request->user_id);

        $utilisateur->name = $request->input('nom');
        $utilisateur->email = $request->input('email');
        $utilisateur->avatar = 'users'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$request->input('image');

        $utilisateur->save();

        return back()->with('successEdit', 'L\'utilisateur a été modifiée avec succés.');
    }


}
