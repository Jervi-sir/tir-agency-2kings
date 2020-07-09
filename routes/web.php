<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AccueilController@index')->name('/');

/*===========[accueil]=============================================*/
//Route::get('/accueil','accueilController@index')->name('accueils.index');
//Route::get('/services','ServiceController@index');


/*===============HOTEL et CHAMBRES==============================*/
Route::get('/hotels','HotelController@index')->name('hotels.index');
Route::get('/hotels/{slug}','HotelController@show')->name('hotels.show');

/*Rechercher Hotel*/
Route::get('/rechercher_hotel','HotelController@searchHotel')->name('hotels.searchHotel');

/*Chambre*/
Route::get('/pieces/{slug}','ChambreController@showRoom')->name('hotels.showRoom');

/*================CopyRight=======================================*/
Route::get('/copyrights','CopyRightController@index')->name('copyrights.index');


/*================VOITURE=======================================*/
Route::get('/voitures','VoitureController@index')->name('voitures.index');
Route::get('/voitures','VoitureController@suggestion')->name('voitures.theIndex');
Route::get('/voitures/{slug}','VoitureController@show')->name('voitures.show');

/*Rechercher Voiture*/
Route::get('/rechercher_voiture','VoitureController@searchVoiture')->name('voitures.searchVoiture');



/*================VOL et BILLET================================ */
Route::get('/vols','AvionController@index')->name('vols.index');
Route::get('/vols/{slug}','AvionController@show')->name('vols.show');
Route::get('/vols/{slug}/id2={id}','AvionController@showEscale')->name('vols.showEscale');

/*Rechercher vol*/
Route::get('/rechercher_vol','AvionController@searchVol')->name('vols.searchVol');


/*===============[PROMOTIONS]==========================================*/
Route::get('/promotion-voiture', 'VoitureController@promotion')->name('voitures.promotion');
Route::get('/promotion-vol', 'AvionController@promotion')->name('vols.promotion');
Route::get('/promotion-hotel', 'HotelController@promotion')->name('hotels.promotion');



/*================[Reservation]==================================*/
Route::group(['middleware' => ['auth']], function () {
	Route::post('/reserver/Chambre','ReservationController@reserverChambre')->name('reserver.reserverChambre');
	Route::post('/reserver/Voiture','ReservationController@reserverVoiture')->name('reserver.reserverVoiture');
	Route::post('/reserver/Vol','ReservationController@reserverVol')->name('reserver.reserverVol');


	Route::get('/reserver/List','ReservationController@show')->name('reserver.show');
	Route::post('/reserver/annulerVoiture','ReservationController@annulerVoiture')->name('reserver.annulerVoiture');
	Route::post('/reserver/annulerVol','ReservationController@annulerVol')->name('reserver.annulerVol');
	Route::post('/reserver/annulerChambre','ReservationController@annulerChambre')->name('reserver.annulerChambre');
	Route::post('/reserver/annulerReservation','ReservationController@annulerReservation')->name('reserver.annulerReservation');
});


/*================[Paiement]======================================*/
Route::group(['middleware' => ['auth']], function () {

	Route::get('/paiement', 'ReservationController@index')->name('paiement.index');
	Route::get('/store', 'ReservationController@store')->name('paiement.store');
});


/*===============[our Panier]======================================*/
Route::post('/ajouterPanier/Voiture','PanierController@ajouterVoiture')->name('panier.ajouterVoiture');
Route::post('/ajouterPanier/Vol','PanierController@ajouterVol')->name('panier.ajouterVol');
Route::post('/ajouterPanier/Chambre','PanierController@ajouterChambre')->name('panier.ajouterChambre');
Route::get('/voirPanier', 'PanierController@index')->name('panier.index');
Route::delete('/supprimerPanier/{slug}', 'PanierController@supprimerService')->name('panier.supprimerService');

