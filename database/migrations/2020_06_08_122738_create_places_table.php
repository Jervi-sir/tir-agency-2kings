<?php
/*
        Place ---one---to----one--- Order
            the foreing key is in the Order table
        
        vol ---one-----to----many--- Place
            it got the vol's foreign key

        vol   (hasMany-places)  place (belongsTo-vol)       vol->places         place->vol
        

        place (hasOne-Order)      order   (belongsTo-place)     order->place

        
*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) 
        {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('avion_id');
            $table->integer('code_place')->nullable();              //chmbre location in hotel   
            $table->integer('numero_place');                        //chmbre location in hotel   
            // $table->boolean('economique');                          //place 'places' economique or first class
            // $table->integer('prix_place')->nullable();              //perNight
            $table->boolean('occupee');                             //if free or reserved
            // $table->string('type_place');                           //byDefault 'places'
            $table->string('type_service');                         //byDefault 'places'


            $table->timestamps();

            $table->foreign('avion_id')->references('id')->on('avions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
