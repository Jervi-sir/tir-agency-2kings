@extends('layouts.master2')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Voitures</title>
@endsection


@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('bannerArea')
<section class="about-banner-voiture relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">             
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Voitures                
                </h1>   
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mx-3">Accueil </a>  <span class="fa fa-angle-right"></span>  <a href="{{ route('voitures.index') }}" class="ml-3"> Voitures</a></p>
            </div>  
        </div>
    </div>
</section>

@endsection


@section('extra-script')
@endsection

@section('extra-js')
@endsection



@section('extra-style')
<style>
    .watermark {
        transform: translate(-69px, -247px) rotate(-19deg);
        opacity: 0.5;
        color: BLACK;
        position: absolute;
        bottom: 0;
        right: 0;
    }
    .promotion 
    {
        color: #fff;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ffaa57), to(#fe5c76));
        box-shadow: 0 5px 30px 0 rgba(13, 21, 75, .4);
        position: absolute;
        top: 8px;
        left: 8px;
        padding: 0px 20px;
        border-top-right-radius: 214px;
        border-bottom-right-radius: 999px;
        font-weight: 500;
        font-size: 12px;
    }

</style>

@endsection



@section('content-noSidebar')

<div class="section-title-spacer "></div><!-- /.rt-section-title-spacer -->
<section class="content-area mt-5" onload="give_days()">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mb-5">
                <div class="flt-dtls-box rt-mb-30">

                    <div class="upper-top-content d-md-flex flex-md-row justify-content-md-between align-items-center">
                        <div class="left">
                            <span>Détails de la voiture</span>
                        </div><!-- /.left -->
                    </div><!-- /.upper-top-content -->
                    <div class="flight-list-box rt-mb-30">
                        <div class="top-content d-flex flex-md-row flex-column justify-content-lg-between">
                            <div class="car-thumb mr-4 mr-lg-0 mb-5 mb-md-0" style="max-width: 35em;">
                            <img src="{{ secure_asset($voiture->image) }}" alt="image voiture" id="mainImage" width="100%" class="rt-border-primary2">
                            <div class="mt-2">
                                @if($voiture->images)
                                <img class="img-thumbnail" src="{{ secure_asset($voiture->image) }}"  width="50" >
                                    @foreach (json_decode($voiture->images, true) as $image)
                                        <img src="{{secure_asset($image)}}" width="50" class="img-thumbnail">
                                    @endforeach
                                @endif
                            </div>

                            <script>
                                var mainImage = document.querySelector('#mainImage');
                                var thumbnails = document.querySelectorAll('.img-thumbnail');
                                thumbnails.forEach((element) => element.addEventListener('click', changeImage));
                                function changeImage(e) {
                                  mainImage.src = this.src;
                                }

                          </script>
                            
                            <span class="d-block f-size-13 text-555" style="margin-bottom: -14px;">Ajoutée le : {{ $voiture->created_at->format('d/m/Y')  }}</span>

                            </div>
                            @if($voiture->promotion_pourcentage > 0)
                                <div class="promotion">
                                           réduction de {{ $voiture->promotion_pourcentage }} %
                                </div><!-- /.inner-badge -->
                            @endif
                            <div class="economy mb-5 mb-md-0">
                                <h5 class="f-size-16 rt-medium mt-1">{{ $voiture->titre }}</h5>
                                <span class="d-block f-size-13 text-555 mt-1">{{ $voiture->portes }} portes</span>

                                <span class="badge rt-gradinet-badge pill rt-mr-10 mt-2">{{ $voiture->etoiles}}<small>/5</small></span>
                                <span class="primary-color">
                                    @if($voiture->etoiles >= 5) Super
                                    @elseif ($voiture->etoiles >= 3) Excellent
                                    @else Satisfaisante
                                    @endif
                                </span>
                                <span class="f-size-12 text-878"></span>

                                @if($voiture->promotion_pourcentage == 0)
                                 <span class="d-block f-size-13 text-555" style="margin-top: 13px; margin-bottom: -14px;">
                                    Prix par 1 jour : <span style="color: rgba(255, 167, 0, 0.79); font-weight: 600; font-size: 14px;">{{getPriceHelper($voiture->prix)}}</span>
                                    </span>
                                @else
                                <span class="d-block f-size-13 text-555" style="margin-top: 13px; margin-bottom: -14px;">
                                    Prix par 1 jour : 
                                    <span style="color: rgba(255, 167, 0, 0.79);font-weight: 600; font-size: 14px;">
                                        <strike style="font-size: 16px;">{{getPriceHelper($voiture->prix)}}</strike>
                                    </span>
                                </span>
                                <br>
                                 <span class="d-block  f-size-24 rt-semiblod title-font" style="float: right;">
                                {{ getPriceHelper_Pourcentage($voiture->prix,$voiture->promotion_pourcentage) }}</span>
                                 @endif
                                </span>

                            </div>

                            <div class="ck-list">
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
                            <div class="price-mant">

    <script type="text/javascript">

        function myFunction() {

            var qty = document.getElementById("f").value;
            var currency = document.getElementById("currency_used").value;
            if(qty >= 2 && qty <= 9)
            {
               
                var price = document.getElementById("format-price").value;
                var intPrice = parseInt(price);
                if(currency == "dzd")
                {
                    document.getElementById("format-price").value = currencyFormatDA(intPrice); 
                }
                else if(currency == "eur")
                {
                    document.getElementById("format-price").value = currencyFormatEUR(intPrice); 
                }
                else if(currency == "gbp")
                {
                    document.getElementById("format-price").value = currencyFormatGBP(intPrice); 
                }
                else if(currency == "usd")
                {
                    document.getElementById("format-price").value = currencyFormatUSD(intPrice); 
                }

                // var amount = document.getElementById("format-price").value;
                // var i = parseFloat(amount)/100;
                // if(isNaN(i)) { i = 0.00; }
                // var minus = '';
                // if(i < 0) { minus = '-'; }
                // i = Math.abs(i);
                // i = parseInt((i + .005) * 100);
                // i = i / 100;
                // s = new String(i);
                // if(s.indexOf('.') < 0) { s += ',00 DA'; }
                // if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
                // s = minus + s;
                // document.getElementById("format-price").value = s;  
                // var jours = document.getElementById("f").value;
                // document.getElementById("nb_jour").value = qty;
            }
        }

        //get days from the spinner to send it via the pay button
        function getDays() {
            var get_days = document.getElementById("f").value;
            document.getElementById("nb_jour").value = get_days;
            
        }
    </script>
                            </div><!-- /.price-mant -->
                        </div><!-- /.top-content -->
                        <div class="bottom-content row" id="reserver">
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
                                        <span class="primary-color rt-mr-3"><i class="fa fa-check-circle"></i> transmission manuelle</span>
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
                                        <span class="text-success rt-mr-3"><i class="fa fa-check-circle"></i> annulation gratuit</span>

                                        @else
                                        <span class="text-danger rt-mr-3"><i class="fa fa-times-circle"></i> pas d'annulation</span>
                                        @endif
                                    </li>
                                </ul><!-- /.rt-list -->
                            </div><!-- /.single-discribe -->
                        </div><!-- /.bottom-content -->
                    </div><!-- /.flight-box -->

                </div><!-- /.flt-dtls-box -->

             @auth

            @if(!$voiture->occupee)

                <div class="flight-list-box rt-mb-30 pt-30" >
                    <h4 class="f-size-24 text-capitalize rt-mb-30  rt-semiblod">Mes Information</h4>
                    <h6 class="text-333 rt-medium">Veuillez entrer vos information <br> pour votre nouveau ticket de réservation</h6>
                    <br>
                    <br>
                    <script type="text/javascript">
                       
                    </script>


                <form action="{{ route('paiement.index') }}" id="payment-form"  class="rt-form rt-line-form flight-lable">
                    
                    <input type="hidden" name="product_id" value="{{ $voiture->id }}">
                    <input type="hidden" name="product_type" value="{{ $voiture->type_service }}">
                    <input type="hidden" id="nb_jour" name="jour_reserves" >


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
                            <input type="text" pattern="^[a-zA-Z]{4,}(?: [a-zA-Z]+)?(?: [a-zA-Z]+)?$" class="form-control" id="lst-name" placeholder="Prénom " name="prenom" required>
                        </div><!-- /.col-md-6 -->

                        <div class="col-md-6">

                            <input type="email" pattern="[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,3}" placeholder="email@email.com" class="form-control" name="email" value="{{Auth::user()->email }}" required>
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 rt-mb-30">
                            <input type="text" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" placeholder="telephone" class="form-control" name="Téléphone" required>
                        </div><!-- /.col-md-6 -->

                    </div><!-- /.row -->


                    @auth
                    <div class="col-md-12 mt-5">
                        <div class="row">
                            <div class="col-md-12 ">

                                <button class="rt-btn rt-gradient3 pill btn rt-sm2 btn-warning btn-lg text-light px-5 mr-5" style="float: right;" id="submit" onclick="getDays()" >Payer</button>
                            </div>
                        </div>
                    </div>
                    @endauth
                </form>
                </div><!-- /.flight-list-box -->

             @else
                <div class="flight-list-box rt-mb-30 pt-30">

                    <h4 class="f-size-24 text-capitalize    watermark">Cette voiture n'est pas disponible pour une réservation</h4>
                     <h4 class="f-size-24 text-capitalize  ">Cette voiture n'est pas disponible pour une réservation</h4>

                </div><!-- /.flight-list-box -->

             @endif   
            @endauth

               @guest
                <div class="flight-list-box rt-mb-30 pt-30 text-light bg-warning container">
                    <h4 class="f-size-24">Connecter vous pour effectuer cette réservation</h4>
                </div><!-- /.flt-dtls-box -->
                       @endguest
            </div><!-- /.col-lg-9 -->

            <!-- voiture sans promotion -->
            @if($voiture->promotion_pourcentage == 0)          
            <div class="col-xl-3 mx-auto mb-5">
                <div class="rt-sidebar-group">

                <!-- CASe:::: no promotion , with days specified -->
                    @if(session()->has('voiture_days_search'))              
                    <div class="rt-widget final-booking">
                        <form oninput = "d.value = e.valueAsNumber * f.valueAsNumber * 100" method="POST">
                          @if(session('currency') == "dzd")
                                <input type="number" value="{{$voiture->prix}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "eur")
                                <input type="number" value="{{$voiture->prix * 0.00689505}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "gbp")
                                <input type="number" value="{{$voiture->prix * 0.00624130}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "usd")
                                <input type="number" value="{{$voiture->prix * 0.00771338}}" id="e" style="display:none;" disabled > 
                                @endif
                                <input type="hidden" id="currency_used" value="{{session('currency')}}">  <!-- for js -->

                            <ul class="container">
                                <li class="clearfix row">

                                    <span class="col-md-6">Prix par jour</span>
                                    <span class="float-right col-md-6">{{ getPriceHelper($voiture->prix)}}</span>
                                </li>
                                <li class="clearfix row">

                                    <span class="col-md-6">Durrée</span>
                                    <span class="float-right col-md-6"><input type="number" id="f" value="{{session()->get('voiture_days_search')}}" min="1" max="10" onkeydown="return false" onclick="myFunction()" style="width:36%;"><span class="f-size-12 ml-1">jour(s)</span></span>
                                </li>
                                <li class="clearfix sub-total row">

                                    <span class="col-3">Total</span>
                                    <span class="float-right col-8 px-0"><output name="d" id="format-price" for = "e f" id="total " style="float: left; "> {{getPriceHelper($voiture->prix*session()->get('voiture_days_search'))}}</span>
                                </li>

                            </ul>
                        </form>
                        <span class="d-block  f-size-24 rt-semiblod title-font mt-2" class="price" style="font-size: 20px;">
                        </span>

                        <!-- button -->
                        <div class="row">
                            @if(!$voiture->occupee)
                            <div class="text-center rt-mb-30 mx-auto">
                                @auth
                                    <a href="#reserver" class="rt-btn rt-gradient pill rt-sm1" style="color: white"> Réserver Maintenant </a>
                                @endauth
                                @guest
                                <a type="submit" class="rt-btn rt-gradient pill rt-sm1" href="{{ route('login') }}">Connecter vous <br> pour réserver</a>
                                @endguest
                            </div><!-- /.text-center -->
                            @endif
                        </div>

                    <!-- CASe:::: no promotion , nothing specified -->
                    @else
                    <div class="rt-widget final-booking">
                            <form oninput = "d.value = e.valueAsNumber * f.valueAsNumber * 100">
                               @if(session('currency') == "dzd")
                                <input type="number" value="{{$voiture->prix}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "eur")
                                <input type="number" value="{{$voiture->prix * 0.00689505}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "gbp")
                                <input type="number" value="{{$voiture->prix * 0.00624130}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "usd")
                                <input type="number" value="{{$voiture->prix * 0.00771338}}" id="e" style="display:none;" disabled > 
                                @endif
                                <input type="hidden" id="currency_used" value="{{session('currency')}}">  <!-- for js -->
                                <ul class="container">
                                    <li class="clearfix row">

                                        <span class="col-6">Prix par jour</span>
                                        <span class="float-right col-6">{{ getPriceHelper($voiture->prix)}}</span>
                                    </li>
                                    <li class="clearfix row">

                                        <span class="col-6">Durrée</span>
                                        <span class="float-right col-6"><input type="number" id="f" value="{{ $days = 1 }}" min="1" max="10" onkeydown="return false" onclick="myFunction()" style="width:36%;"><span class="f-size-12 ml-1">jour(s)</span></span>
                                    </li>
                                    <li class="clearfix sub-total row">

                                        <span class="col-3">Total</span>
                                        <span class="float-right col-8 px-0"><output name="d" id="format-price" for = "e f" id="total " style="float: left; "> {{getPriceHelper($voiture->prix)}}</span>
                                    </li>

                                </ul>
                            </form>
                            <span class="d-block  f-size-24 rt-semiblod title-font mt-2" class="price" style="font-size: 20px;">
                            </span>

                            <div class="row">
                            @if(!$voiture->occupee)
                            <div class="text-center rt-mb-30 mx-auto">
                                @auth
                                    <a href="#reserver" class="rt-btn rt-gradient pill rt-sm1" style="color: white"> Réserver Maintenant </a>
                                @endauth
                                @guest
                                <a type="submit" class="rt-btn rt-gradient pill rt-sm1" href="{{ route('login') }}">Connecter vous <br> pour réserver</a>
                                @endguest
                            </div><!-- /.text-center -->
                            @endif
                        </div>
                           

                    @endif
                </div><!-- /.rt-widget -->

                    
                </div><!-- /.rt-sidebar-group -->
            </div><!-- /.col-lg-3 -->
           
           <!-- CASe:::: promotion , date specified -->
            @else
            <div class="col-xl-3 mx-auto mb-5">
                <div class="rt-sidebar-group">
                    @if(session()->has('voiture_days_search'))
                    <div class="rt-widget final-booking">
                        <form oninput = "d.value = e.valueAsNumber * f.valueAsNumber * 100" method="POST">
                           @if(session('currency') == "dzd")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100))}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "eur")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100)) * 0.00689505}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "gbp")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100)) * 0.00624130}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "usd")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100)) * 0.00771338}}" id="e" style="display:none;" disabled > 
                                @endif
                                <input type="hidden" id="currency_used" value="{{session('currency')}}">  <!-- for js -->

                            <ul class="container">
                                <li class="clearfix row">

                                     <span class="col-6">Prix par jour</span>
                                        <span class="float-right col-6">
                                            <strike style="font-size: 16px;">
                                                {{ getPriceHelper($voiture->prix)}}
                                            </strike>
                                        </span>
                                        <br>
                                        <span class="float-right col-6" style="font-size: 21px;font-weight: 400;color: #f8b600;">
                                            {{ getPriceHelper_Pourcentage($voiture->prix,$voiture->promotion_pourcentage) }}
                                        </span>
                                </li>
                                <li class="clearfix row">

                                    <span class="col-6">Durrée</span>
                                        <span class="float-right col-6">
                                            <input type="number" id="f" value="{{session()->get('voiture_days_search')}}" min="1" max="10" onkeydown="return false" onclick="myFunction()" style="width:36%;">
                                            <span class="f-size-12 ml-1">
                                                jour(s)
                                            </span>
                                        </span>
                                </li>
                                <li class="clearfix sub-total row">

                                    <span class="col-3">Total</span>
                                    <span class="float-right col-8 px-0"><output name="d" id="format-price" for = "e f" id="total " style="float: left; "> {{getPriceHelper_days_Pourcentage($voiture->prix,session()->get('voiture_days_search'),$voiture->promotion_pourcentage )}}</span>
                                </li>

                            </ul>
                        </form>
                        <span class="d-block  f-size-24 rt-semiblod title-font mt-2" class="price" style="font-size: 20px;">
                        </span>

                         <div class="row">
                            @if(!$voiture->occupee)
                            <div class="text-center rt-mb-30 mx-auto">
                                @auth
                                    <a href="#reserver" class="rt-btn rt-gradient pill rt-sm1" style="color: white"> Réserver Maintenant </a>
                                @endauth
                                @guest
                                <a type="submit" class="rt-btn rt-gradient pill rt-sm1" href="{{ route('login') }}">Connecter vous <br> pour réserver</a>
                                @endguest
                            </div><!-- /.text-center -->
                            @endif
                        </div>
                       

                    <!-- CASe:::: promotion , nothing specified -->
                    @else
                    <div class="rt-widget final-booking">
                            <form oninput = "d.value = e.valueAsNumber * f.valueAsNumber * 100">
                                @if(session('currency') == "dzd")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100))}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "eur")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100)) * 0.00689505}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "gbp")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100)) * 0.00624130}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "usd")
                                <input type="number" value="{{($voiture->prix - ($voiture->prix * $voiture->promotion_pourcentage / 100)) * 0.00771338}}" id="e" style="display:none;" disabled > 
                                @endif
                                <input type="hidden" id="currency_used" value="{{session('currency')}}">  <!-- for js -->
                                
                                <ul class="container">
                                     <li class="clearfix row">

                                     <span class="col-6">Prix par jour</span>
                                        <span class="float-right col-6">
                                            <strike style="font-size: 16px;">
                                                {{ getPriceHelper($voiture->prix)}}
                                            </strike>
                                        </span>
                                        <br>
                                        <span class="float-right col-6" style="font-size: 21px;font-weight: 400;color: #f8b600;">
                                            {{ getPriceHelper_Pourcentage($voiture->prix,$voiture->promotion_pourcentage) }}
                                        </span>
                                    </li>
                                    <li class="clearfix row">

                                        <span class="col-6">Durrée</span>
                                        <span class="float-right col-6"><input type="number" id="f" value="{{ $days = 1 }}" min="1" max="10" onkeydown="return false" onclick="myFunction()" style="width:36%;"><span class="f-size-12 ml-1">jour(s)</span></span>
                                    </li>
                                    <li class="clearfix sub-total row">

                                        <span class="col-3">Total</span>
                                        <span class="float-right col-8 px-0"><output name="d" id="format-price" for = "e f" id="total " style="float: left; "> {{getPriceHelper_Pourcentage($voiture->prix,$voiture->promotion_pourcentage)}}</span>
                                    </li>

                                </ul>
                            </form>


                            <span class="d-block  f-size-24 rt-semiblod title-font mt-2" class="price" style="font-size: 20px;">
                            </span>

                            <div class="row">
                            @if(!$voiture->occupee)
                            <div class="text-center rt-mb-30 mx-auto">
                                @auth
                                    <a href="#reserver" class="rt-btn rt-gradient pill rt-sm1" style="color: white"> Réserver Maintenant </a>
                                @endauth
                                @guest
                                <a type="submit" class="rt-btn rt-gradient pill rt-sm1" href="{{ route('login') }}">Connecter vous <br> pour réserver</a>
                                @endguest
                            </div><!-- /.text-center -->
                            @endif
                        </div>

                        @endif
                    </div><!-- /.rt-widget -->
                    @endif
 
                </div><!-- /.rt-sidebar-group -->
            </div><!-- /.col-lg-3 -->
            


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


        document.getElementById('spinner_number').addEventListener('change', function() 
        {
             
            var i = document.getElementById("price").value;
            var ii = i.split(' ').join('');
            var iii = parseFloat(ii);
            var iSpinner = document.getElementById("spinner_number").value;
            var iSpinnerVar = parseInt(iSpinner);

            document.getElementById("price").value = iii * iSpinnerVar;
                   
        });


  </script>


@endsection