/*===============[TICKETS]=========================================*/
Route::get('/ticketVol/{slug}/id={id}','TicketController@showPlace')->name('ticket.showPlace');
Route::get('/ticketVoiture/{slug}','TicketController@showVoiture')->name('ticket.showVoiture');
Route::get('/ticketChambre/{slug}','TicketController@showChambre')->name('ticket.showChambre');

/*===============[Contacter nous]==========================================*/
Route::get('/contacter_nous', 'ContacterController@index')->name('contacter.index');
Route::post('/contacter_nous', 'ContacterController@store');

/*===============[OMRA]==========================================*/
Route::get('/omra', 'OmraController@index')->name('omra.index');
Route::get('/omra/{slug}', 'OmraController@show')->name('omra.show');
Route::post('/rendezvous', 'OmraController@rendezvous')->name('omra.rendezvous');
Route::get('/rendezvous/list', 'OmraController@list')->name('omra.list');
Route::post('/rendezvous/annulerRendezVous', 'OmraController@annulerRendezVous')->name('omra.annulerRendezVous');


// Route::group(['middleware' => ['logged']], function () {
	Route::get('/my/sidentifier', 'AdminIdentificationController@index')->name('adminIdentification.index');
	Route::post('/my/sidentifier/request', 'AdminIdentificationController@index')->name('adminIdentification.sidentifier');
// });

