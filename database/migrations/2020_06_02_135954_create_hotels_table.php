<?php
/*
        Hotel ---one-----to----many--- Chambre
            hotel's foreign key is in the Chambre table

        hotel   (hasMany-chambres)  chambre (belongsTo-hotel)       hotel->chambres         chambre->hotel
        
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            
            /*important*/
            $table->string('titre');                  //titre du produit
            $table->string('slug')  ->unique();                   //titre qui sera utiliser pour le lien 
            $table->string('image');                            //image du service proposee (in future maybe multiple pictures)
            $table->string('type_service');                     //just a predefined by defaul as 'hotels' to filter services

            /*ziyada*/
            $table->longText('description') ->nullable();        //descrtiption textuelle 
            $table->string('telephone')         ->nullable();                
            $table->string('langues')         ->nullable();                

                /*prix*/
            // $table->string('type_payment')  ->nullable();         //type : check ,carte , ..(optionnel non confirmee)
           
            /*geo*/
            $table->string('lieu');                         //will be a multiPolygon() type soon
            
            /*ranking*/
            // $table->integer('reviews')      ->nullable();             //reviews
            $table->integer('etoiles')      ->nullable();             //etoiles 
            
            /*booleans*/
            $table->boolean('avec_wifi')      ->nullable();             //si existe ou pas
            $table->boolean('avec_gym')       ->nullable();              //si existe ou pas
            $table->boolean('avec_animaux') ->nullable();        //si existe ou pas
            $table->boolean('avec_parking')   ->nullable();          //si existe ou pas
            $table->boolean('avec_piscine')   ->nullable();          //si existe ou pas
            $table->boolean('annulation');                     //si existe ou pas

            /*dates*///just idea ,,in description
            $table->integer('chambres_disponible')   ->nullable();             //chambres available          
            $table->integer('prix')                 ->nullable();                //minimute price for all its rooms

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}


/*since wont let the provider retipe the date , also rooms wont be deleted , just marked as occuppe
so when client search by date , it means he want to stay at the hotel amount of days , so it makes sence to 
add an Max_Jour instead of date debut date fin , 