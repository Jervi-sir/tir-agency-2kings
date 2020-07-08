@extends('layouts.master2')

@section('titleSite')
<title>{{ \App\Agence::first()->nom_agence}} - Vols</title>
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


@section('searchForm')

@include('partials.searchVol')

@endsection


@section('stars')
<div data-role="page">
    <div id="full-stars-example-two">
        <div class="rating-group">
            <input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" type="radio">
            <label aria-label="1 star" class="rating__label" for="rating3-1">
                <a href="{{ route('vols.index', ['sort' => request('sort') ,
                                                'etoiles' => 1,
                                                'min_prix'=>request('min_prix'),
                                                'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
            <label aria-label="2 stars" class="rating__label" for="rating3-2">
                <a href="{{ route('vols.index', ['sort' => request('sort') ,
                                                'etoiles' => 2,
                                                'min_prix'=>request('min_prix'),
                                                'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
            <label aria-label="3 stars" class="rating__label" for="rating3-3">
                <a href="{{ route('vols.index', ['sort' => request('sort') ,
                                                'etoiles' => 3,
                                                'min_prix'=>request('min_prix'),
                                                'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
            <label aria-label="4 stars" class="rating__label" for="rating3-4">
                <a href="{{ route('vols.index', ['sort' => request('sort') ,
                                                'etoiles' => 4,
                                                'min_prix'=>request('min_prix'),
                                                'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
            <label aria-label="5 stars" class="rating__label" for="rating3-5">
                <a href="{{ route('vols.index', ['sort' => request('sort') ,
                                                'etoiles' => 5,
                                                'min_prix'=>request('min_prix'),
                                                'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
        </div>

        <label aria-label="0 stars" class="" for="rating3-0">
            <a href="{{ route('vols.index', ['sort' => request('sort') ,
                                                'etoiles' => 0,
                                                'min_prix'=>request('min_prix'),
                                                'max_prix'=>request('max_prix')])}}">
                <span class="mx-2 my-2 lnr lnr-cross" style="font-size: 1.7em;color: black;font-weight: 1000;opacity: 0.7;"></span>
            </a>
        </label>

        <input class="rating__input" name="rating3" id="rating3-0" value="0" type="radio">


    </div>
</div>

@endsection


@section('extra-style')
<style type="text/css">
    .promotion {
        color: #fff;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ffaa57), to(#fe5c76));
        box-shadow: 0 5px 30px 0 rgba(13, 21, 75, .4);
        position: absolute;
        top: -8px;
        left: -8px;
        padding: 0px 20px;
        border-top-right-radius: 214px;
        border-bottom-right-radius: 999px;
        font-weight: 500;
        font-size: 12px;
    }
</style>
@endsection

@section('sorting')
<div class="container-flex row" style="padding: 0;">
    <div class="col-6 p-0">
        <i class="col-3 fa fa-sort-desc" aria-hidden="true"></i>
        <a class="sort-size col-8" href="{{ route('vols.index', ['sort'     => 'asc' ,
'etoiles'   => request('etoiles'),
'min_prix'  => request('min_prix'),
'max_prix'  => request('max_prix')])}}">
            ascendant</a>
    </div>
    <div class="col-6 p-0">
        <i class="fa fa-sort-asc col-3" aria-hidden="true"></i>
        <a class="sort-size col-8" href="{{ route('vols.index', ['sort'     => 'desc' ,
'etoiles'   => request('etoiles'),
'min_prix'  =>request('min_prix'),
'max_prix'  =>request('max_prix')])}}">
            descending</a>
    </div>
</div>
@endsection

@section('price_range_submit')
<form action="{{ route('voitures.index')}}">

    <input id="min_prix" type="hidden" name="min_prix">
    <input id="max_prix" type="hidden" name="max_prix">

    @if(request('sort') != null)
    <input type="hidden" name="sort" value="{{request('sort')}}">
    @endif

    @if(request('etoiles') != null)
    <input type="hidden" name="etoiles" value="{{request('etoiles')}}">
    @endif


    <button class="rt-btn rt-gradient rounded-sm rt-sm text-uppercase" onclick="send_price_range()">Filtrer</button>
