<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CopyRightController extends Controller
{
    public function index() {

    	return view('copyrights.index');
    }
}
