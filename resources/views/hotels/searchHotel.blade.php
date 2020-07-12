@extends('layouts.master2')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Hôtels</title>
@endsection


@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-hotel relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Hôtels
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mx-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('hotels.index') }}" class="ml-3"> Hôtels</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

@endsection



@section('searchForm')

    @include('partials.searchHotel')

@endsection


@section('stars')
<div data-role="page">
    <div id="full-stars-example-two">
        <div class="rating-group">
            <input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" type="radio">
            <label aria-label="1 star" class="rating__label" for="rating3-1">
                <a href="{{ route('hotels.searchHotel', ['sort'             => request('sort') , 
                                                            'search_hotel_location' => request('search_hotel_location'),
                                                            'nb_personne'    => request('nb_personne'),
                                                            'date_debut'        => request('date_debut'),
                                                            'date_fin'          => request('date_fin'),
                                                            'etoiles'           => 1,
                                                            'min_prix'          =>request('min_prix'),
                                                            'max_prix'          =>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>
            
            <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
            <label aria-label="2 stars" class="rating__label" for="rating3-2">
                <a href="{{ route('hotels.searchHotel', ['sort' => request('sort') ,
                                                        'search_hotel_location' => request('search_hotel_location'),
                                                        'nb_personne' => request('nb_personne'),
                                                        'date_debut' => request('date_debut'),
                                                        'date_fin' => request('date_fin'),
                                                        'etoiles' => 2,
                                                        'min_prix'=>request('min_prix'),
                                                        'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
            <label aria-label="3 stars" class="rating__label" for="rating3-3">
                <a href="{{ route('hotels.searchHotel', ['sort' => request('sort') ,
                                                        'search_hotel_location' => request('search_hotel_location'),
                                                        'nb_personne' => request('nb_personne'),
                                                        'date_debut' => request('date_debut'),
                                                        'date_fin' => request('date_fin'),
                                                        'etoiles' => 3,
                                                        'min_prix'=>request('min_prix'),
                                                        'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
            <label aria-label="4 stars" class="rating__label" for="rating3-4">
                <a href="{{ route('hotels.searchHotel', ['sort' => request('sort') ,
                                                        'search_hotel_location' => request('search_hotel_location'),
                                                        'nb_personne' => request('nb_personne'),
                                                        'date_debut' => request('date_debut'),
                                                        'date_fin' => request('date_fin'),
                                                        'etoiles' => 4,
                                                        'min_prix'=>request('min_prix'),
                                                        'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
            <label aria-label="5 stars" class="rating__label" for="rating3-5">
                <a href="{{ route('hotels.searchHotel', ['sort' => request('sort') ,
                                                        'search_hotel_location' => request('search_hotel_location'),
                                                        'nb_personne' => request('nb_personne'),
                                                        'date_debut' => request('date_debut'),
                                                        'date_fin' => request('date_fin'),
                                                        'etoiles' => 5,
                                                        'min_prix'=>request('min_prix'),
                                                        'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
        </div>
         <label aria-label="0 stars" class="" for="rating3-0">
            <a href="{{ route('hotels.searchHotel', ['sort' => request('sort') ,
                                                        'search_hotel_location' => request('search_hotel_location'),
                                                        'nb_personne' => request('nb_personne'),
                                                        'date_debut' => request('date_debut'),
                                                        'date_fin' => request('date_fin'),
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
    .promotion 
    {
        color: #fff;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ffaa57), to(#fe5c76));
        box-shadow: 0 5px 30px 0 rgba(13, 21, 75, .4);
        position: absolute;
        top: -9px;
        left: 6px;
        padding: 3px 11px;
        border-top-right-radius: 210px;
        border-bottom-right-radius: 999px;
        font-weight: 500;
        font-size: 11px;
        z-index: 99;
    }

</style>
@endsection
@section('total-recherche')


    <div class="rt-widget widget_rating">
        <h6>{{ $hotels->total() }}  service(s) trouvés </h6>
            
    </div>


@endsection