</form>
@endsection


@section('result')
<input type="hidden" id="min_prix_for_function" value="{{request('min_prix') ?? $vols->min('prix') }}">
<input type="hidden" id="max_prix_for_function" value="{{request('max_prix') ?? $vols->max('prix') }}">

<input type="hidden" id="min_prix_total" value="{{ \App\Avion::min('prix') }}">
<input type="hidden" id="max_prix_total" value="{{ \App\Avion::max('prix') }}">

@if(session('currency') == "dzd")
<input type="hidden" id="currency" value="1">
@elseif(session('currency') == "eur")
<input type="hidden" id="currency" value="0.0067">
@elseif(session('currency') == "gbp")
<input type="hidden" id="currency" value="0.0062">
@elseif(session('currency') == "usd")
<input type="hidden" id="currency" value="0.0077">
@endif



@foreach($vols as $product)
@if($product->places->where('occupee','=',0)->count() > 0 )

<?php 

$datetime = new DateTime($product->date_depart);
$datetime2 = new DateTime($product->date_retour);
$time = explode(':', strval($product->duree_vol)); 

/////Aller
//depart
$heur_depart = substr(explode(' ', $product->date_depart)[1], 0, 5);
$jour_mois_depart = date("M j ", strtotime( $datetime->format('Y-m-d H:i') ));
$annee_depart = date("Y ", strtotime( $datetime->format('Y-m-d H:i') ));

// arrivee        
$result = $datetime->modify('+'.$time[0].' hour +'.$time[1].' minutes')->format('Y-m-d H:i');
$jour_mois_arrivee = date("M j ", strtotime( $result ));
$annee_arrivee = date("Y", strtotime( $result ));
$heur_minute_arrivee = date("H:i", strtotime( $result ));

/////Retour
//depart   
$heur_depart2 = substr(explode(' ', $product->date_retour)[1], 0, 5);
$jour_mois_depart2 = date("M j ", strtotime( $datetime2->format('Y-m-d H:i') ));
$annee_depart2 = date("Y ", strtotime( $datetime2->format('Y-m-d H:i') ));

// arrivee        
$result2 = $datetime2->modify('+'.$time[0].' hour +'.$time[1].' minutes')->format('Y-m-d H:i');
$jour_mois_arrivee2 = date("M j ", strtotime( $result2 ));
$annee_arrivee2 = date("Y", strtotime( $result2 ));
$heur_minute_arrivee2 = date("H:i", strtotime( $result2 ));


