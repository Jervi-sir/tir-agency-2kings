

@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Vol > ticket</title>
@endsection

@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Mon ticket
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mx-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('hotels.index') }}" class="ml-3"> Réservations</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->
@endsection



@section('extra-script')

    <script src="{{ secure_asset('js/qrcode.js')}}"></script>
    <script src="{{ secure_asset('js/JsBarcode.all.min.js')}}"></script>

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

    $nom_avion = explode(' - ', $vol->nom_avion);       //if request is from vol show page


 ?>

<section class="content-area my-5">

    <div class="container">
       <div class="row">
           <div class="flt-dtls-box rt-mb-30 mx-auto">
               <h3 >{{ $vol->titre }} </h3>
               <div class="flight-list-box pt-30 container row">
                   <div class="col row">
                       <div class="col-12 top-content d-flex flex-lg-row flex-column align-items-lg-center justify-content-left  justify-content-lg-between">
                           <div class="flight-logo">
                                  <img src="{{ secure_asset('storage/' . $vol->image) }}" alt="ligne logo" draggable="false">
                                </div><!-- /.flight-logo -->
                                 <div class="pricing">
                                    <p>{{$vol->nom_avion}} | {{$vol->aeroport_depart}}</p>
                                    <p>{{$vol->lieu_depart}}</p>
                            </div><!-- /.pricing -->

                           <div class="flight-time d-flex justify-content-between align-items-lg-center">
                               <div class="left" style="left:54%;top: 30%;">
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

                               </div><!-- /.left1 -->
                               <div class="middle">
                                    <div class="col-sm-12 text-center">Aller</div>
                                   <img src="{{ secure_asset('img/go.png')}}" alt="time shape" draggable="false">
                               </div><!-- /.middle -->
                               <div class="right" style="top: 30%;right: 19%;">
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
                           <div class="trip">
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

                       <div class="col-12 bottom-content top-content d-flex flex-lg-row flex-column align-items-lg-center justify-content-left  justify-content-lg-between">
                           <div class="flight-logo">
                               <img src="{{secure_asset('storage/'.$vol->image  ) }}" alt="flt logo" draggable="false">
                           </div><!-- /.flight-logo -->
                            <div class="pricing">
                                      <p>{{$vol->nom_avion}} | {{$vol->aeroport_arrivee}}</p>
                                      <p>{{$vol->lieu_arrivee}}</p>
                            </div><!-- /.pricing -->
                           <div class="flight-time d-flex justify-content-between align-items-lg-center">
                               <div class="left" style="left:54%;top: 30%;">
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
                               </div><!-- /.left1 -->
                               <div class="middle">
                                   <div class="col-sm-12 text-center">Retour</div>
                                   <img src="{{ secure_asset('img/back.png')}}" alt="time shape" draggable="false">
                               </div><!-- /.middle -->
                               <div class="right" style="top: 30%;right: 19%;">
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
                           <div class="trip">
                               <span class="d-block" style="font-size: 15px;"><i class="icofont-clock-time"></i>
                                          <?php 
                                            echo $time[0];
                                            echo "H";
                                            echo $time[1];
                                            echo "m";
                                         ?></span>

                               <span class="d-block">durée du vol</span>
                           </div><!-- /.trip -->
                       </div>
                   </div><!-- /.bottom-content -->
               </div><!-- /.flight-box -->
           </div><!-- /.flt-dtls-box -->    
       </div>
       <div class="row">
            <div class="flight-list-box rt-mb-30 pt-30  mx-auto" style="width: 72%;left: -1%;">
               <div class="flight-detils float-left">
                   <span class="d-block " style="font-size: 18px; font-weight: 600;color: #ffab53;">
                       <a href="#{{($vol->id+33)}}" class="flt-d-clic review" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{($vol->id+33)}}">Details du vol
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
      </div>


        <div class="row" style="user-select: none;">

            <div class="box" id="ticket-print">
                <div class="ticket">
                    <span class="airline">{{ $vol->titre }}</span>
                    <span class="airline airlineslip">
                      <?php echo $nom_avion[1] ?>
                      <img src="{{secure_asset('storage/'.$vol->image)}}" width="20%" style="transform: translate(16px, -6px);">
                    </span>
                    <span class="boarding">{{\App\Agence::first()->nom_agence}}</span>
                    <div class="content">
                      <span class="jfk">
                        <div class="col-6">{{ $vol->aeroport_depart}}</div>
                      </span>
                      <span class="plane"><?xml version="1.0" ?><svg clip-rule="evenodd" fill-rule="evenodd" height="60" width="60" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"><g stroke="#222"><line fill="none" stroke-linecap="round" stroke-width="30" x1="300" x2="55" y1="390" y2="390"/><path d="M98 325c-9 10 10 16 25 6l311-156c24-17 35-25 42-50 2-15-46-11-78-7-15 1-34 10-42 16l-56 35 1-1-169-31c-14-3-24-5-37-1-10 5-18 10-27 18l122 72c4 3 5 7 1 9l-44 27-75-15c-10-2-18-4-28 0-8 4-14 9-20 15l74 63z" fill="#222" stroke-linejoin="round" stroke-width="10"/></g></svg></span>
                      <span class="sfo">
                        <div class="col-6">{{ $vol->aeroport_arrivee}}</div>
                      </span>
                      
                      <span class="jfk1 jfkslip">
                        <div class="col-6">{{ $vol->aeroport_depart}}</div>
                      </span>
                      <span class="plane1 planeslip"><?xml version="1.0" ?><svg clip-rule="evenodd" fill-rule="evenodd" height="50" width="50" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"><g stroke="#222"><line fill="none" stroke-linecap="round" stroke-width="30" x1="300" x2="55" y1="390" y2="390"/><path d="M98 325c-9 10 10 16 25 6l311-156c24-17 35-25 42-50 2-15-46-11-78-7-15 1-34 10-42 16l-56 35 1-1-169-31c-14-3-24-5-37-1-10 5-18 10-27 18l122 72c4 3 5 7 1 9l-44 27-75-15c-10-2-18-4-28 0-8 4-14 9-20 15l74 63z" fill="#222" stroke-linejoin="round" stroke-width="10"/></g></svg></span>
                      <span class="sfo1 sfoslip">
                        <div class="col-6">{{ $vol->aeroport_arrivee}}</div>
                      </span>
                      <div class="sub-content">
                        <span class="watermark ">GACEM'AYMEN</span>

                        <span class="name">NON DU PASSAGER<br><span>{{$order->nom}}, {{$order->prenom}}</span></span>

                        <span class="flight">NOM D'AVION<br><span><?php echo $nom_avion[0] ?></span></span>
                        <span class="seat"  style="left: 49%;">N&deg; du SIÈGE<br><span>{{ $place->code_place }}</span></span>
                        <span class="boardingtime">DATE ET HEURE D'ALLER<br><span>{{$vol->date_depart}}</span></span>
                        <span class="boardingtime1">DATE ET HEURE DU RETOUR<br><span>{{$vol->date_depart}}</span></span>
                            
                         <span class="flight flightslip">NOM D'AVION<br><span><?php echo $nom_avion[0] ?></span></span>
                          <span class="seat seatslip">N&deg; du SIÈGE<br><span>{{ $place->code_place }}</span></span>
                         <span class="name nameslip">NON DU PASSAGER<br><span>{{$order->nom}}, {{$order->prenom}}</span></span>
                      </div>
                    </div>
                    <input id="text" type="hidden" value="{{$order->code_reservation}}"/>
                    <input id="text2" type="hidden" value="{{$order->code_reservation}}"/>
                    <div id="qrcode" class="barcode"></div>
                    <div id="qrcode2" class="barcode slip"></div>
                  </div>
            </div>
        </div>

        <div class="row col-12">
        <button type="button" class="btn btn-outline-warning d-inline-block mx-auto print-button mb-5 mt-5" onclick="printDiv('ticket-print')">Imprimer mon Ticket</button>
      </div>

    </div>
