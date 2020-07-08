<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    
	/*afficher accuil ta3 admin panel if logged in correctly*/
    public function index()
    {
        return view('admin.profile.index');
    }



}