/*===============[ OUR ADMIN PANEL]===============================*/
Route::group(['middleware' => ['auth','role']], function () {

	Route::get('/my/analytique', 'AdminAnalytiqueController@index')->name('adminAnaletique.index');
	/*===============show data in dashboard==========================*/
	Route::get('/my/profile', 'AdminProfileController@index')->name('adminProfile.index');
	Route::get('/my/voitures', 'AdminVoitureController@index')->name('adminvoitures.index');
	Route::get('/my/chambres', 'AdminChambreController@index')->name('adminChambres.index');
	Route::get('/my/hotels', 'AdminHotelController@index')->name('adminHotels.index');
	Route::get('/my/vols', 'AdminAvionController@index')->name('adminAvions.index');
	Route::get('/my/places', 'AdminPlaceVolController@index')->name('adminPlaces.index');
	Route::get('/my/agence', 'AdminAgenceController@index')->name('adminAgence.index');
	Route::get('/my/omras', 'AdminOmraController@index')->name('adminOmras.index');
	Route::get('/my/rendezvous', 'AdminRendezVousController@index')->name('rendezvous.index');

	/*===============supprimer data from table======================*/
	Route::post('/my/voitures/supprimer', 'AdminVoitureController@supprimer')->name('adminVoitures.supprimer');
	Route::post('/my/chambres/supprimer', 'AdminChambreController@supprimer')->name('adminChambres.supprimer');
	Route::post('/my/hotels/supprimer', 'AdminHotelController@supprimer')->name('adminHotels.supprimer');
	Route::post('/my/vols/supprimer', 'AdminAvionController@supprimer')->name('adminAvions.supprimer');
	Route::post('/my/places/supprimer', 'AdminPlaceVolController@supprimer')->name('adminPlaces.supprimer');
	Route::post('/my/omras/supprimer', 'AdminOmraController@supprimer')->name('adminOmras.supprimer');

	Route::post('/my/rendezvous/supprimer', 'AdminRendezVousController@supprimer')->name('adminRendezvous.supprimer');
	
		/*===============supprimer data from table======================*/
	Route::post('/my/voitures/supprimerBulk', 'AdminVoitureController@supprimerBulk')->name('adminVoitures.supprimerBulk');
	Route::post('/my/chambres/supprimerBulk', 'AdminChambreController@supprimerBulk')->name('adminChambres.supprimerBulk');
	Route::post('/my/hotels/supprimerBulk', 'AdminHotelController@supprimerBulk')->name('adminHotels.supprimerBulk');
	Route::post('/my/vols/supprimerBulk', 'AdminAvionController@supprimerBulk')->name('adminAvions.supprimerBulk');
	Route::post('/my/places/supprimerBulk', 'AdminPlaceVolController@supprimerBulk')->name('adminPlaces.supprimerBulk');
	Route::post('/my/omras/supprimerBulk', 'AdminOmraController@supprimerBulk')->name('adminOmras.supprimerBulk');

	Route::post('/my/rendezvous/supprimerBulk', 'AdminRendezVousController@supprimerBulk')->name('adminRendezvous.supprimerBulk');
	
	/*===============afficher data from table======================*/
	Route::post('/my/voitures/afficher', 'AdminVoitureController@afficher')->name('adminVoitures.afficher');
	Route::post('/my/chambres/afficher', 'AdminChambreController@afficher')->name('adminChambres.afficher');
	Route::post('/my/hotels/afficher', 'AdminHotelController@afficher')->name('adminHotels.afficher');
	Route::post('/my/vols/afficher', 'AdminAvionController@afficher')->name('adminAvions.afficher');
	Route::post('/my/places/afficher', 'AdminPlaceVolController@afficher')->name('adminPlaces.afficher');
	Route::post('/my/omra/afficher', 'AdminOmraController@afficher')->name('adminOmras.afficher');

	Route::post('/my/rendezvous/afficher', 'AdminRendezVousController@afficher')->name('adminRendezvous.afficher');
	

	/*===============redirection pour ajouter======================*/
	Route::get('/my/voitures/pageAjouter', 'AdminVoitureController@redirect_pour_ajouter')->name('adminVoitures.pageAjouter');
	Route::get('/my/chambres/pageAjouter', 'AdminChambreController@redirect_pour_ajouter')->name('adminChambres.pageAjouter');
	Route::get('/my/hotels/pageAjouter', 'AdminHotelController@redirect_pour_ajouter')->name('adminHotels.pageAjouter');
	Route::get('/my/vols/pageAjouter', 'AdminAvionController@redirect_pour_ajouter')->name('adminAvions.pageAjouter');
	Route::get('/my/places/pageAjouter', 'AdminPlaceVolController@redirect_pour_ajouter')->name('adminPlaces.pageAjouter');
	Route::get('/my/omras/pageAjouter', 'AdminOmraController@redirect_pour_ajouter')->name('adminOmras.pageAjouter');

	/*===============ajouter pour ajouter======================*/
	Route::post('/my/voitures/ajouter', 'AdminVoitureController@ajouter')->name('adminVoitures.ajouter');
	Route::post('/my/chambres/ajouter', 'AdminChambreController@ajouter')->name('adminChambres.ajouter');
	Route::post('/my/hotels/ajouter', 'AdminHotelController@ajouter')->name('adminHotels.ajouter');
	Route::post('/my/vols/ajouter', 'AdminAvionController@ajouter')->name('adminAvions.ajouter');
	Route::post('/my/places/ajouter', 'AdminPlaceVolController@ajouter')->name('adminPlaces.ajouter');
	Route::post('/my/omras/ajouter', 'AdminOmraController@ajouter')->name('adminOmras.ajouter');

	/*===============redirection pour modifier======================*/

	Route::get('/my/voitures/modifier', 'AdminVoitureController@edit')->name('adminVoitures.edit');
	Route::get('/my/chambres/modifier', 'AdminChambreController@edit')->name('adminChambres.edit');
	Route::get('/my/hotels/modifier', 'AdminHotelController@edit')->name('adminHotels.edit');
	Route::get('/my/vols/modifier', 'AdminAvionController@edit')->name('adminAvions.edit');
	Route::get('/my/places/modifier', 'AdminPlaceVolController@edit')->name('adminPlaces.edit');
	Route::get('/my/utilisateurs/modifier', 'AdminUtilisateurController@edit')->name('adminUtilisateur.edit');
	Route::get('/my/omras/modifier', 'AdminOmraController@edit')->name('adminOmras.edit');
	
	/*===============redirection pour mise à jour après la modification======================*/
	Route::post('/my/voitures/modifier', 'AdminVoitureController@update')->name('adminVoitures.update');
	Route::post('/my/chambres/modifier', 'AdminChambreController@update')->name('adminChambres.update');
	Route::post('/my/hotels/modifier', 'AdminHotelController@update')->name('adminHotels.update');
	Route::post('/my/vols/modifier', 'AdminAvionController@update')->name('adminAvions.update');
	Route::post('/my/places/modifier', 'AdminPlaceVolController@update')->name('adminPlaces.update');
	Route::post('/my/utilisateurs/modifier', 'AdminUtilisateurController@update')->name('adminUtilisateur.update');
	Route::post('/my/omra/modifier', 'AdminOmraController@update')->name('adminOmras.update');



	/*===============rechercher======================*/
	Route::get('/my/voitures/rechercher', 'AdminVoitureController@rechercher')->name('adminVoitures.rechercher');
	Route::get('/my/chambres/rechercher', 'AdminChambreController@rechercher')->name('adminChambres.rechercher');
	Route::get('/my/hotels/rechercher', 'AdminHotelController@rechercher')->name('adminHotels.rechercher');
	Route::get('/my/vols/rechercher', 'AdminAvionController@rechercher')->name('adminAvions.rechercher');
	Route::get('/my/places/rechercher', 'AdminPlaceVolController@rechercher')->name('adminPlaces.rechercher');
	Route::get('/my/omras/rechercher', 'AdminOmraController@rechercher')->name('adminOmras.rechercher');
	
	Route::get('/my/rendezvous/rechercher', 'AdminRendezVousController@rechercher')->name('adminRendezVous.rechercher');

});


