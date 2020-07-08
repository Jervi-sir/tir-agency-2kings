
@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Hotels > pieces</title>
@endsection

@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-hotel relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Pieces
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mx-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('hotels.index') }}" class="ml-3"> Hotels</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

@endsection

@section('extra-style')
<style type="text/css">
    
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


<section class="content-area mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="rt-duel-slider-main rt-mb-30">
                    <div class="single-main rtbgprefix-cover">
                        <img class="single-main rtbgprefix-cover" src="{{ secure_asset('storage/' . $chambre->image) }}" id="mainImage">
                        <div class="mt-2">
                            @if($chambre->images)
                            <img class="img-thumbnail" src="{{ secure_asset('storage/' . $chambre->image) }}" width="50">

                            @foreach (json_decode($chambre->images, true) as $image)
                            <img src="{{secure_asset('storage/' . $image)}}" width="50" class="img-thumbnail">
                            @endforeach
                            @endif
                        </div>
                        @if($chambre->promotion_pourcentage > 0)
                        <div class="inner-badge badge-bg-1 f-size-14 rt-strong">
                            reduction de {{ $chambre->promotion_pourcentage }} %
                        </div><!-- /.inner-badge -->
                        @endif
                    </div><!-- /.single-main -->

                </div><!-- /.rt-duel-slider-main -->
            </div><!-- /.col-lg-7 -->
            <div class="col-lg-5 mt-5 mt-lg-0" style="position:position: relative;z-index: 1;margin-bottom: 20px;padding: 20px;border: 1px solid rgba(42, 56, 76, .15);border-radius: 5px;background-color: #f3f3f3;box-shadow: 0 10px 30px 0 #5a719e6b;">
                <div class="hotel-inner-content">
                    <h5 class="f-size-18 rt-medium">{{ $chambre->titre }}</h5>
                    <p class="f-size-13"><span class="text-555">( {{ $chambre->nb_lit }} ) lit(s) </span>
                    <br>
                     <span class="pl-2 text-777">{{ $chambre->hotel->lieu }}</span></p>
                    <div class="rt-mt-15 rt-mb-20">
                        <div >
                            <span class="right">
                                @for ($i = 0;$i < $chambre->hotel->etoiles;$i++)
                                <i class="fa fa-star review"></i>
                                @endfor
                            </span>
                        </div>   
                        <span class="badge rt-gradinet-badge pill">{{ $chambre->hotel->etoiles }} <small>/5</small></span>
                        @if($chambre->hotel->etoiles == 5)<span class="text-warning">Super</span>
                        @elseif($chambre->hotel->etoiles == 4)<span class="text-primary">Excellent</span>
                        @elseif($chambre->hotel->etoiles == 3)<span class="text-success">Satisfesant</span>
                        @elseif($chambre->hotel->etoiles == 2)<span class="text-info">Passable</span>
                        @endif
                        <span></span>

                    </div>
                    <div>

                    </div>
                    <p class="f-size-14 text-333 mt-3">{{ $chambre->options }}</p>
                    <div>
                        <div class="col-8 row">
                            @if($chambre->hotel->avec_wifi)
                            <div class="col-6 fa fa-wifi mb-2"> Wifi</div>
                            @endif
                            @if($chambre->hotel->avec_parking)
                            <div class="col-6 fa fa-car mb-2"> Parking gratuit</div>
                            @endif
                            @if($chambre->hotel->avec_animaux)
                            <div class="col-6 fa fa-paw mb-2">Animaux autorisés</div>
                            @endif
                            @if($chambre->hotel->avec_piscine || $chambre->hotel->avec_gym)
                            @if($chambre->hotel->avec_piscine)
                            <div class="col-6 fa fa-check-square-o mb-2">Piscine</div>
                            @endif
                            @if($chambre->hotel->avec_gym)
                            <div class="col-6 fa fa-check-square-o mb-2">Gym</div>
                            @endif

                            @endif
                            <br>
                            @if($chambre->repas)
                            <div class="col-6 fa fa-check-square-o mb-2"> Repas</div>
                            @endif

                            @if($chambre->avec_enfant )
                            <div class="col-6 fa fa-check-square-o mb-2"> Lit enfant</div>
                            @endif

                        </div>
                    </div>
                   
                   
            <div class="container-fluid">
                <div class="rt-sidebar-group">
                    @if(session()->has('hotel_days_search'))
                    <div class="rt-widget final-booking">
                        @if($chambre->promotion_pourcentage == 0)
                        <form oninput = "d.value = e.valueAsNumber * f.valueAsNumber" method="POST">
                          <input type="number" value="{{$chambre->prix}}" id="e" style="display:none;" disabled > 
                        <ul class="container">
                            <li class="clearfix row">

                                <span class="col-6">Prix par jour </span>
                                <span class="float-right col-6">{{ getPriceHelper($chambre->prix)}}</span>
                            </li>


                            <li class="clearfix row">

                                <span class="col-6">Durrée</span>
                                <span class="float-right col-6"><input type="number" id="f" value="{{session()->get('hotel_days_search')}}" min="1" max="10" onkeydown="return false" onclick="myFunction()" style="width:36%;"><span class="f-size-12 mr-1">jour(s)</span></span>
                            </li>
                            <li class="clearfix sub-total row">
                                <span class="col-6">Total</span>
                                <span class="float-right col-6"><output name="d" id="format-price" for = "e f" id="total " style="float: left; "> {{getPriceHelper($chambre->prix*session()->get('hotel_days_search'))}}</span>
                            </li>
                        </ul>
                       

                        </form>
                        @else
                        <form oninput = "d.value = e.valueAsNumber * f.valueAsNumber">
                           <input type="number" value="{{$chambre->prix - ($chambre->prix * $chambre->promotion_pourcentage / 100) }}" id="e" style="display:none;" disabled > 
                                <ul class="container">
                                    <li class="clearfix row">

                                        <span class="col-6">Prix par jour </span>
                                        <span class="float-right col-6">
                                            <strike style="font-size: 16px;">
                                                {{ getPriceHelper($chambre->prix)}}
                                            </strike>
                                        </span>
                                        <br>
                                        <span class="float-right col-6" style="font-size: 21px;font-weight: 400;color: #f8b600;">
                                            {{ getPriceHelper_Pourcentage($chambre->prix,$chambre->promotion_pourcentage) }}
                                        </span>
                                    </li>

                                    <li class="clearfix row">

                                        <span class="col-6">Durrée</span>
                                        <span class="float-right col-6"><input type="number" id="f" value="{{session()->get('hotel_days_search')}}" min="1" max="10" onkeydown="return false" onclick="myFunction()" style="width:36%;"><span class="f-size-12 mr-1">jour(s)</span></span>
                                    </li>
                                    <li class="clearfix sub-total row">
                                        <span class="col-6">Total</span>
                                        <span class="float-right col-6"><output name="d" id="format-price" for = "e f" id="total " style="float: left; "> 
                                            {{getPriceHelper_days_Pourcentage($chambre->prix,
                                                                                session()->get('hotel_days_search'),
                                                                                $chambre->promotion_pourcentage )}}
                                        </span>
                                    </li>
                                </ul>
                        </form>

                              
                        @endif

                        <div class="row">
                            @if(!$chambre->occupee)
                            <div class="text-center  mx-auto">
                                @auth
                                 <a type="submit" class="rt-btn rt-gradient pill rt-sm1" href="{{ route('login') }}">Réserver Maintenant</a>

                                @endauth
                                @guest
                                <a type="submit" class="rt-btn rt-gradient pill rt-sm1" href="{{ route('login') }}">Connecter vous <br> pour resrver</a>
                                @endguest
                            </div><!-- /.text-center -->
                            @endif
                        </div>
                        <div class="plain-box pl-md-3">

                    </div><!-- /.plain-box -->

                    <!-- CASe::: promotion , nothing specified -->
                    @else

                    <div class="rt-widget final-booking">
                            <form oninput = "d.value = e.valueAsNumber * f.valueAsNumber">
                                @if(session('currency') == "dzd")
                                <input type="number" value="{{($chambre->prix - ($chambre->prix * $chambre->promotion_pourcentage / 100))}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "eur")
                                <input type="number" value="{{($chambre->prix - ($chambre->prix * $chambre->promotion_pourcentage / 100)) * 0.00689505}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "gbp")
                                <input type="number" value="{{($chambre->prix - ($chambre->prix * $chambre->promotion_pourcentage / 100)) * 0.00624130}}" id="e" style="display:none;" disabled > 
                                @elseif(session('currency') == "usd")
                                <input type="number" value="{{($chambre->prix - ($chambre->prix * $chambre->promotion_pourcentage / 100)) * 0.00771338}}" id="e" style="display:none;" disabled > 
                                @endif
                                <input type="hidden" id="currency_used" value="{{session('currency')}}">  <!-- for js -->
                                
                                <ul class="container">
                                     <li class="clearfix row">

                                        <span class="col-6">Prix par jour </span>
                                       
                                        <span class="float-right col-6" style="font-size: 21px;font-weight: 400;color: #f8b600;">
                                            {{ getPriceHelper_Pourcentage($chambre->prix,$chambre->promotion_pourcentage) }}
                                        </span>
                                    </li>
                                    <li class="clearfix row">

                                        <span class="col-6">Durrée</span>
                                        <span class="float-right col-6"><input type="number" id="f" value="{{ $days = 1 }}" min="1" max="10" onkeydown="return false" onclick="myFunction()" style="width:36%;"><span class="f-size-12 mr-1">jour(s)</span></span>
                                    </li>
                                    <li class="clearfix sub-total row">

                                        <span class="col-5">Total</span>
                                        <span class="float-right col-7"><output name="d" id="format-price" for = "e f" id="total " style="float: left; ">   {{ getPriceHelper_Pourcentage($chambre->prix,$chambre->promotion_pourcentage) }}</span>
                                    </li>

                                </ul>
                            </form>


                            <span class="d-block  f-size-24 rt-semiblod title-font mt-2" class="price" style="font-size: 20px;">
                            </span>

                        <div class="row">
                            @if(!$chambre->occupee)
                            <div class="text-center rt-mb-30 mx-auto">
                                @auth
                                    <a href="#reserver" class="rt-btn rt-gradient pill rt-sm1" style="color: white"> Réserver Maintenant </a>
                                @endauth
                                @guest
                                <a type="submit" class="rt-btn rt-gradient pill rt-sm1" href="{{ route('login') }}">Connecter vous <br> pour resrver</a>
                                @endguest
                            </div><!-- /.text-center -->
                            @endif
                        </div>
                           

                    @endif
                </div><!-- /.rt-widget -->
                </div><!-- /.rt-sidebar-group -->
            </div><!-- /.col-lg-3 -->
             <div class="rt-divider style-one"></div><!-- /.rt-divider -->
                    <div class="">
                        <ul class="rt-social normal-style-one ">
                            <li><span class="f-size-14"><strong>partager sur:</strong></span></li>
                            <li><a href="#"><i class="fa fa-facebook review"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter review"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin review"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus review"></i></a></li>
                        </ul>
                    </div><!-- /. social -->
                </div><!-- /.hotel-text -->
            </div><!-- /.col-lg-5 -->
        </div>    

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

        function getDays() {
            var get_days = document.getElementById("f").value;
            document.getElementById("nb_jour").value = get_days;
        }
    </script>
         @if($chambre->occupee)
                <div class="flight-list-box rt-mb-30 pt-30">

                    <h4 class="f-size-24 text-capitalize    watermark">Cette Chambre n'est pas disponible pour une réservation</h4>
                     <h4 class="f-size-24 text-capitalize  ">Cette Chambre n'est pas disponible pour une réservation</h4>

                </div><!-- /.flight-list-box -->
           @endif    
        <div class="row flight-list-box rt-mb-30">
            <div class="col">
                <div class="inner-content rt-pl-15" id="reserver">
                    <h4 class="badge-hilighit color--1 f-size-14 text-white text-font text-uppercase rt-mb-30 rt-mt-15">Description</h4>
                    <br>
                    {{ $chambre->description }}
                </div>
            </div>

        </div>
        @auth

        @if(!$chambre->occupee)
        <div class="row">
            <div class="flight-list-box rt-mb-30 pt-30">
                <h4 class="f-size-24 text-capitalize rt-mb-30  rt-semiblod">Mes Information</h4>
                <h6 class="text-333 rt-medium">Veuillez entrer vos information <br> pour votre nouveau ticket de réservation</h6>
                <br>
                <br>



                <form action="{{ route('paiement.index') }}" id="payment-form" class="rt-form rt-line-form flight-lable">

                    <input type="hidden" name="product_id" value="{{ $chambre->id }}">
                    <input type="hidden" name="product_type" value="{{ $chambre->type_service }}">
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
        </div>
        <div class="row">
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
                       
        </div>

    </div><!-- container-->
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

@section('extra-style')
<style>
    .watermark {
        transform: translate(-69px, -278px) rotate(-19deg);
        opacity: 0.5;
        color: BLACK;
        position: absolute;
        bottom: 0;
        right: 0;
    }
    .page-item.active .page-link {
            background-color: #fa8a01;
            border-color: #ffffff;
    }
    .page-link {
        color: #fa8a01;
    }

    .page-link:hover {
      color: #ffadad;
      text-decoration: none;
      background-color: #fa8a0147;
      border-color: #ffffff;
    }
    .page-link:focus {
      z-index: 2;
      outline: 0;
      box-shadow: 0 0 0 0.2rem rgba(255, 177, 0, 0.46);
    }

</style>

@endsection