</section>

@endsection


@section('extra-js')


<script type="text/javascript">

    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 70,
        height : 70
    });
    var qrcode2 = new QRCode(document.getElementById("qrcode2"), {
            width : 70,
            height : 70
        });

    function makeCode () 
    {      
        var elText = document.getElementById("text");
        var elText2 = document.getElementById("text2");
        
        qrcode.makeCode(elText.value);
        qrcode2.makeCode(elText2.value);
    }

    makeCode();

    $("#text").
        on("blur", function () 
        {
            makeCode();
        }).
        on("keydown", function (e) 
        {
            if (e.keyCode == 13) 
            {
                makeCode();
            }
        });
    $("#text2").
            on("blur", function () 
            {
                makeCode();
            }).
            on("keydown", function (e) 
            {
                if (e.keyCode == 13) 
                {
                    makeCode();
                }
            });


 function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

       // JsBarcode("#barcode", "12355566");

</script>

@endsection


@section('extra-style')

<style type="text/css">

    .print-button {
    width: 53%;
    /*margin-left: 42%;*/
  }
    .box{
      position: relative;
      top: calc(50% - 125px);
      top: -webkit-calc(50% - 125px);
      left: calc(50% - 300px);
      left: -webkit-calc(50% - 300px);
    }

    .ticket{
      width: 618px;
      height: 251px;
      background: #FFB300;
      border-radius: 3px;
      box-shadow: 0 0 100px #aaa;
      border-top: 1px solid #E89F3D;
      border-bottom: 1px solid #E89F3D;
    }

    /*.left1{
      margin: 0;
      padding: 0;
      list-style: none;
      position: absolute;
      top: 0px;
      left: -5px;
    }

    .left1 li{
      width: 0px;
      height: 0px;
    }

    .left1 li:nth-child(-n+2){
      margin-top: 8px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #FFB300;
    }

    .left1 li:nth-child(3),
    .left1 li:nth-child(6){
      margin-top: 8px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #EEEEEE;
    }

    .left1 li:nth-child(4){
      margin-top: 8px;
      margin-left: 2px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #EEEEEE;
    }

    .left1 li:nth-child(5){
      margin-top: 8px;
      margin-left: -1px;
      border-top: 6px solid transparent;
      border-bottom: 6px solid transparent; 
      border-right: 6px solid #EEEEEE;
    }

    .left1 li:nth-child(7),
    .left1 li:nth-child(9),
    .left1 li:nth-child(11),
    .left1 li:nth-child(12){
      margin-top: 7px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #E5E5E5;
    }

    .left1 li:nth-child(8){
      margin-top: 7px;
      margin-left: 2px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #E5E5E5;
    }

    .left1 li:nth-child(10){
      margin-top: 7px;
      margin-left: 1px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #E5E5E5;
    }

    .left1 li:nth-child(13){
      margin-top: 7px;
      margin-left: 2px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #FFB300;
    }

    .left1 li:nth-child(14){
      margin-top: 7px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-right: 5px solid #FFB300;
    }*/

   /* .right1{
      margin: 0;
      padding: 0;
      list-style: none;
      position: absolute;
      top: 0px;
      right: -5px;
    }

    .right1 li:nth-child(-n+2){
      margin-top: 8px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-left: 5px solid #FFB300;
    }

    .right1 li:nth-child(3),
    .right1 li:nth-child(4),
    .right1 li:nth-child(6){
      margin-top: 8px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-left: 5px solid #EEEEEE;
    }

    .right1 li:nth-child(5){
      margin-top: 8px;
      margin-left: -2px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-left: 5px solid #EEEEEE;
    }

    .right1 li:nth-child(8),
    .right1 li:nth-child(9),
    .right1 li:nth-child(11){
      margin-top: 7px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-left: 5px solid #E5E5E5;
    }

    .right1 li:nth-child(7){
      margin-top: 7px;
      margin-left: -3px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-left: 5px solid #E5E5E5;
    }

    .right1 li:nth-child(10){
      margin-top: 7px;
      margin-left: -2px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-left: 5px solid #E5E5E5;
    }

    .right1 li:nth-child(12){
      margin-top: 7px;
      border-top: 6px solid transparent;
      border-bottom: 6px solid transparent; 
      border-left: 6px solid #E5E5E5;
    }

    .right1 li:nth-child(13),
    .right1 li:nth-child(14){
      margin-top: 7px;
      border-top: 5px solid transparent;
      border-bottom: 5px solid transparent; 
      border-left: 5px solid #FFB300;
    }*/

    .ticket:after{
      content: '';
      position: absolute;
      right: 217px;
      top: 0px;
      width: 2px;
      height: 250px;
      box-shadow: inset 0 0 0 #FFB300,
        inset 0 -10px 0 #B56E0A,
        inset 0 -20px 0 #FFB300,
        inset 0 -30px 0 #B56E0A,
        inset 0 -40px 0 #FFB300,
        inset 0 -50px 0 #999999,
        inset 0 -60px 0 #E5E5E5,
        inset 0 -70px 0 #999999,
        inset 0 -80px 0 #E5E5E5,
        inset 0 -90px 0 #999999,
        inset 0 -100px 0 #E5E5E5,
        inset 0 -110px 0 #999999,
        inset 0 -120px 0 #E5E5E5,
        inset 0 -130px 0 #999999,
        inset 0 -140px 0 #E5E5E5,
        inset 0 -150px 0 #B0B0B0,
        inset 0 -160px 0 #EEEEEE,
        inset 0 -170px 0 #B0B0B0,
        inset 0 -180px 0 #EEEEEE,
        inset 0 -190px 0 #B0B0B0,
        inset 0 -200px 0 #EEEEEE,
        inset 0 -210px 0 #B0B0B0,
        inset 0 -220px 0 #FFB300,
        inset 0 -230px 0 #B56E0A,
        inset 0 -240px 0 #FFB300,
        inset 0 -250px 0 #B56E0A;
    }

    .ticket:before{
      content: '';
      position: absolute;
      z-index: 5;
      right: 216px;
      top: 0px;
      width: 1px;
      height: 250px;
      box-shadow: inset 0 0 0 #FFB300,
        inset 0 -10px 0 #F4D483,
        inset 0 -20px 0 #FFB300,
        inset 0 -30px 0 #F4D483,
        inset 0 -40px 0 #FFB300,
        inset 0 -50px 0 #FFFFFF,
        inset 0 -60px 0 #E5E5E5,
        inset 0 -70px 0 #FFFFFF,
        inset 0 -80px 0 #E5E5E5,
        inset 0 -90px 0 #FFFFFF,
        inset 0 -100px 0 #E5E5E5,
        inset 0 -110px 0 #FFFFFF,
        inset 0 -120px 0 #E5E5E5,
        inset 0 -130px 0 #FFFFFF,
        inset 0 -140px 0 #E5E5E5,
        inset 0 -150px 0 #FFFFFF,
        inset 0 -160px 0 #EEEEEE,
        inset 0 -170px 0 #FFFFFF,
        inset 0 -180px 0 #EEEEEE,
        inset 0 -190px 0 #FFFFFF,
        inset 0 -200px 0 #EEEEEE,
        inset 0 -210px 0 #FFFFFF,
        inset 0 -220px 0 #FFB300,
        inset 0 -230px 0 #F4D483,
        inset 0 -240px 0 #FFB300,
        inset 0 -250px 0 #F4D483;
    }

    .content{
      position: absolute;
      top: 40px;
      width: 100%;
      height: 205px;
      background: #e5e5e5;
    }

    .airline{
      position: absolute;
      top: 10px;
      left: 10px;
      font-family: Arial;
      font-size: 20px;
      font-weight: bold;
      color: rgba(0,0,102,1);
    }

    .boarding{
      position: absolute;
      top: 10px;
      right: 249px;
      font-family: Arial;
      font-size: 18px;
      color: rgba(255,255,255,0.6);
    }

    .jfk{
      position: absolute;
      top: 10px;
      left: 20px;
      font-family: Arial;
      font-size: 15px;
      color: #222;
      transform: translate(-5%, -4%);
      z-index: 100;
      font-weight: 700;
    }

    .jfk1{
      position: absolute;
      top: 10px;
      left: 20px;
      font-family: Arial;
      font-size: 14px;
      color: #222;
      transform: translate(-5%, -4%);
      z-index: 100;
      font-weight: 600;
      line-height: 1;

    }

    .sfo{
      position: absolute;
      top: 10px;
      left: 180px;
      font-family: Arial;
      font-size: 15px;
      color: #222;
      transform: translate(42%, -4%);
      z-index: 100;
      font-weight: 700;
    }

    .sfo1{
      position: absolute;
      top: 10px;
      left: 180px;
      font-family: Arial;
      font-size: 14px;
      color: #222;
      transform: translate(42%, -4%);
      z-index: 100;
      font-weight: 600;
      line-height: 1;
    }

    .plane{
      position: absolute;
      /*left: 105px;*/
      top: 0px;
      z-index: 10;
      transform: translate(314px, -5px) scaleX(-1);
      font-size: 10px;
    }

    .plane1{
      position: absolute;
      /* left: 105px; */
      top: 0px;
      z-index: 10;
      transform: translate(-24px, 6px) scaleX(1);
      font-size: 5px;
    }


    .sub-content{
      background: #e5e5e5;
      width: 100%;
      height: 100px;
      position: absolute;
      top: 70px;
    }

    .watermark{
      position: relative;
      left: 5px;
      top: -10px;
      font-family: Arial;
      font-size: 50px;
      font-weight: bold;
      color: rgba(255,255,255,0.2);
      user-select: text;

    }

    .name{
      position: absolute;
      top: 10px;
      left: 10px;
      font-family: Arial Narrow, Arial;
      font-weight: bold;
      font-size: 14px;
      color: #999;
    }

    .name span{
      color: #555;
      font-size: 17px;
    }

    .flight{
      position: absolute;
      top: 10px;
      left: 180px;
      font-family: Arial Narrow, Arial;
      font-weight: bold;
      font-size: 14px;
      color: #999;
    }

    .flight span{
      color: #555;
      font-size: 17px;
    }

    .gate{
      position: absolute;
      top: 10px;
      left: 280px;
      font-family: Arial Narrow, Arial;
      font-weight: bold;
      font-size: 14px;
      color: #999;
    }

    .gate span{
      color: #555;
      font-size: 17px;
    }


    .seat{
      position: absolute;
      top: 10px;
      left: 350px;
      font-family: Arial Narrow, Arial;
      font-weight: bold;
      font-size: 14px;
      color: #999;
    }

    .seat span{
      color: #555;
      font-size: 17px;
    }

    .boardingtime{
      position: absolute;
      top: 60px;
      left: 10px;
      font-family: Arial Narrow, Arial;
      font-weight: bold;
      font-size: 14px;
      color: #999;
    }

    .boardingtime span{
      color: #555;
      font-size: 17px;
    }

    .boardingtime1{
      position: absolute;
      top: 60px;
      left: 162px;
      font-family: Arial Narrow, Arial;
      font-weight: bold;
      font-size: 14px;
      color: #999;
    }

    .boardingtime1 span{
      color: #555;
      font-size: 17px;
    }

    .barcode{
      position: absolute;
      left: 326px;
      bottom: 46px;
      height: 30px;
      width: 90px;
    }

    .slip{
      left: 544px;
    }

    .nameslip{
      top: 60px;
      left: 410px;
    }

    .flightslip{
      left: 410px;
    }

    .seatslip{
      left: 540px;
    }

    .jfkslip{
      top: 20px;
      left: 410px;
    }

    .sfoslip{
      top: 20px;
      left: 440px;
    }

    .planeslip{
      top: 10px;
      left: 475px;
    }

    .airlineslip{
      left: 455px;
    }


</style>

@endsection
