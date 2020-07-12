
@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Voiture > ticket</title>
@endsection

@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-voiture relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Mon ticket
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mr-3">accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('hotels.index') }}" class="ml-3"> Réservations</a></p>
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

<div class="container">
    <div class="row">
      <div class="flt-dtls-box mx-auto mt-5">

          <div class="upper-top-content d-md-flex flex-md-row justify-content-md-between align-items-center">
              <div class="left">
                  <span>details de la voiture</span>
              </div><!-- /.left -->
          </div><!-- /.upper-top-content -->
          <div class="flight-list-box rt-mb-30 mx-auto" style="width: 800px;">
              <div class="top-content d-flex flex-md-row flex-column justify-content-lg-between row">
                  <div class="car-thumb mr-4 mr-lg-0 mb-5 mb-md-0 col-md-4">
                      <img src="{{ secure_asset( $voiture->image) }}" alt="car image" id="mainImage" class="rt-border-primary2">
                  </div>
                  <div class="economy mb-5 mb-md-0 col-md-5">
                      <h5 class="f-size-16 rt-medium">{{ $voiture->titre }}</h5>
                      <span class="d-block f-size-13 text-555">{{ $voiture->portes }} portes</span>

                      <span class="badge rt-gradinet-badge pill rt-mr-10">{{ $voiture->etoiles}}<small>/5</small></span>
                      <span class="primary-color">
                          @if($voiture->etoiles >= 5) super
                          @elseif ($voiture->etoiles >= 3) Excellent
                          @else Satisfaisante
                          @endif
                      </span>
                      <span class="f-size-12 text-878"></span>
                      <span class="d-block f-size-13 text-555">ajoutée le : {{ $voiture->created_at->format('d/m/Y')  }}</span>
                      <span class="mt-2">
                          @if($voiture->images)
                          <img class="img-thumbnail" src="{{ secure_asset($voiture->image) }}"  width="50" >
                              @foreach (json_decode($voiture->images, true) as $image)
                                  <img src="{{secure_asset($image)}}" width="50" class="img-thumbnail">
                              @endforeach
                          @endif
                      </span>
                      <script>
                                var mainImage = document.querySelector('#mainImage');
                                var thumbnails = document.querySelectorAll('.img-thumbnail');
                                thumbnails.forEach((element) => element.addEventListener('click', changeImage));
                                function changeImage(e) {
                                  mainImage.src = this.src;
                                }

                      </script>


                  </div>

                  <div class="ck-list col-md-3">
                      <ul class="rt-list">
                          <li class="d-block"> {{ $voiture->nombre_places}} Places
                          </li>
                          <li class="d-block"> {{ $voiture->portes}} Portes
                          </li>
                          <li class="d-block"> Année {{ $voiture->annee}}
                          </li>
                          <li class="d-block " style="background-color: #faf2d8;"> {{ $voiture->type_voiture}}
                          </li>
                          <li class="d-block">
                          </li>
                      </ul><!-- /.rt-list -->
                  </div><!-- /.ck-list -->

              </div><!-- /.top-content -->
              <div class="bottom-content row">
                  <div class="single-discribe col-md-4">
                      <h3 class="f-size-16 rt-medium text-424 rt-mb-10"> Lieu d'emprunt</h3>
                      <p class="f-size-14 line-height-24 text-555">
                          {{ $voiture->lieu }}
                      </p>

                  </div><!-- /.single-discribe -->
                  <div class="single-discribe col-md-4">
                      <h3 class="f-size-16 rt-medium text-424 rt-mb-10">Inclus gratuitement</h3>
                      <ul class="rt-list">
                          <li class="d-block">
                              @if($voiture->electric)
                              <span class="text-primary rt-mr-3"><i class="fa fa-check-circle"></i> moteur electrique</span>
                              @else
                              <span class="primary-color rt-mr-3"><i class="fa fa-check-circle"></i> moteur fuel</span>
                              @endif
                          </li>
                          <li class="d-block">
                              @if($voiture->manuel)
                              <span class="primary-color rt-mr-3"><i class="fa fa-check-circle"></i> transmission manuellele</span>
                              @else
                              <span class="text-primary rt-mr-3"><i class="fa fa-check-circle"></i> transmission automatique</span>

                              @endif
                          </li>


                          <li class="d-block">
                              @if($voiture->climatiseur)
                              <span class="text-primary rt-mr-3"><i class="fa fa-check-circle"></i> avec climatiseur</span>
                              @else<span class=" rt-mr-3"><i class="fa fa-times-circle"></i> sans climatiseur</span>
                              @endif
                          </li>
                      </ul><!-- /.rt-list -->
                  </div><!-- /.single-discribe -->
                  <div class="single-discribe col-md-4">
                      <h3 class="f-size-16 rt-medium text-424 rt-mb-10">Inclus dans le prix:</h3>
                      <ul class="rt-list">
                          <li class="d-block">
                              @if($voiture->assurance)
                              <span class="text-success rt-mr-3"><i class="fa fa-check-circle"></i> avec assurance</span>
                              @else
                              <span class="text-danger rt-mr-3"><i class="fa fa-times-circle"></i> sans assurance</span>
                              @endif
                          </li>

                          <li class="d-block">
                              @if($voiture->km_illimite)
                              <span class="text-success rt-mr-3"><i class="fa fa-check-circle"></i> Kilométrage illimite</span>
                              @else<span class="text-danger rt-mr-3"><i class="fa fa-times-circle"></i> Kilométrage limite</span>
                              @endif
                          </li>
                          <li class="d-block">
                              @if($voiture->annulation)
                              <span class="text-success rt-mr-3"><i class="fa fa-check-circle"></i> annulation gratuite</span>

                              @else
                              <span class="text-danger rt-mr-3"><i class="fa fa-times-circle"></i> pas d'annulation</span>
                              @endif
                          </li>
                      </ul><!-- /.rt-list -->
                  </div><!-- /.single-discribe -->
              </div><!-- /.bottom-content -->
          </div><!-- /.flight-box -->

      </div>
    </div>