Route::group(['middleware' => ['auth','roleAdmin']], function () {
	Route::get('/my/utilisateurs', 'AdminUtilisateurController@index')->name('adminUtilisateur.index');
	Route::post('/my/utilisateurs/supprimer', 'AdminUtilisateurController@supprimer')->name('adminUtilisateur.supprimer');
	Route::get('/my/utilisateurs/pageAjouter', 'AdminUtilisateurController@redirect_pour_ajouter')->name('adminUtilisateur.pageAjouter');
	Route::post('/my/utilisateurs/ajouter', 'AdminUtilisateurController@ajouter')->name('adminUtilisateur.ajouter');
	Route::post('/my/utilisateurs/afficher', 'AdminUtilisateurController@afficher')->name('adminUtilisateur.afficher');
	Route::get('/my/utilisateurs/rechercher', 'AdminUtilisateurController@rechercher')->name('adminUtilisateur.rechercher');
	Route::post('/my/utilisateurs/supprimerBulk', 'AdminUtilisateurController@supprimerBulk')->name('adminUtilisateur.supprimerBulk');
	Route::get('/my/agence/modifier', 'AdminAgenceController@edit')->name('adminAgence.edit');
	Route::post('/my/agence/modifier', 'AdminAgenceController@update')->name('adminAgence.update');

});




//OLD SHits
/*Panier*/
Route::group(['middleware' => ['auth']], function () {
		Route::get('/panier', 'CartController@index')->name('cart.index');
		Route::post('/panier/ajouterVoiture','CartController@storeVoiture')->name('cart.storeVoiture');
		Route::post('/panier/ajouterHotel','CartController@storeHotel')->name('cart.storeHotel');
		Route::post('/panier/ajouterVol','CartController@storeVol')->name('cart.storeVol');
		Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');
		Route::get('/videpanier', function () {Cart::destroy();});
});
Route::group(['middleware' => ['auth']], function () {
		Route::get('/paiement1', 'CheckoutController@index')->name('checkout.index');
		Route::post('/paiement1','CheckoutController@store')->name('checkout.store');
		Route::get('/merci1', 'CheckoutController@thankyou')->name('checkout.thankyou');
});
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


/*===============Default =================================*/
Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::post('/home', 'HomeController@store');
// Route::post('/homesotre', 'HomeController@store');

//Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home','accueilController@index')->name('accueils.index');
