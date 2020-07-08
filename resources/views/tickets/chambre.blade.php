
@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Vol > ticket</title>
@endsection

@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-hotel relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Mon ticket
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mr-3">accueil </a> <span class="fa fa-angle-right"></span> <a href="" class="ml-3"> Réservations</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->
@endsection



@section('extra-script')

    <script src="{{ asset('js/qrcode.js')}}"></script>
    <script src="{{ asset('js/JsBarcode.all.min.js')}}"></script>

@endsection


@section('content-noSidebar')
<div class="container">
    <div class="row">
            <div class="flt-dtls-box mx-auto mt-5" style="width: 75%;">

                <div class="upper-top-content d-md-flex flex-md-row justify-content-md-between align-items-center" >
                    <div class="left">
                        <span>details de la voiture</span>
                    </div><!-- /.left -->
                </div><!-- /.upper-top-content -->
                <ul class="rt-list d-flex flex-lg-row flex-column justify-content-md-between box-style__1 rt-light-bg rt-mb-10 row" >

                    <li class="rt-pt-8 col-md-4">
                        <span class="d-block"><img src="{{ asset('storage/' . $chambre->image) }}" alt="chambre->hotel iamge" draggable="false">
                            <span class="text-333"><i class="icofont-bed"></i> <i class="icofont-bed"></i></span>
                            <span class="d-block"></span>

                    </li>
                    <li class="rt-pt-8 col-md-4">
                        <p>
                            <span class="f-size-13 text-333"> {{$chambre->nb_lit}} lit(s)</span>
                        </p>
                        <p>
                            <span class="rt-mr-5"><img src="assets/images/all-img/hottel-cion-10.png" alt=""></span>
                            <span class="f-size-13 text-333">{{ $chambre->superficie }} m²</span>
                        </p>
                        <p>
                            <span class="rt-mr-5"><img src="assets/images/all-img/hottel-cion-11.png" alt=""></span>
                            <span class="f-size-13 text-333">etage : {{ $chambre->etage }} - {{ $chambre->numero_chambre }}</span>
                        </p>

                        @if($chambre->avec_enfant )
                        <span class="fa fa-check-circle"> avec enfant</span><br>
                        @else
                        <span class="fa fa-times-circle-o"> sans enfant</span><br>

                        @endif

                        @if($chambre->repas)
                        <span class="fa fa-check-circle"> avec repast et diner</span>
                        @else
                        <span class="fa fa-times-circle-o"> sans repast et diner</span>

                        @endif

                    </li>
                    <li class="rt-pt-8 col-md-4">

                        <p class="f-size-13 text-333 line-height-20"><span ></span>
                          @if($chambre->hotel->annulation)
                          <i class="fa fa-check-circle"></i> avec Annulation
                          @else
                          <i class="fa fa-times-circle"></i> pas d'annulation</a>
                           @endif                                      
                         <p class="f-size-13 text-333 line-height-20"><span ><i class="fa fa-check-circle"></i></span> Confirmation Instante </p>

                    </li>


                </ul>

            </div><!-- /.col-lg-12 -->



    </div>