</div>

<div class="container" >
<h3 class="mt-4 theh3">Mon Ticket</h3>

<div class="container" id="ticket-print">
  <div class="row" >
    <div class="boarding-pass" style="height: 355px;margin-left: 22%;margin-right: 7%;">
        <header>
            <div class="flight left">
              <div class="row">
                <small>ticket pour</small>
                <strong class="ml-4">{{$voiture->titre}}</strong>
                </div>
            </div>
            <div class="flight right">
                <strong>{{ \App\Agence::first()->nom_agence}}</strong>
            </div>
        </header>
        <section class="cities row">
          
                        
            <div class="city col-4">
                  <img src="{{ secure_asset( $voiture->image) }}">
            </div>
            <div class="city col-4">
                @if($voiture->electric)
                <small>moteur electrique</small>
                @else
                <small>moteur fuel</small>
                @endif

                @if($voiture->manuel)
                <small>transmission manuellele</small>
                @else
                <small>transmission Automatique</small>
                @endif

                <small>( {{$voiture->portes}} ) porte</small> 

                <small>annee : {{$voiture->annee}}</small>

            </div>
            <div class="city col-4">
                <small>Nom</small>
                <strong>{{$order->nom}}</strong> 
                <br>
                <strong class="ml-3">{{$order->Prénom}}</strong>

            </div>

        </section>
        <section class="infos">
            <div class="places">
                <div class="box">
                    <input id="text" type="hidden" value="{{$order->code_reservation}}"/>
                    <div id="qrcode" class="barcode"></div>
                </div>
                <div class="box">
                    <small>Date de paiement</small>
                    <strong>{{ $order->paiment_cree_a}}</strong>
                </div>
            </div>
            <div class="times">
                <div class="box">
                    <small>Date début</small>
                    <strong>
                          <?php 
                              echo substr($order->date_debut, 0, 10);
                           ?>
                    </strong>
                </div>
                <div class="box">
                    <small>Date fin</small>
                    <strong>
                          <?php 
                              echo substr($order->date_fin, 0, 10);
                           ?>
                    </strong>
                </div>
            </div>

        </section>
          
    </div>
         <div class="row mx-auto">
         </div>          
  </div>
  </div>

  <div class="row">
        <button type="button" class="btn btn-outline-warning d-inline-block mx-auto print-button mb-5" onclick="printDiv('ticket-print')" style="font-size: 10pt;">Imprimer mon Ticket</button>
  </div>

</div>

@endsection


