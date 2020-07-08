@extends('layouts.master2')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Vols</title>
@endsection
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('bannerArea')
<section class="about-banner-avion relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Vols
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mx-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('vols.index') }}" class="ml-3"> Vols</a></p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra-style')
<style>
    /* Tooltip container */
    .tooltip {
      position: relative;
      display: inline-block;
      border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
    }

    /* Tooltip text */
    .tooltip .tooltiptext {
      visibility: hidden;
      width: 120px;
      background-color: black;
      color: #fff;
      text-align: center;
      padding: 5px 0;
      border-radius: 6px;
     
      /* Position the tooltip text - see examples below! */
      position: absolute;
      z-index: 1;
    }

    /* Show the tooltip text when you mouse over the tooltip container */
    .tooltip:hover .tooltiptext {
      visibility: visible;
    }
    .seat-stye
    {
        max-width: 22%;
        width: 12%;
    }
    .seat-stye-column
    {
        max-width: 22%;
        width: 11%;
        padding-left: 3%;
    }
    .seat-stye-row button
    {
        padding-left: 10px;
        padding-right: 20px;
    }
         .right::-webkit-scrollbar {
            width: 12px;               /* width of the entire scrollbar */
        }
        .right::-webkit-scrollbar-track {
          background: #f8b60069;        /* color of the tracking area */
        }
        .right::-webkit-scrollbar-thumb {
          background-color: #f8b600;    /* color of the scroll thumb */
          border-radius: 20px;       /* roundness of the scroll thumb */
          border: 3px solid #f8b60069;  /* creates padding around scroll thumb */
        }

        .promotion 
        {
          color: #fff;
          background-image: -webkit-gradient(linear, left bottom, left top, from(#ffaa57), to(#fe5c76));
          box-shadow: 0 5px 30px 0 rgba(13, 21, 75, .4);
          position: absolute;
          top: 0px;
          right: 15px;
          padding: 12px 20px;
          border-top-left-radius: 214px;
          border-bottom-left-radius: 999px;
          font-weight: 500;
          font-size: 18px;
        }
        #searchinput 
        {
            width: 200px;
        }
        #searchclear 
        {
            position: absolute;
            right: 6%;
            top: 0%;
            bottom: 0;
            height: 56%;
            margin: auto;
            font-size: 23px;
            cursor: pointer;
            color: #676767;
        }

</style>



@endsection


@section('content-noSidebar')
<?php 

$datetime = new DateTime($vol->date_depart);
$datetime2 = new DateTime($vol->date_retour);
$time = explode(':', strval($vol->duree_vol)); 

/////Aller
//depart
$heur_depart = substr(explode(' ', $vol->date_depart)[1], 0, 5);
$jour_mois_depart = date("M j ", strtotime( $datetime->format('Y-m-d H:i') ));
$annee_depart = date("Y ", strtotime( $datetime->format('Y-m-d H:i') ));

// arrivee        
$result = $datetime->modify('+'.$time[0].' hour +'.$time[1].' minutes')->format('Y-m-d H:i');
$jour_mois_arrivee = date("M j ", strtotime( $result ));
$annee_arrivee = date("Y", strtotime( $result ));
$heur_minute_arrivee = date("H:i", strtotime( $result ));

/////Retour
//depart   
$heur_depart2 = substr(explode(' ', $vol->date_retour)[1], 0, 5);
$jour_mois_depart2 = date("M j ", strtotime( $datetime2->format('Y-m-d H:i') ));
$annee_depart2 = date("Y ", strtotime( $datetime2->format('Y-m-d H:i') ));

// arrivee        
$result2 = $datetime2->modify('+'.$time[0].' hour +'.$time[1].' minutes')->format('Y-m-d H:i');
$jour_mois_arrivee2 = date("M j ", strtotime( $result2 ));
$annee_arrivee2 = date("Y", strtotime( $result2 ));
$heur_minute_arrivee2 = date("H:i", strtotime( $result2 ));


//********the fist flight ************************/
$avion1_depart = request()->search_vol_depart;
$avion1_arrivee = $vol->lieu_depart;

$avion1 = \App\Avion::where('lieu_depart','like',"%$avion1_depart%")
                    ->where('lieu_arrivee','like',"%$avion1_arrivee%")
                    ->first();

$datetime_avion1 = new DateTime($avion1->date_depart);
$datetime2_avion1 = new DateTime($avion1->date_retour);
$time_avion1 = explode(':', strval($avion1->duree_vol)); 

/////Aller
//depart
$heur_depart_avion1 = substr(explode(' ', $avion1->date_depart)[1], 0, 5);
$jour_mois_depart_avion1 = date("M j ", strtotime( $datetime_avion1->format('Y-m-d H:i') ));
$annee_depart_avion1 = date("Y ", strtotime( $datetime_avion1->format('Y-m-d H:i') ));

// arrivee        
$result_avion1 = $datetime->modify('+'.$time_avion1[0].' hour +'.$time_avion1[1].' minutes')->format('Y-m-d H:i');
$jour_mois_arrivee_avion1 = date("M j ", strtotime( $result_avion1 ));
$annee_arrivee_avion1 = date("Y", strtotime( $result_avion1 ));
$heur_minute_arrivee_avion1 = date("H:i", strtotime( $result_avion1 ));

/////Retour
//depart   
$heur_depart2_avion1 = substr(explode(' ', $avion1->date_retour)[1], 0, 5);
$jour_mois_depart2_avion1 = date("M j ", strtotime( $datetime2_avion1->format('Y-m-d H:i') ));
$annee_depart2_avion1 = date("Y ", strtotime( $datetime2_avion1->format('Y-m-d H:i') ));

// arrivee        
$result2_avion1 = $datetime2_avion1->modify('+'.$time_avion1[0].' hour +'.$time_avion1[1].' minutes')->format('Y-m-d H:i');
$jour_mois_arrivee2_avion1 = date("M j ", strtotime( $result2_avion1 ));
$annee_arrivee2_avion1 = date("Y", strtotime( $result2_avion1 ));
$heur_minute_arrivee2_avion1 = date("H:i", strtotime( $result2_avion1 ));


 ?>
<script type="text/javascript">
     function getDays() {

        var seats_send_vol2 = document.getElementById("seats-div_vol2").innerHTML;
        document.getElementById("seats_request_vol2").value = seats_send_vol2;

       
        var seats_send = document.getElementById("seats-div").innerHTML;
        document.getElementById("seats_request").value = seats_send;

        // var get_days_vol2 = document.getElementById("nb_personne_vol2").value;
        // document.getElementById("nb_jour").value = get_days_vol2;

        // var get_days = document.getElementById("nb_personne").value;
        // document.getElementById("nb_jour").value = get_days;
        

    }
    
    function getNumbers(string)
    {
    string = string.split(" ");
    var int = ""; 
    for(var i=0;i<string.length;i++){
      if(isNaN(string[i])==false){
      int+=string[i];
      }
    }


</script>
<section class="content-area mt-5">
    <script type="text/javascript">
        
    function getgetget()
    {
        var tookOff = ["DA", "€", "£", "$", ",", ",", ",", ",", ",", ",", " ", " ", " ", " ", " ", " ", " ", " ", " ", " "];
        var total1 = document.getElementById("total").innerHTML;
        var total2 = document.getElementById("total_vol2").innerHTML;

        for(var i=0; i<tookOff.length;i++){
            var total1 = total1.replace(tookOff[i], "");
        }

        for(var i=0; i<tookOff.length;i++){
            var total2 = total2.replace(tookOff[i], "");
        }

        var the_total = parseInt(total1) + parseInt(total2);
        document.getElementById("the_total").innerHTML = the_total;

       var currency_vol0 = document.getElementById("currecy_used_vol2").value;

            if(currency_vol0 == "dzd")
            {
              document.getElementById("the_total").innerHTML = currencyFormatDA(the_total);
            }
            else if(currency_vol0 == "eur")
            {
              document.getElementById("the_total").innerHTML = currencyFormatEUR(the_total);
            }
            else if(currency_vol0 == "gbp")
            {
              document.getElementById("the_total").innerHTML = currencyFormatGBP(the_total);
            }
            else if(currency_vol0 == "usd")
            {
              document.getElementById("the_total").innerHTML = currencyFormatUSD(the_total);
            }

    }


    </script>
    <div class="container">
        <div class="row">
            <div class="col-xl-10 mx-auto col-lg-10 container row">
                <div class="col-lg-12 col-sm-12 container px-0">
                    <div class="flight-list-box rt-mb-30 row">
                        <!----------RIGHT------------------>
                        <div class="col-md-12 px-0 mr-3">
                            <!----------UPPER------------------>
                            <div class="col-12 row px-0 mx-0">
                                <div class="col-sm-2 flight-logo">
                                    <img src="{{ secure_asset('storage/' . $vol2->image) }}" alt="vol logo" draggable="false">
                                </div><!-- /.flight-logo -->
                                @if($vol2->promotion_pourcentage > 0)
                                <div class="promotion">
                                    réduction de {{ $vol2->promotion_pourcentage }} %
                                </div><!-- /.inner-badge -->
                                @endif
                                <div class="col-sm-4 pricing text-center">
                                    <p>{{$vol2->nom_avion}} | {{$vol2->aeroport_depart}}</p>
                                    <p>{{$vol2->lieu_depart}}</p>
                                </div><!-- /.pricing -->
                                <div class="col-sm-4 px-0 flight-time d-flex justify-content-between align-items-lg-center">
                                    <div class="left">
                                        <span class="d-block">
                                            <?php  
                                            echo $heur_depart_avion1;    
                                            ?>
                                        </span>
                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_depart_avion1;
                                            echo "<br>";
                                            echo $annee_depart_avion1;
                                            ?>
                                        </span>

                                    </div><!-- /.left -->

                                    <div class="middle row">
                                        <div class="col-sm-12 text-center">Aller</div>
                                        <div class="col-sm-12">
                                            <img src="{{ secure_asset('img/go.png')}}" alt="vol logo" draggable="false">
                                        </div>
                                    </div><!-- /.middle -->
                                    <div class="right">

                                        <span class="d-block">
                                            <?php  
                                            echo $heur_minute_arrivee_avion1;    
                                            ?>
                                        </span>

                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_arrivee_avion1;
                                            echo "<br>";
                                            echo $annee_arrivee_avion1;
                                            ?>
                                        </span>
                                    </div><!-- /.rght -->
                                </div><!-- /.flight-time -->

                                <div class="col-sm-2 trip">

                                    <span class="d-block" style="font-size: 15px;"><i class="icofont-clock-time"></i>
                                        <?php 
                                            echo $time_avion1[0];
                                            echo "H";
                                            echo $time_avion1[1];
                                            echo "m";
                                            ?>
                                    </span>

                                    <span class="d-block">durée du vol</span>

                                </div><!-- /.trip -->
                            </div><!-- /.top-content -->
                            <!----------BUTTOM------------------>
                            <div class="col-12 bottom-content row px-0 mx-0">

                                <div class="col-sm-2 flight-logo">
                                    <img src="{{ secure_asset('storage/' . $vol2->image) }}" alt="vol logo" draggable="false">
                                </div><!-- /.flight-logo -->
                                @if($vol2->promotion_pourcentage > 0)
                                <div class="promotion">
                                    réduction de {{ $vol2->promotion_pourcentage }} %
                                </div><!-- /.inner-badge -->
                                @endif
                                <div class="col-sm-4 pricing text-center">
                                    <p>{{$vol2->nom_avion}} | {{$vol2->aeroport_arrivee}}</p>
                                    <p>{{$vol2->lieu_arrivee}}</p>
                                </div><!-- /.pricing -->
                                <div class="col-sm-4 px-0 flight-time d-flex justify-content-between align-items-lg-center">
                                    <div class="left">
                                        <span class="d-block">
                                            <?php  
                                            echo $heur_minute_arrivee2_avion1;   
                                            ?>
                                        </span>
                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_arrivee2_avion1;
                                            echo "<br>";
                                            echo $annee_arrivee2_avion1;
                                            ?>
                                        </span>

                                    </div><!-- /.left -->

                                    <div class=" middle">
                                        <div class="col-sm-12 text-center">Retour</div>
                                        <div class="col-sm-12">
                                            <img src="{{ secure_asset('img/back.png')}}" alt="vol logo" draggable="false">
                                        </div>
                                    </div><!-- /.middle -->
                                    <div class="right">

                                        <span class="d-block">
                                            <?php  
                                            echo  $heur_depart2_avion1;   
                                            ?>
                                        </span>

                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_depart2_avion1;
                                            echo "<br>";
                                            echo $annee_depart2_avion1;
                                            ?>
                                        </span>
                                    </div><!-- /.rght -->
                                </div><!-- /.flight-time -->

                                <div class="col-sm-2 trip">

                                    <span class="d-block" style="font-size: 15px;"><i class="icofont-clock-time"></i>
                                        <?php 
                                        echo $time_avion1[0];
                                        echo "H";
                                        echo $time_avion1[1];
                                        echo "m";
                                        ?>
                                    </span>

                                    <span class="d-block">durée du vol</span>
                            
                                </div>
                            </div>
                            <div class="col-12 bottom-content row px-0 mx-0" style="background-color: #f9f9ff;">
                                <div class="inner_shadow"></div>
                            </div>
                            <!----------UPPER------------------>
                            <div class="col-12 row px-0 mx-0">
                                <div class="col-sm-2 flight-logo">
                                    <img src="{{ secure_asset('storage/' . $vol->image) }}" alt="vol logo" draggable="false">
                                </div><!-- /.flight-logo -->
                                @if($vol->promotion_pourcentage > 0)
                                <div class="promotion">
                                    réduction de {{ $vol->promotion_pourcentage }} %
                                </div><!-- /.inner-badge -->
                                @endif
                                <div class="col-sm-4 pricing text-center">
                                    <p>{{$vol->nom_avion}} | {{$vol->aeroport_depart}}</p>
                                    <p>{{$vol->lieu_depart}}</p>
                                </div><!-- /.pricing -->
                                <div class="col-sm-4 px-0 flight-time d-flex justify-content-between align-items-lg-center">
                                    <div class="left">
                                        <span class="d-block">
                                            <?php  
                                            echo $heur_depart    
                                            ?>
                                        </span>
                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_depart;
                                            echo "<br>";
                                            echo $annee_depart;
                                            ?>
                                        </span>

                                    </div><!-- /.left -->

                                    <div class="middle row">
                                        <div class="col-sm-12 text-center">Aller</div>
                                        <div class="col-sm-12">
                                            <img src="{{ secure_asset('img/go.png')}}" alt="vol logo" draggable="false">
                                        </div>
                                    </div><!-- /.middle -->
                                    <div class="right">

                                        <span class="d-block">
                                            <?php  
                                            echo $heur_minute_arrivee    
                                            ?>
                                        </span>

                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_arrivee;
                                            echo "<br>";
                                            echo $annee_arrivee;
                                            ?>
                                        </span>
                                    </div><!-- /.rght -->
                                </div><!-- /.flight-time -->

                                <div class="col-sm-2 trip">

                                    <span class="d-block" style="font-size: 15px;"><i class="icofont-clock-time"></i>
                                        <?php 
                                            echo $time[0];
                                            echo "H";
                                            echo $time[1];
                                            echo "m";
                                            ?>
                                    </span>

                                    <span class="d-block">durée du vol</span>

                                </div><!-- /.trip -->
                            </div><!-- /.top-content -->
                            <!----------BUTTOM------------------>
                            <div class="col-12 bottom-content row px-0 mx-0">

                                <div class="col-sm-2 flight-logo">
                                    <img src="{{ secure_asset('storage/' . $vol->image) }}" alt="vol logo" draggable="false">
                                </div><!-- /.flight-logo -->
                                @if($vol->promotion_pourcentage > 0)
                                <div class="promotion">
                                    réduction de {{ $vol->promotion_pourcentage }} %
                                </div><!-- /.inner-badge -->
                                @endif
                                <div class="col-sm-4 pricing text-center">
                                    <p>{{$vol->nom_avion}} | {{$vol->aeroport_arrivee}}</p>
                                    <p>{{$vol->lieu_arrivee}}</p>
                                </div><!-- /.pricing -->
                                <div class="col-sm-4 px-0 flight-time d-flex justify-content-between align-items-lg-center">
                                    <div class="left">
                                        <span class="d-block">
                                            <?php  
                                            echo $heur_minute_arrivee2   
                                            ?>
                                        </span>
                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_arrivee2;
                                            echo "<br>";
                                            echo $annee_arrivee2;
                                            ?>
                                        </span>

                                    </div><!-- /.left -->

                                    <div class=" middle">
                                        <div class="col-sm-12 text-center">Retour</div>
                                        <div class="col-sm-12">
                                            <img src="{{ secure_asset('img/back.png')}}" alt="vol logo" draggable="false">
                                        </div>
                                    </div><!-- /.middle -->
                                    <div class="right">

                                        <span class="d-block">
                                            <?php  
                                            echo  $heur_depart2   
                                            ?>
                                        </span>

                                        <span class="d-block">
                                            <?php  
                                            echo $jour_mois_depart2;
                                            echo "<br>";
                                            echo $annee_depart2;
                                            ?>
                                        </span>
                                    </div><!-- /.rght -->
                                </div><!-- /.flight-time -->

                                <div class="col-sm-2 trip">

                                    <span class="d-block" style="font-size: 15px;"><i class="icofont-clock-time"></i>
                                        <?php 
                                        echo $time[0];
                                        echo "H";
                                        echo $time[1];
                                        echo "m";
                                        ?>
                                    </span>

                                    <span class="d-block">durée du vol</span>

                                </div><!-- /.trip -->
                            </div>
                        </div>
                        
                         <!----------DETAILS------------------>
                        <div class="colflight-list-box rt-mb-30 pt-30 container mx-0 collapse" id="{{($vol->id+33)}}" style="width: 100%;">
                            <div style="display: flex;">
                                <div class="col-lg-6">
                                    <p style="padding-left: 4%;">
                                        <span> {{$vol->nom_avion}} </span>
                                        <span><i class="icofont-clock-time"></i>
                                            <?php 
                                                echo $time[0];
                                                echo "H";
                                                echo $time[1];
                                                echo "m";
                                                ?>
                                        </span>
                                    </p>
                                    <div>Départ</div>
                                    <ul class="flight-timeline" style="width: 100%;padding-left: 4%;">
                                        <li class="d-block">
                                            <span><?php echo date("M j,  H:i  ", strtotime( $vol->date_depart )); ?></span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol->aeroport_depart}}</span></li>
                                        <li class="d-block">
                                            <span><?php 
                                                    echo $jour_mois_arrivee;
                                                    echo "  ";
                                                    echo $heur_minute_arrivee;
                                                    ?>

                                            </span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol->aeroport_arrivee }}</span></li>
                                    </ul>
                                    <br>
                                    <div>Retour</div>
                                    <ul class="flight-timeline" style="width: 100%;padding-left: 4%;">
                                        <li class="d-block">
                                            <span><?php echo date("M j,  H:i  ", strtotime( $vol->date_retour )); ?></span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol->aeroport_depart}}</span></li>
                                        <li class="d-block">
                                            <span>
                                                <?php 
                                                    echo $jour_mois_arrivee2;
                                                    echo "  ";
                                                    echo $heur_minute_arrivee2;
                                                    ?>

                                            </span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol->aeroport_arrivee }}</span></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <p style="padding-left: 4%;">
                                        <span> {{$vol2->nom_avion}} </span>
                                        <span><i class="icofont-clock-time"></i>
                                            <?php 
                                                echo $time_avion1[0];
                                                echo "H";
                                                echo $time_avion1[1];
                                                echo "m";
                                                ?>
                                        </span>
                                    </p>
                                    <div>Départ</div>
                                    <ul class="flight-timeline" style="width: 100%;padding-left: 4%;">
                                        <li class="d-block">
                                            <span><?php echo date("M j,  H:i  ", strtotime( $vol2->date_depart )); ?></span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol2->aeroport_depart}}</span></li>
                                        <li class="d-block">
                                            <span><?php 
                                                    echo $jour_mois_arrivee_avion1;
                                                    echo "  ";
                                                    echo $heur_minute_arrivee_avion1;
                                                    ?>

                                            </span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol2->aeroport_arrivee }}</span></li>
                                    </ul>
                                    <br>
                                    <div>Retour</div>
                                    <ul class="flight-timeline" style="width: 100%;padding-left: 4%;">
                                        <li class="d-block">
                                            <span><?php echo date("M j,  H:i  ", strtotime( $vol2->date_retour )); ?></span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol2->aeroport_depart}}</span></li>
                                        <li class="d-block">
                                            <span>
                                                <?php 
                                                    echo $jour_mois_arrivee2_avion1;
                                                    echo "  ";
                                                    echo $heur_minute_arrivee2_avion1;
                                                    ?>

                                            </span>

                                        </li>
                                        <li class="d-block"><span>{{ $vol2->aeroport_arrivee }}</span></li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flight-list-box rt-mb-30 pt-30 container mx-auto" style="width: 100%;">
                   <div class="flight-detils float-left">
                       <span class="d-block " style="font-size: 18px; font-weight: 600;color: #ffab53;">
                           <a href="#{{($vol->id+33)}}" class="flt-d-clic review" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{($vol->id+33)}}">Détails du vol
                               <i class="icofont-simple-down"></i>
                           </a>
                       </span>
                   </div><!-- /.flight-detils -->
                   <div class="collapse bottom-content " id="{{($vol->id+33)}}" >
                    <div class="row col-12 ">
                      <div class="col-8">
                          <p style="padding-left: 4%;">
                            <span> {{$vol->nom_avion}} </span> 
                            <span><i class="icofont-clock-time"></i>
                                <?php 
                                        echo $time[0];
                                        echo "H";
                                        echo $time[1];
                                        echo "m";
                                ?>
                            </span>
                        </p>
                        <div>Départ</div>

                        <ul class="flight-timeline" style="width: 100%;padding-left: 4%;">
                            <li class="d-block">
                                <span><?php echo date("M j,  H:i  ", strtotime( $vol->date_depart )); ?></span>

                            </li>
                            <li class="d-block"><span>{{ $vol->aeroport_depart}}</span></li>
                            <li class="d-block">
                                <span><?php 
                                            echo $jour_mois_arrivee;
                                            echo "  ";
                                            echo $heur_minute_arrivee;
                                    ?>

                                </span>

                            </li>
                            <li class="d-block"><span>{{ $vol->aeroport_arrivee }}</span></li>


                        </ul>
                        <br>
                        <div>Retour</div>
                        <ul class="flight-timeline" style="width: 100%;padding-left: 4%;">
                            <li class="d-block">
                                <span><?php echo date("M j,  H:i  ", strtotime( $vol->date_retour )); ?></span>

                            </li>
                            <li class="d-block"><span>{{ $vol->aeroport_depart}}</span></li>
                            <li class="d-block">
                                <span>
                                    <?php 
                                            echo $jour_mois_arrivee2;
                                            echo "  ";
                                            echo $heur_minute_arrivee2;
                                    ?>

                                </span>

                            </li>
                            <li class="d-block"><span>{{ $vol->aeroport_arrivee }}</span></li>


                        </ul>

                       </div>
                      @if($vol->images)
                       <div class="col-4">
                        
                        <img src="{{ secure_asset('storage/' . $vol->image)}}" alt="image vol" id="mainImage" class="rt-border-primary2">
                            <div class="mt-2">
                                <img class="img-thumbnail" src="{{ secure_asset('storage/' . $vol->image) }}"  width="50" >
                                    @foreach (json_decode($vol->images, true) as $image)
                                        <img src="{{secure_asset('storage/' . $image)}}" width="50" class="img-thumbnail">
                                    @endforeach
                            </div>
                        </div>
                       @endif

                      </div>
                   </div><!-- /.bottom content -->

                </div><!-- /.flt-dtls-box -->


                <script type="text/javascript">
                           var mainImage = document.querySelector('#mainImage');
                           var thumbnails = document.querySelectorAll('.img-thumbnail');
                          thumbnails.forEach((element) => element.addEventListener('click', changeImage));
                          function changeImage(e) {
                            mainImage.src = this.src;
                          }
                </script>
                
           <!------CHOISIR PLACE VOL--------->
            @include('vols.showEscaleVol2')

            <!------CHOISIR PLACE VOL--------->
            @include('vols.showEscaleVol1')
            
            

            <div  class="flight-list-box rt-mb-30 pt-30 container mx-auto">
                <div class="row">
                    <div class="col-md-6">Prix total des lieux sélectionnés</div>
                    <div id="the_total" class="col-md-6" style="font-size: 22px;font-weight: 600;color: #f8b600;">
                            @if(session('currency') == "dzd")
                            0,00 DA
                            @elseif(session('currency') == "eur")
                            0,00 €
                            @elseif(session('currency') == "gbp")
                            0,00 £
                            @elseif(session('currency') == "usd")
                            0,00 $
                            @endif
                    </div>
                </div>
            </div>

            @auth
            <div class="flight-list-box rt-mb-30 pt-30" id="reserver">
                    <h4 class="f-size-24 text-capitalize rt-mb-30  rt-semiblod">Mes Informations</h4>
                    <h6 class="text-333 rt-medium">Veuillez entrer vos informations <br> pour vos nouveaux billets de réservation</h6>
                    <br>
                    <br>
                    <script type="text/javascript">
                       
                    </script>


                <form action="{{ route('paiement.index') }}" id="payment-form"  class="rt-form rt-line-form flight-lable">
                    
                    <input type="hidden" name="product_id" value="{{$vol->id}}">
                    <input type="hidden" name="product2_id" value="{{$vol2->id}}">
                    <input type="hidden" name="product_type" value="places">
                    <!-- <input type="hidden" id="nb_jour" name="jour_reserves" > -->
                    <input type="hidden" id="seats_request" name="seats_request" required>
                    <input type="hidden" id="seats_request_vol2" name="seats_request_vol2" required>


                    <div class="row">
                        <div class="col-md-2 rt-mb-30">
                            <label for="select-1"></label>
                            <select id="select-1" name="etat_personne">
                                <option value="1" selected>M.</option>
                                <option value="2">Mme</option>
                                <option value="3">Mlle</option>
                                <option value="4">Dr</option>
                            </select>
                        </div><!-- /.col-md-6 -->
                        
                        <div class="col-md-5 rt-mb-30 mt-2">
                            <input type="name" pattern="^[a-zA-Z]{4,}(?: [a-zA-Z]+)?(?: [a-zA-Z]+)?$" class="form-control" id="fst-name" placeholder="Nom " name="nom" required>
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-5 rt-mb-30 mt-2">
                            <input type="text" pattern="^[a-zA-Z]{4,}(?: [a-zA-Z]+)?(?: [a-zA-Z]+)?$" class="form-control" id="lst-name" placeholder="Prénoms " name="prenom" required>
                        </div><!-- /.col-md-6 -->

                        <div class="col-md-6">

                            <input id="email" type="email" pattern="[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,3}" placeholder="email@email.com" class="form-control" name="email" value="{{Auth::user()->email }}" required>
                            <span id="searchclear" class="glyphicon glyphicon-remove-circle fa fa-times-circle-o" onclick="clear_email()"></span>

                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 rt-mb-30">
                            <input type="text" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" placeholder="telephone" class="form-control" name="telephone" required>
                        </div><!-- /.col-md-6 -->

                    </div><!-- /.row -->
                    
                    <script type="text/javascript">
                        function clear_email() {
                            document.getElementById('email').value = '';
                            document.getElementById('searchclear').style.display = "none";
                        }
                    </script>

                    <div class="col-md-12 mt-5">
                        <div class="row">
                            <div class="col-md-12 ">

                                <button class="rt-btn rt-gradient3 pill btn rt-sm2 btn-warning btn-lg text-light px-5 mr-5" style="float: right;" id="submit" onclick="getDays()">Payer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.flight-list-box -->
            @endauth

               @guest
                <div class="flight-list-box rt-mb-30 pt-30 text-light bg-warning container">
                    <h4 class="f-size-24">Connecter vous pour effectuer cette réservation</h4>
                </div><!-- /.flt-dtls-box -->
                       @endguest
            </div><!-- /.col-lg-9 -->
            </div>



            @section('extra-js')
            <script type="text/javascript">
                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            @endsection

        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
@endsection



@section('extra-js')

    <script>
        var mainImage = document.querySelector('#mainImage');
        var thumbnails = document.querySelectorAll('.img-thumbnail');
        thumbnails.forEach((element) => element.addEventListener('click', changeImage));
        function changeImage(e) {
          mainImage.src = this.src;
        }
        
                        

  </script>


@endsection