<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class RefreshHotelChambres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:refresh_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = \App\Order::all();

        foreach($orders as $order) 
        {
            if($order->date_fin < Carbon::now())
            {
                $voiture    = $order->voiture_id;                               
                $chambre    = $order->chambre_id;                               
                $place     = $order->place_id;                                

                if($voiture)
                {
                    $voiture = \App\Voiture::find($order->voiture_id);      //get voiture as object
                    $voiture->occupee = 0;
                    $voiture->save();
                }

                if($chambre)
                {
                    $chambre = \App\Chambre::find($order->chambre_id);      //get chambre as object
                    $chambre->occupee = 0;
                    $chambre->save();
                }

                if($place)
                {
                        //rien, since its one plane
                }

                \App\Order::destroy($order->id);

            }
        }
    }
}
