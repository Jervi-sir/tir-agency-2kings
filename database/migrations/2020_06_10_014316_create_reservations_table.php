<?php
/*
    User --one---to-----many--- Reservation
        here , a foreign key of user

    Reservation --one---to----one--- Place
    Reservation --one---to----one--- Chambre
    Reservation --one---to----one--- Voiture
        here , a foreign key of Place, Chambre, Voiture

    order(belongsTo-place)
    order(belongsTo-chmabre)
    order(belongsTo-voiture)

    order->places
    order->chambres
    order->voitures

*/
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) 
        {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('code_reservation');

            /*foreign Keys Helper*/
            $table->unsignedBigInteger('chambre_id')->index()->unique()->nullable();
            $table->unsignedBigInteger('voiture_id')->index()->unique()->nullable();
            $table->unsignedBigInteger('place_id')->index()->unique()->nullable();

            /*foreign Keys*/
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('chambre_id')->references('id')->on('chambres')->onDelete('cascade');
            $table->foreign('voiture_id')->references('id')->on('voitures')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            
            /*table rest data */
            $table->string('paiement_intent_id')->nullable();      //nullable if the client isnt registered  
            $table->integer('montant');
            $table->integer('prix_original');
            $table->datetime('paiement_cree_a');
            $table->datetime('date_debut');
            $table->datetime('date_fin');

            $table->string('etat_personne');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->string('quantite')->nullable();                         //incase of days of the reservation
            $table->string('nb_personne')->nullable();                      //incase the nombre of beds
            $table->string('type_de_paiement');

            $table->timestamps();

                /*old data 
            $table->text('products');
             $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onUpdate('cascade')
                        ->onDelete('Null');
                */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
