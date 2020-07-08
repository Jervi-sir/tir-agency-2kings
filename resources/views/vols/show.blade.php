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


 ?>

<section class="content-area mt-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto col-lg-10 container row">

                <div class="flt-dtls-box rt-mb-30 ">
                    <div class="upper-top-content d-md-flex flex-md-row justify-content-md-between align-items-center">
                        <div class="left col-7">
                              <h3 >{{ $vol->titre }} </h3>
                            <span> <span>{{ $vol->ligne_arrivee }}</span>
                            <br>
                            <div class="row">
                              <div class="col-sm-6">
                                <p>{{ $vol->created_at->format('d/m/Y')  }}</p>
                              </div>
                              <div class="col-sm-6">
                                 @for ($i = 0;$i < $vol->etoiles;$i++)
                                <i class="fa fa-star review"></i>
                                @endfor
                              </div>
                            </div>
                        </div><!-- /.left -->
                        @if($vol->promotion_pourcentage > 0)
                          <div class="promotion">
                            réduction de {{ $vol->promotion_pourcentage }} %
                          </div><!-- /.inner-badge -->
                          @endif
                        <div class="col-5 row">
                          
                          <div class="col-6 " style="font-size: 14px;font-weight: bold;font-weight: 600;color: rgba(255, 220, 155, 0.79);">Prix d'une place</div>
                            <div style="font-family: 'Poppins', sans-serifs;font-size: 24px;font-weight: 600;color: rgba(255, 167, 0, 0.79);">
                              @if($vol->promotion_pourcentage != 0)
                              <strike class="col-6 mx-0 mb-2"  style="font-size:17px;">
                                {{getPriceHelper($vol->prix)}}
                              </strike>
                              @endif
                            <div class="mt-2" style="font-family: 'Poppins', sans-serifs;font-size: 24px;font-weight: 600;color: rgba(255, 167, 0, 0.79);">{{ getPriceHelper_Pourcentage($vol->prix,$vol->promotion_pourcentage)}}</div>
                          </div>
                        </div>
                    </div><!-- /.upper-top-content -->

                    <div class="flight-list-box rt-mb-30">
                        <div class="col row">
                            <div class="col-12 top-content d-flex flex-lg-row flex-column align-items-lg-center justify-content-left  justify-content-lg-between">
                                <div class="flight-logo">
                                  <img src="{{ asset('storage/' . $vol->image) }}" alt="ligne logo" draggable="false">
                                </div><!-- /.flight-logo -->
                                 <div class="pricing">
                                    <p>{{$vol->nom_avion}} | {{$vol->aeroport_depart}}</p>
                                    <p>{{$vol->lieu_depart}}</p>
                                </div><!-- /.pricing -->
                                <div class="flight-time d-flex justify-content-between align-items-lg-center">
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
                                          <img src="{{ asset('img/go.png')}}" alt="vol logo" draggable="false">
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
                                    <img src="{{ asset('storage/' . $vol->image) }}" alt="ligne logo" draggable="false">
                                  </div><!-- /.flight-logo -->
                                   <div class="pricing">
                                      <p>{{$vol->nom_avion}} | {{$vol->aeroport_arrivee}}</p>
                                      <p>{{$vol->lieu_arrivee}}</p>
                                  </div><!-- /.pricing -->
                                  <div class="flight-time d-flex justify-content-between align-items-lg-center">
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
                                      <div class="middle row">
                                        <div class="col-sm-12 text-center">Retour</div>
                                        <div class="col-sm-12">
                                            <img src="{{ asset('img/back.png')}}" alt="vol logo" draggable="false">
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

                        </div><!-- /.bottom-content -->


                    </div><!-- /.flight-box -->


                </div><!-- /.flt-dtls-box -->
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
                        
                        <img src="{{ asset('storage/' . $vol->image)}}" alt="image vol" id="mainImage" class="rt-border-primary2">
                            <div class="mt-2">
                                <img class="img-thumbnail" src="{{ asset('storage/' . $vol->image) }}"  width="50" >
                                    @foreach (json_decode($vol->images, true) as $image)
                                        <img src="{{asset('storage/' . $image)}}" width="50" class="img-thumbnail">
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
                <div class="flight-list-box rt-mb-30 pt-30 container row" style="left: 2%;">
                      <div class="left col-7 px-0">
                          <div class="col-12 text-lowercase" style="font-size: 20px;font-weight: 600;color: #ffab53;">
                            Veuillez Choisire vos Places
                          </div>
                          <div class="col-12 mt-1" style="bottom: -7%;">
                              <div class="rt-sidebar-group">
                                  <div class="rt-widget final-booking">

                                      <ul>
                                          <li class="clearfix">

                                              <span>Prix par place</span>
                                              <span class="float-right col-6 px-0">
                                                @if($vol->promotion_pourcentage != 0)
                                                <div class="col-12">
                                                  <strike style="float: right;">{{getPriceHelper($vol->prix)}}</strike>
                                                </div>
                                                <br>
                                                @endif
                                                <div class="col-12">
                                                  <div style="float: right;font-family: 'Poppins', sans-serifs;font-size: 20px;font-weight: 550;color: rgba(255, 167, 0, 0.79);">{{ getPriceHelper_Pourcentage($vol->prix,$vol->promotion_pourcentage)}}</div>
                                                </div>
                                              </span>  
                                          </li>
                                          <li class="clearfix">

                                              <span>Nombre de personne</span>
                                              <span class="float-right"><input type="number" value="3" id="nb_personne" min="1" max="6" onkeydown="return false"style="float: right;"></span>
                                          </li>
                                          <li class="clearfix">
                                              <span>Les places choisies</span>
                                              <span class="float-right"><div id="seats-div" style="color: #f8b600;font-weight: 600;"></div></span>
                                          </li>
                                          <li class="clearfix sub-total">
                                              <span>Total</span>

                                              @if(session('currency') == "dzd")
                                              <span class="float-right"><div id="total" >0 DA</div></span>
                                              @elseif(session('currency') == "eur")
                                              <span class="float-right"><div id="total" >0 €</div></span>
                                              @elseif(session('currency') == "gbp")
                                              <span class="float-right"><div id="total" >0 £</div></span>
                                              @elseif(session('currency') == "usd")
                                              <span class="float-right"><div id="total" >0 $</div></span>
                                              @endif

                                          </li>

                                      </ul>
                                  </div><!-- /.rt-widget -->
                                  <input type="hidden" id="currecy_used" value="{{session('currency')}}">
                    <div class="row">
                      <div class="col-6"></div>
                      <div class="col-6">
                        <div class="col-12">
                          <button type="button" class=" bg-success" data-toggle="tooltip" data-placement="top" >0</button>
                          Place Libre
                        </div>

                        <div class="col-12">
                          <button type="button" class=" bg-warning" data-toggle="tooltip" data-placement="top" >0</button>
                          Place choisie
                        </div>

                        <div class="col-12">
                          <button type="button" class=" bg-danger" data-toggle="tooltip" data-placement="top" >0</button>
                          Place occupée
                        </div>
                      </div>
                    </div>


                              </div><!-- /.rt-sidebar-group -->
                          </div><!-- /.col-lg-3 -->

                      </div>

                    <div class="right col-5" style="max-height: 30em;overflow-y: auto;overflow-x: hidden;width: 20em;background-color: #e2eaef69;border-radius: 4%; ">
                        <div class="row">
                            <div class="flight-detils mx-auto float-right">
                                <span class="d-block " style="font-size: 18px; font-weight: 600;color: #ffab53;">
                                    <a  class="flt-d-clic review right" data-toggle="collapse" role="button" aria-expanded="false" >Choisissez vos places
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2 mr-2">
                                <div class="row">
                                    <div class="col-12 ">__</div>
                                </div>
                                @foreach ($vol->places->chunk(6) as $chunk)
                                <div class="">
                                    <div class="seat-stye-row">
                                        <button class="btn-block" disabled="">{{$loop->iteration}}</button>
                                    </div>
                                </div>
                                @if($loop->index == 3 ||$loop->index == 13|| $loop->index == 33 )
                                        <div style="padding-top: 43%;padding-bottom: 40%;"></div>
                                    @endif
                                
                                @endforeach
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="seat-stye-column">A</div>
                                    <div class="seat-stye-column">B</div>
                                    <div class="seat-stye-column"></div>
                                    <div class="seat-stye-column">C</div>
                                    <div class="seat-stye-column">D</div>
                                    <div class="seat-stye-column"></div>
                                    <div class="seat-stye-column">E</div>
                                    <div class="seat-stye-column">F</div>
                                </div>
                                @foreach ($vol->places->sortBy('numero_place')->chunk(6) as $chunk)
                                <div class="row">
                                    @foreach ($chunk as $vol->places)
                                    <div class="seat-stye">

                                        @if($vol->places->occupee == 0)
                                        <button id="{{$vol->places->numero_place}}" type="button" class=" bg-success" data-toggle="tooltip" data-placement="top" title="Libre {{$vol->places->numero_place}}" onClick="reply_click(this.id)">0</button>
                                        @else
                                        <button type="button" class="bg-danger" disableddata-toggle="tooltip" data-placement="top" title="Occupee {{$vol->places->numero_place}}">0</button>
                                        @endif
                                        
                                    </div>
                                     @if($loop->index == 1 || $loop->index == 3 )
                                        __
                                    @endif
                                    @endforeach
                                    @if($loop->index == 3 || $loop->index == 13 || $loop->index == 33 )
                                        <br>.
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- /.left -->
                </div>
                <script type="text/javascript">
                        //get clicked ---> get its id -->check if it does exist in the array[done] 
                        //if doesnt exist , then push in array , make color to yellow bg-warning[done] 
                                //and show the whole array in the div[done] 
                        //else means it does exist, get its index then take it off the array with the index[done] 
                            //and make the background green and show the array in the div again[done] 
                    //make the spinner limits the seats chosen [done] 
                    //[[issue is when u decrease the spinner it will decrease , and seats selected wont stop it to decrease]]
                    
                        var seats = "33";
                        var arr = [];
                        var prix_palce;
                        var currency = document.getElementById("currecy_used").value;

                      function reply_click(clicked_id)
                      {
                                 if(!arr.includes(clicked_id))
                                 {
                                    if(arr.length < document.getElementById("nb_personne").value)
                                    {
                                        arr.push(clicked_id);
                                        document.getElementById(clicked_id).classList.remove("bg-success"); 
                                        document.getElementById(clicked_id).classList.add("bg-warning");
                                        seats = seats + clicked_id;

                                        var s = "";
                                        for(var i = 0; i < arr.length ; i++) 
                                        {
                                          s += arr[i] + " ";
                                        }

                                        document.getElementById("seats-div").innerHTML = arr;

                                        $.each(arr,function(i, arr){
                                            console.log(arr);
                                        });

                                        

                                        if(currency == "dzd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100))) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatDA(total_prix);
                                        }
                                        else if(currency == "eur")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00689505) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatEUR(total_prix);
                                        }
                                        else if(currency == "gbp")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00624130) !!};
                                          var total_prix = prix_palce * arr.length;

                                          document.getElementById("total").innerHTML = currencyFormatGBP(total_prix);
                                        }
                                        else if(currency == "usd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00771338) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatUSD(total_prix);
                                        }

                                    }   
                                }else
                                 {
                                    document.getElementById(clicked_id).classList.remove("bg-warning"); 
                                    document.getElementById(clicked_id).classList.add("bg-success");

                                     var index = arr.indexOf(clicked_id);
                                    arr.splice(index, 1);        
                                   seats = seats + clicked_id;

                                    var s = "";
                                    for(var i = 0; i < arr.length ; i++) 
                                    {
                                      s += arr[i] + " ";
                                    }

                                    document.getElementById("seats-div").innerHTML = arr;
                                 
                                    prix_palce = {!! json_encode($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) !!};
                                    var total_prix = prix_palce * arr.length;

                                        if(currency == "dzd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100))) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatDA(total_prix);
                                        }
                                        else if(currency == "eur")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00689505) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatEUR(total_prix);
                                        }
                                        else if(currency == "gbp")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00624130) !!};
                                          var total_prix = prix_palce * arr.length;

                                          document.getElementById("total").innerHTML = currencyFormatGBP(total_prix);
                                        }
                                        else if(currency == "usd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00771338) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatUSD(total_prix);
                                        }

                                }


                        } 


                        function getDays() {

                            var seats_send = document.getElementById("seats-div").innerHTML;
                            document.getElementById("seats_request").value = seats_send;

                            var get_days = document.getElementById("nb_personne").value;
                            document.getElementById("nb_jour").value = get_days;

                           
                        }
                </script>

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
                    <input type="hidden" name="product_type" value="places">
                    <!-- <input type="hidden" id="nb_jour" name="jour_reserves" > -->
                    <input type="hidden" id="seats_request" name="seats_request" required>


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