?>
<div class="col-lg-12 col-sm-12 container px-0">
    <div class="flight-list-box rt-mb-30 row">
        <div class="container-fluid row">
            <h5 class="col-sm-4">{{ $product->titre }} </h5>
            <span class="col-sm-4">place libres:: {{ $product->places->where('occupee','=',0)->count() }}</span>

            <div class="col-sm-2">
                @for ($i = 0;$i < $product->etoiles;$i++)
                    <i class="fa fa-star review"></i>
                    @endfor
            </div>
        </div>
        <div class="col-md-10 px-0 mr-3">
            <div class="col-12 row px-0 mx-0">
                <div class="col-sm-2 flight-logo">
                    <img src="{{ secure_asset('storage/' . $product->image) }}" alt="vol logo" draggable="false">
                </div><!-- /.flight-logo -->
                @if($product->promotion_pourcentage > 0)
                <div class="promotion">
                    réduction de {{ $product->promotion_pourcentage }} %
                </div><!-- /.inner-badge -->
                @endif
                <div class="col-sm-4 pricing text-center">
                    <p>{{$product->nom_avion}} | {{$product->aeroport_depart}}</p>
                    <p>{{$product->lieu_depart}}</p>
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


            <div class="col-12 bottom-content row px-0 mx-0">

                <div class="col-sm-2 flight-logo">
                    <img src="{{ secure_asset('storage/' . $product->image) }}" alt="vol logo" draggable="false">
                </div><!-- /.flight-logo -->
                @if($product->promotion_pourcentage > 0)
                <div class="promotion">
                    réduction de {{ $product->promotion_pourcentage }} %
                </div><!-- /.inner-badge -->
                @endif
                <div class="col-sm-4 pricing text-center">
                    <p>{{$product->nom_avion}} | {{$product->aeroport_arrivee}}</p>
                    <p>{{$product->lieu_arrivee}}</p>
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
        </div><!-- /.bottom-content -->
        <div class="col-md-2 px-0 row">

            <div class="book-now row" style=" float: left;">
                @if($product->promotion_pourcentage == 0)
                <p class="trip text-center col-sm-12" style="font-size: 20px;font-weight: 600;color: rgba(255, 167, 0, 0.79);float: right;3">
                    {{ getPriceHelper($product->prix)}}
                </p>
                @else
                <p class="trip text-center col-sm-12" style="font-size: 20px;font-weight: 600;color: rgba(255, 167, 0, 0.79);float: right;margin-bottom: 0px;">
                    <strike style="font-size: 16px;">
                        {{ getPriceHelper($product->prix)}}
                    </strike>
                </p>
                <p class="trip text-center col-sm-12" style="font-size: 20px;font-weight: 600;color: rgba(255, 167, 0, 0.79);float: right;3">
                    {{ getPriceHelper_Pourcentage($product->prix,$product->promotion_pourcentage)}}
                </p>
                @endif


                <a href="{{ route('vols.show', $product->slug) }}" class="rt-btn  pill rt-gradient text-uppercase mx-auto">Voir</a>

                <div class="flight-detils float-right col-sm-12" style="margin-top: 4rem !important;">
                    <span class="d-block " style="float:right;">
                        <a href="#{{($product->id+33)}}" class="flt-d-clic review right" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{($product->id+33)}}">Détails du vol
                            <i class="icofont-simple-down"></i>
                        </a>
                    </span>
                </div><!-- /.flight-detils -->
            </div><!-- /.book-now -->

        </div>

        <div class="collapse bottom-content container row " id="{{($product->id+33)}}" style="width: 549px;">
            <p style="padding-left: 4%;">
                <span> {{$product->nom_avion}} </span>
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
                    <span><?php echo date("M j,  H:i  ", strtotime( $product->date_depart )); ?></span>

                </li>
                <li class="d-block"><span>{{ $product->aeroport_depart}}</span></li>
                <li class="d-block">
                    <span><?php 
                            echo $jour_mois_arrivee;
                            echo "  ";
                            echo $heur_minute_arrivee;
                            ?>

                    </span>

                </li>
                <li class="d-block"><span>{{ $product->aeroport_arrivee }}</span></li>


            </ul>
            <br>
            <div>Retour</div>
            <ul class="flight-timeline" style="width: 100%;padding-left: 4%;">
                <li class="d-block">
                    <span><?php echo date("M j,  H:i  ", strtotime( $product->date_retour )); ?></span>

                </li>
                <li class="d-block"><span>{{ $product->aeroport_depart}}</span></li>
                <li class="d-block">
                    <span>
                        <?php 
                            echo $jour_mois_arrivee2;
                            echo "  ";
                            echo $heur_minute_arrivee2;
                            ?>

                    </span>

                </li>
                <li class="d-block"><span>{{ $product->aeroport_arrivee }}</span></li>


            </ul>



        </div><!-- /.bottom content -->

    </div><!-- /.flight-box -->

</div><!-- /.col-lg-12 -->
@endif
@endforeach

{{ $vols->appends(request()->input())->links() }}

@endsection