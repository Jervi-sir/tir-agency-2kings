<?php
/*
        Chambre ---one---to----one--- Order
            the foreing key is in the Order table
        
        Hotel ---one-----to----many--- Chambre
            it got the hotel's foreign key

        hotel   (hasMany-chambres)  chambre (belongsTo-hotel)       hotel->chambres         chambre->hotel
        

        chambre (hasOne-Order)      order   (belongsTo-chambre)     order->chambre

        
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChambresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chambres', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
                /*hotel one to many chambres */
            $table->unsignedBigInteger('hotel_id');

            /*important*/
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('image');
            $table->string('type_service');                         //byDefault 'chambres'
            $table->boolean('occupee');                             //if free or reserved

            /*chambre bio*/
            $table->integer('numero_chambre')->nullable();          //chmbre location in hotel
            $table->integer('nb_lit');
            $table->integer('superficie')->nullable();
            // $table->integer('reviews')->nullable();

            /*ziyada*/
            $table->longText('description')->nullable(); 
            // $table->string('options')->nullable();
            /*prix*/
            $table->integer('prix')->nullable();                    //perNight
            $table->integer('promotion_pourcentage')->default(0);                                   //prix du service
            $table->date('promotion_delai');       
            
            

            /*boolean*/
            $table->boolean('repas')->nullable();              
            $table->boolean('annulation')->nullable();              
            $table->boolean('avec_enfant')->nullable();   

                /*foreing key of Chambre belongs to one , table ll be deleted when hotel is deleted */
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');


           /*  old Data
            $table->integer('hotel_id')->unsigned()->index();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
           
            */
            
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
        Schema::dropIfExists('chambres');
    }
}
