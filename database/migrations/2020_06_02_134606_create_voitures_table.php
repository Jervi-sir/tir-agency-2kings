<?php
/*

        Voiture ---one---to----one--- Order
        
        the foreing key is in the Order table

        voiture(hasOne-Order)               
        order  (belongsTo-voiture)

        order->voiture
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            
            /*important*/
            $table->string('titre');                          //titre du produit
            $table->string('slug')->unique();                           //titre qui sera utiliser pour le lien 
            $table->string('image');                                    //image du service proposee
            $table->string('lieu');                                 //location ouu le service sera trouvee
            $table->string('type_service')->default('voitures');        //by default 'voitures'
            $table->boolean('occupee');                                 //if free or reserved

            /*ranking*/
            $table->integer('portes')->nullable();                      //prix du service
            $table->integer('etoiles')->nullable();                     //prix du service
            // $table->integer('reviews')->nullable();                     //prix du service
            $table->integer('nombre_places')->nullable();               //prix du service
            $table->string('type_voiture')->nullable();

            /*oziyada*/
            $table->longText('description')->nullable();                //descrtiption textuelle 
            // $table->string('options')->nullable();              
            $table->integer('annee')->nullable();                       //prix du service


            /*prix*/
            $table->integer('prix');                                   //prix du service
            // $table->string('type_payment')->nullable();                //type : check ,carte , ..

            /*boolean*/
            $table->boolean('km_illimite')->nullable();               //option
            $table->boolean('assurance')->nullable();                   //option
            $table->boolean('climatiseur')->nullable();                 //date debut du service (non confirmme) 
            $table->boolean('manuel')->nullable();                      //date debut du service (non confirmme) 
            $table->boolean('electric')->nullable();                    //date fin du service (non confirmme) 
            $table->boolean('annulation')->nullable();                 //option
            $table->integer('promotion_pourcentage')->default(0);                                   //prix du service
            $table->date('promotion_delai');       
            


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
        Schema::dropIfExists('voitures');
    }
}
