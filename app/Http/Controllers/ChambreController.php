<?php
/*
chambreController will shot chambre pages

showRoom($slug) 	.take the slug, search on db get the first object then returns it 
					---->return[
									.redirect to showRoom
									.object
								]

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chambre;
use App\Hotel;

class ChambreController extends Controller
{
    	public function showRoom($slug) 
    	{  
			$product = Chambre::where('slug', $slug)->first();

			return view('hotels.showRoom',['chambre' => $product]);

		}
}
			//$hotel_id = $product->hotel_id;	//without the rls
			//$hotel_pere = Hotel::where('id', $hotel_id)->first(); //without the rls
			//return view('hotels.showRoom',['hotel' => $hotel_pere, 'chambre' => $product]); //without rls