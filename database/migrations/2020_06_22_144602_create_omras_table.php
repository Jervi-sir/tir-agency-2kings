<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('omras', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->unique();            //titre du produit
            $table->string('slug')->unique();

            $table->string('vol_titre');
            $table->string('hotel_titre');
            $table->integer('prix');

            $table->string('image');                            //image du service proposee (in future maybe multiple pictures)
            $table->string('type_service');
                             //just a predefined by defaul as 'hotels' to filter services

            $table->longText('description')->nullable();        //descrtiption textuelle 
            $table->string('email')->nullable();                //email de l hotel
            $table->string('type_paiment')->nullable();                //email de l hotel

                /*prix*/
           
            /*geo*/
            $table->string('lieu');                         //will be a multiPolygon() type soon 

            /*dates*///just idea ,,in description
            $table->string('max_jour')->nullable();             //max days hotel can provide          

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
        Schema::dropIfExists('omras');
    }
}
