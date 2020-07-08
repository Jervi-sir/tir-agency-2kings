<?php
/*
for Email Contact with User

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;

class ContacterController extends Controller
{
	public function index()
	{
		return view('contacter.index');
	}

	public function store()
	{
		request()->validate
		(
			[	
				'nom' => 'required|min:3',
				'email' => 'required|email',
				'objet' => 'required|min:5',
				'message' => 'required|min:30',
			]
		);

		Mail::to('tir@admin.com')
			->send(new ContactMe(request('message')));

		/*Mail::raw(request('message'), function ($message)
        {
            $message->from(request('email'))
            	->to('admin@example.com')
                ->subject(request('objet'));
        });*/

        return redirect('/contacter_nous')->with('success', 'Email envoyée!');
	}   
}