@section('extra-js')
<script type="text/javascript">

    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 90,
        height : 90
    });

    function makeCode () 
    {      
        var elText = document.getElementById("text");
        
        qrcode.makeCode(elText.value);
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

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection


@section('extra-style')
<style type="text/css">

.theh3 {
    margin-left: 15%;

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
      z-index: -1;
      transform:translate(0%, 0%);

    }

    .print-button {
    width: 55%;
  }
      /*--------------------
    Body
    --------------------*/

    /*--------------------
    Boarding Pass
    --------------------*/
    .boarding-pass {
      position: relative;
      /*top: 50%;
      left: 22%;*/
      width: 640px;
      height: 330px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      text-transform: uppercase;
      margin: 18px;
      margin-bottom: 34px;
      /*--------------------
      Header
      --------------------*/
      /*--------------------
      Cities
      --------------------*/
      /*--------------------
      Infos
      --------------------*/
      /*--------------------
      Strap
      --------------------*/
    }
    .boarding-pass small {
      display: block;
      font-size: 11px;
      color: #A2A9B3;
      margin-bottom: 2px;
    }
    .boarding-pass strong {
      font-size: 15px;
      display: block;
    }
    .boarding-pass header {
      background: -webkit-gradient(linear, left top, left bottom, from(#36475f), to(#2c394f));
      background: linear-gradient(to bottom, #36475f, #2c394f);
      padding: 12px 20px;
      height: 53px;
    }
    .boarding-pass header .logo {
      float: left;
      width: 104px;
      height: 31px;
    }
    .boarding-pass header .flight {
      color: #fff;
      text-align: right;
    }
    .boarding-pass header .flight small {
      font-size: 13px;
      margin-bottom: 2px;
      opacity: 0.8;
    }
    .boarding-pass header .flight strong {
      font-size: 18px;
    }
    .boarding-pass .cities {
      position: relative;
    }
    .boarding-pass .cities::after {
      content: '';
      display: table;
      clear: both;
    }
    .boarding-pass .cities .city {
      padding: 20px 18px;
      float: left;
    }
    .boarding-pass .cities .city:nth-child(2) {
      float: right;
    }
    .boarding-pass .cities .city strong {
      font-size: 20px;
      font-weight: 300;
      line-height: 0.6;
      padding-left: 0px;

    }
    .boarding-pass .cities .city small {
      margin-bottom: 0px;
      margin-left: 0px;
    }
    .boarding-pass .cities .airplane {
      position: absolute;
      width: 30px;
      height: 25px;
      top: 57%;
      left: 30%;
      opacity: 0;
      -webkit-transform: translate(-50%, -50%);
              transform: translate(-50%, -50%);
      -webkit-animation: move 3s infinite;
              animation: move 3s infinite;
    }
    @-webkit-keyframes move {
      40% {
        left: 50%;
        opacity: 1;
      }
      100% {
        left: 70%;
        opacity: 0;
      }
    }
    @keyframes move {
      40% {
        left: 50%;
        opacity: 1;
      }
      100% {
        left: 70%;
        opacity: 0;
      }
    }
    .boarding-pass .infos {
      display: -webkit-box;
      display: flex;
      border-top: 1px solid #99D298;
    }
    .boarding-pass .infos .places,
    .boarding-pass .infos .times {
      width: 50%;
      padding: 10px 0;
    }
    .boarding-pass .infos .places::after,
    .boarding-pass .infos .times::after {
      content: '';
      display: table;
      clear: both;
    }
    .boarding-pass .infos .times strong {
      -webkit-transform: scale(0.9);
              transform: scale(0.9);
      -webkit-transform-origin: left bottom;
              transform-origin: left bottom;
    }
    .boarding-pass .infos .places {
      background: #ECECEC;
      border-right: 1px solid #99D298;
    }
    .boarding-pass .infos .places small {
      color: #97A1AD;
    }
    .boarding-pass .infos .places strong {
      color: #239422;
    }
    .boarding-pass .infos .box {
      padding: 10px 20px 10px;
      width: 47%;
      float: left;
    }
    .boarding-pass .infos .box small {
      font-size: 10px;
    }
    .boarding-pass .strap {
      clear: both;
      position: relative;
      border-top: 1px solid #99D298;
    }
    .boarding-pass .strap::after {
      content: '';
      display: table;
      clear: both;
    }
    .boarding-pass .strap .box {
      padding: 23px 0 20px 20px;
    }
    .boarding-pass .strap .box div {
      margin-bottom: 15px;
    }
    .boarding-pass .strap .box div small {
      font-size: 10px;
    }
    .boarding-pass .strap .box div strong {
      font-size: 13px;
    }
    .boarding-pass .strap .box sup {
      font-size: 8px;
      position: relative;
      top: -5px;
    }
    .boarding-pass .strap .qrcode {
      position: absolute;
      top: 20px;
      right: 20px;
      width: 80px;
      height: 80px;
    }

    .right {
      float: right;
    }
    .left {
      float: left;
    }

</style>




@endsection