@section('sorting')
<div class="container-flex row" style="padding: 0;">
    <div class="col-6 p-0">
        <i class="col-3 fa fa-sort-desc" aria-hidden="true"></i>
    <a class="sort-size col-8" href="{{ route('vols.searchVol', ['sort' => 'asc' ,
                                        'search_hotel_location' => request('search_hotel_location'),
                                        'nb_personne' => request('nb_personne'),
                                        'date_debut' => request('date_debut'),
                                        'date_fin' => request('date_fin'),
                                        'etoiles' => request('etoiles'),
                                        'min_prix'=>request('min_prix'),
                                        'max_prix'=>request('max_prix')])}}">
    ascending</a>
    </div>
    <div class="col-6 p-0">
    <i class="fa fa-sort-asc col-3" aria-hidden="true"></i>
    <a class="sort-size col-8" href="{{ route('vols.searchVol', ['sort'     => 'desc' ,
                                        'search_hotel_location' => request('search_hotel_location'),
                                        'nb_personne' => request('nb_personne'),
                                        'date_debut' => request('date_debut'),
                                        'date_fin' => request('date_fin'),
                                        'etoiles' => request('etoiles'),
                                        'min_prix'=>request('min_prix'),
                                        'max_prix'=>request('max_prix')])}}">
    descending</a>
    </div>
</div>
@endsection


@section('price_range_submit')
<form action="{{route('vols.searchVol')}}">
    <input id="min_prix" type="hidden" name="min_prix">
    <input id="max_prix" type="hidden" name="max_prix">
    @if(request('sort') != null)
    <input type="hidden" name="sort" value="{{request('sort')}}">
    @endif
    @if(request('etoiles') != null)
    <input type="hidden" name="etoiles" value="{{request('etoiles')}}">
    @endif    
    @if(request('sort') != null)
    <input type="hidden" name="sort" value="{{request('sort')}}">
    @endif
    @if(request('search_hotel_location') != null)
    <input type="hidden" name="search_hotel_location" value="{{request('search_hotel_location')}}">
    @endif
    @if(request('nb_personne') != null)
    <input type="hidden" name="nb_personne" value="{{request('nb_personne')}}">
    @endif
    @if(request('date_debut') != null)
    <input type="hidden" name="date_debut" value="{{request('date_debut')}}">
    @endif
    @if(request('date_fin') != null)
    <input type="hidden" name="date_fin" value="{{request('date_fin')}}">
    @endif


    <button class="rt-btn rt-gradient rounded-sm rt-sm text-uppercase" onclick="send_price_range()">Filtrer</button>
</form>
@endsection

@section('result')
<input type="hidden" id="min_prix_for_function" value="{{request('min_prix') ?? $hotels->min('prix') }}">
<input type="hidden" id="max_prix_for_function" value="{{request('max_prix') ?? $hotels->max('prix') }}">

<input type="hidden" id="min_prix_total" value="{{ \App\Hotel::min('prix') }}">
<input type="hidden" id="max_prix_total" value="{{ \App\Hotel::max('prix') }}">

@if(session('currency') == "dzd")
<input type="hidden" id="currency" value="1">
@elseif(session('currency') == "eur")
<input type="hidden" id="currency" value="0.0067">
@elseif(session('currency') == "gbp")
<input type="hidden" id="currency" value="0.0062">
@elseif(session('currency') == "usd")
<input type="hidden" id="currency" value="0.0077">
@endif

