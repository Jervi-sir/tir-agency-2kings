<?php
/*
        Vol ---one-----to----many--- Place
            vol's foreign key is in the Place table


        vol   (hasMany-billtes)  chambre (belongsTo-vol)       vol->billtes         chambre->vol
        
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vols', function (Blueprint $table) 
        {
            $table->bigIncrements('id');

            /*important*/
            $table->string('titre');                      //titre du produit
            $table->string('slug')->unique();                       //titre qui sera utiliser pour le lien
            $table->integer('nombre_places')->nullable();           //restant [/*hould be edited if place is reserver**/]      
            $table->string('type_service');                         //by default 'vols'
            $table->string('image');                                //image du service proposee 
            $table->string('aeroport_depart');                             //aller retour , or just aller
            $table->string('aeroport_arrivee');                             //aller retour , or just aller
            // $table->integer('code_palce')->nullable();              //idk if it should be Integer or String 

            /*avion bio*/
            $table->string('nom_avion');            
            $table->longText('description')->nullable();            //descrtiption textuelle
            $table->integer('etoiles');                                //prix du service

            /*depart arrivee*/
            $table->string('lieu_depart');       
            $table->string('lieu_arrivee'); 
            $table->date('date_depart');                            //check down       
            $table->date('date_arrivee');    
            $table->date('promotion_delai');       

            /*prix*/
            $table->integer('prix');                                //prix du service
            // $table->string('type_payment')->nullable();             //type : check ,carte , (optionnel non confirmee)
            $table->integer('promotion_pourcentage')->default(0);                                   //prix du service

            /*boolean*/
            $table->boolean('annulation')->nullable();             //descrtiption textuelle 

            /*for the association*//*[[[notconfirmed]]]*/
            // $table->string('escal')->nullable();                    //**[a refaire cuz the association with airport ]**
            // $table->string('airport')->nullable();                  //**[also this association with vols ]**

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
        Schema::dropIfExists('vols');
    }
}