<h3 class="mt-4 theh3">Mon Ticket</h3>

    <div class="row" id="ticket-print">
        <div class="cardWrap">
            <div class="card cardLeft">
                <div class="h1"> {{ $chambre->hotel->titre }} <span class="right">hotel</span></div>
                <div class="title1">
                    <span>Nom du Client</span>
                    <div class="h2">{{$order->nom}} {{$order->Prénom}}</div>
                </div>
                <div class="name1">
                    <span>Chambre reservee</span>
                    <div class="row">
                    <div class="h2 col-6"><span>N&deg;</span> {{$chambre->numero_chambre}} </div>
                    <div class="h2 col-6"><span>etage N&deg;</span> {{$chambre->etage}} </div>
                    </div>
                </div>
                <div class="container row mt-4">
                    <div class="col-6">
                        <div class="time1 left">
                            <span>date debut</span>
                            <div class="h2">12:00</div>
                        </div>
                    </div>
                    <div class="col-6t">
                        <div class="time1 right">
                            <span>date fin</span>
                            <div class="h2">12:00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card cardRight">
                <div class="eye"></div>
                <div class="number">
                    <span>chambre <br>e{{$chambre->etage}}  N&deg;</span>
                    <h3>{{$chambre->numero_chambre}} </h3>
                </div>
                <input id="text" type="hidden" value="{{$order->code_reservation}}" />
                <div id="qrcode" class="qrcode"></div>
            </div>
        </div>
                   <div class="row mx-auto">
                    <div class="watermark">GACEM'AYMEN</div>
          <div class="watermark">theYeeeBoii-s</div>
    </div>
    </div>

    <div class="row">
        <button type="button" class="btn btn-outline-warning d-inline-block mx-auto print-button mb-5" onclick="printDiv('ticket-print')" >Imprimer mon Ticket</button>
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
  .theh3 {
    margin-left: 11%;

  }
      .print-button {
    width: 55%;
  }

        .cardWrap {
          width: 25em;
          margin: 1em auto;
          margin-top: 0px;
          color: #fff;
          font-size: 26px;
          font-family: sans-serif;
        }

        .card {
          background: linear-gradient(to bottom, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
          height: 13em;
          float: left;
          position: relative;
          padding: 20px;

          padding-top: 15px;
          padding-bottom: 0px;
          margin-top: 20px;
        }

        .cardLeft {
          border-top-left-radius: 8px;
          border-bottom-left-radius: 8px;
          width: 18em;
        }

        .cardRight {
          width: 6.5em;
          border-left: .18em dashed #e2eaef;
          border-top-right-radius: 8px;
          border-bottom-right-radius: 8px;
        }
        .cardRight:before, .cardRight:after {
          content: "";
          position: absolute;
          display: block;
          width: .9em;
          height: .9em;
          background: #e2eaef;
          border-radius: 50%;
          left: -.5em;
        }
        .cardRight:before {
          top: -.4em;
        }
        .cardRight:after {
          bottom: -.4em;
        }

        .h1 {
          font-size: 1.1em;
          margin-top: 0;
        }
        .h1 span {
          font-weight: normal;
        }

        .title1, .name1, .seat .time1 {
          text-transform: uppercase;
          font-weight: normal;
        }
        .title1 .h2, .name1 .h2, .sea th2, .time1 .h2 {
          font-size: .7em;
          color: #525252;
          margin: 0;
        }
        .title1 span, .name1 span, .sea tspan, .time1 span {
          font-size: .7em;
          color: #a2aeae;
        }

        .title1 {
          margin: .7em 0 0 0;
        }

        .name1, .seat{
          margin: .5em 0 0 0;
        }

        .time1 {
          margin: .7em 0 0 1em;
        }

        .sea,t .time1 {
          float: left;
        }

        .eye {
          position: relative;
          width: 2em;
          height: 1.5em;
          background: #fff;
          margin: 0 auto;
          border-radius: 1em/0.6em;
          z-index: 1;
        }
        .eye:before, .eye:after {
          content: "";
          display: block;
          position: absolute;
          border-radius: 50%;
        }
        .eye:before {
          width: 1em;
          height: 1em;
          background: #e84c3d;
          z-index: 2;
          left: 8px;
          top: 4px;
        }
        .eye:after {
          width: .5em;
          height: .5em;
          background: #fff;
          z-index: 3;
          left: 12px;
          top: 8px;
        }

        .number {
          text-align: center;
          text-transform: uppercase;
        }
        .number h3 {
          color: #e84c3d;
          margin: .9em 0 0 0;
          font-size: 2.5em;
        }
        .number span {
            margin-top: 52px;
            margin-bottom: -64px;
            display: block;
            font-size: 20px; 
            color: #a2aeae;
        }

        .barcode {
          height: 2em;
          width: 0;
          margin: 1.2em 0 0 .8em;
          box-shadow: 1px 0 0 1px #343434, 5px 0 0 1px #343434, 10px 0 0 1px #343434, 11px 0 0 1px #343434, 15px 0 0 1px #343434, 18px 0 0 1px #343434, 22px 0 0 1px #343434, 23px 0 0 1px #343434, 26px 0 0 1px #343434, 30px 0 0 1px #343434, 35px 0 0 1px #343434, 37px 0 0 1px #343434, 41px 0 0 1px #343434, 44px 0 0 1px #343434, 47px 0 0 1px #343434, 51px 0 0 1px #343434, 56px 0 0 1px #343434, 59px 0 0 1px #343434, 64px 0 0 1px #343434, 68px 0 0 1px #343434, 72px 0 0 1px #343434, 74px 0 0 1px #343434, 77px 0 0 1px #343434, 81px 0 0 1px #343434;
        }

        .right {
            float: right;
        }

        .left{
            float: left;
        }

        .qrcode {
            margin: auto;


        }

</style>




@endsection