@foreach($hotels as $product)
@if($product->chambres->where('occupe','=',0))
<div class="box-style__1 rt-mb-30">
    <div class="hotel-inner-content row">
        <div class="hotel-thumb col-md-4 mb-4 mb-md-0 mx-auto">
            <div  class="mb-0">

                <img src="{{ secure_asset($product->image) }}" class="hotel-bg rtbgprefix-cover">
                @if($promo = $product->chambres->where('occupee',0)->where('promotion_pourcentage', '>', 0)->count())
                <div class="promotion">
                           ( {{$promo}} ) chambres en promotion
                </div><!-- /.inner-badge -->
                @endif                   
                <p class="text-left mb-0 " style="font-size: 10px;">Ajoutée le  : {{ $product->created_at->format('d/m/Y')  }}</p>

                <!-- <div class='control-group'>
                    <input class='red-heart-checkbox' id='{{ $product->id+33 }}' type='checkbox'>
                    <label for='{{ $product->id+33 }}'>

                    </label>
                </div>-->

            </div>

        </div><!-- /.hotel-thumb -->
        <div class="hotel-text col-md-5">
            <div class="row top mb-4 mb-md-0 text-center">
                
                <div class="col-12 mb-2">
                    <h5 class="left mb-1">{{ $product->titre }} </h5>
                    <p>( {{ $product->chambres->where('occupee','=',0)->count() }} ) pièces libres 
                        <br>
                        <span> {{ $product->lieu }}</span>
                    </p>
                </div>
                
            </div><!-- /.top -->
            <div class="middle-text d-md-flex justify-content-md-between mb-4 mt-1 mb-md-0" style="user-select: none;">
                <div class="left">
                    <div class="mb-2">
                        <span class="badge rt-gradinet-badge pill">{{ $product->etoiles }} <small>/5</small></span>
                        <span class="primary-color">
                        @if($product->etoiles >= 5) Super
                        @elseif ($product->etoiles >= 3) Excellent
                        @else Satisfaisante
                        @endif
                        </span>
                        <span></span>
                    </div>
                  
                    <div class="col-12 mb-3">
                        @if($product->annulation)
                        <a href="#" class="text-lowercase" style="pointer-events: none;
                                            cursor: default;"> avec annulation</a>
                        @else
                        <a href="#" class="text-lowercase" style="color: #af323e;
                                            border: 1px dashed #dc3545;
                                             border-radius: 999px;
                                            pointer-events: none;
                                            cursor: default;">
                                         pas d'annulation</a>
                         @endif                   
                    </div>
                    
                </div><!-- /.left- -->

            </div><!-- /.middle-text -->
            <div class=" footer-elements d-flex justify-content-md-between align-items-center">
                <div class="col-lg-12  row">
                    @if($product->avec_wifi)
                    <div class="col-6 fa fa-wifi mb-2"> Wifi</div>
                    @endif
                    @if($product->avec_parking)
                    <div class="col-6 fa fa-car mb-2"> Parking gratuit</div>
                    @endif
                    @if($product->avec_piscine || $product->avec_gym)
                        @if($product->avec_piscine)
                        <div class="col-6 fa fa-check-square-o mb-2">Piscine</div>
                        @endif
                        @if($product->avec_gym)
                        <div class="col-6 fa fa-check-square-o mb-2">Gym</div>
                        @endif
                    
                    @endif
                    @if($product->avec_animaux)
                    <div class="col-6 fa fa-paw mb-2">Animaux autorisés</div>
                    @endif
                </div>
          

            </div><!-- /.footer-elements -->

        </div><!-- /.hotel-text -->
        <div class="hotel-text col-md-3">
             <div class="right text-left text-md-right mt-md-0 text-center">
                    <div class="col-12">
                        <div class="right" style="float: left;">
                            @for ($i = 0;$i < $product->etoiles;$i++)
                            <i class="fa fa-star review"></i>
                            @endfor
                        </div>
                    </div>
                        
                    <span class="d-block text-left col-12 mt-3 mb-2" style="float: left;">à partir de </span>
                    <span class="d-block mt-2 col-12" style="color: rgba(255, 167, 0, 0.79);font-weight: 600;font-size: 24px;">
                        {{ getPriceHelper($product->chambres->min('prix')) }}</span>
                    <span class="d-block text-left col-12 mt-1 mb-5" style="left: 43%;">pour une nuit </span>

                </div><!-- /.right -->

                <div class="right pr-0 col-12 mt-5 text-center">
                     <a href="{{ route('hotels.show', $product->slug) }}" class="mt-1 rt-btn rt-gradient rt-sm2 pill text-uppercase "  draggable="false">Voir</a>
                </div><!-- /.right -->


        </div>    
    </div><!-- /.hotel-inner-content -->
</div><!-- /.hotel-list-box -->
@endif
@endforeach


{{ $hotels->appends(request()->input())->links() }}

@endsection