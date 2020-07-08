@extends('layouts.master2')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Voitures</title>
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



@section('searchForm')   

    @include('partials.searchVoiture')

@endsection



@section('stars')
 <div data-role="page">
    <div id="full-stars-example-two">
        <div class="rating-group">
            <input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" type="radio">
            <label aria-label="1 star" class="rating__label" for="rating3-1">
                <a href="{{ route('voitures.index', ['sort' => request('sort') ,
                                                    'etoiles' => 1,
                                                    'min_prix'=>request('min_prix'),
                                                    'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>
            
            <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
            <label aria-label="2 stars" class="rating__label" for="rating3-2">
                <a href="{{ route('voitures.index', ['sort' => request('sort') ,
                                                    'etoiles' => 2,
                                                    'min_prix'=>request('min_prix'),
                                                    'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
            <label aria-label="3 stars" class="rating__label" for="rating3-3">
                <a href="{{ route('voitures.index', ['sort' => request('sort') ,
                                                    'etoiles' => 3,
                                                    'min_prix'=>request('min_prix'),
                                                    'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
            <label aria-label="4 stars" class="rating__label" for="rating3-4">
                <a href="{{ route('voitures.index', ['sort' => request('sort') ,
                                                    'etoiles' => 4,
                                                    'min_prix'=>request('min_prix'),
                                                    'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>

            <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">

            <label aria-label="5 stars" class="rating__label" for="rating3-5">
                <a href="{{ route('voitures.index', ['sort' => request('sort') ,
                                                    'etoiles' => 5,
                                                    'min_prix'=>request('min_prix'),
                                                    'max_prix'=>request('max_prix')])}}">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </a>
            </label>
            <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">

        </div>
        <label aria-label="0 stars" class="" for="rating3-0">
            <a href="{{ route('voitures.index', ['sort' => request('sort') ,
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


@section('total-recherche')


    <div class="rt-widget widget_rating">
        <h6>{{ $voitures->total() }}  service(s) trouves </h6>
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

@section('sorting')
<div class="container-flex row" style="padding: 0;">
    <div class="col-6 p-0">
        <i class="col-3 fa fa-sort-desc" aria-hidden="true"></i>
        <a class="sort-size col-8" href="{{ route('voitures.index', ['sort'     => 'asc' ,
                                            'etoiles'   => request('etoiles'),
                                            'min_prix'  => request('min_prix'),
                                            'max_prix'  => request('max_prix')])}}">
         ascendant</a>
    </div>
    <div class="col-6 p-0">
    <i class="fa fa-sort-asc col-3" aria-hidden="true"></i>
    <a class="sort-size col-8"  href="{{ route('voitures.index', ['sort'     => 'desc' ,
                                        'etoiles'   => request('etoiles'),
                                        'min_prix'  =>request('min_prix'),
                                        'max_prix'  =>request('max_prix')])}}">
     descendant</a>
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


    <button class="rt-btn rt-gradient rounded-sm rt-sm text-uppercase">Filtrer</button>
</form>
@endsection

@section('result')

<input type="hidden" id="min_prix_for_function" value="{{request('min_prix') ?? $voitures->min('prix') }}">
<input type="hidden" id="max_prix_for_function" value="{{request('max_prix') ?? $voitures->max('prix') }}">

<input type="hidden" id="min_prix_total" value="{{ \App\Voiture::min('prix') }}">
<input type="hidden" id="max_prix_total" value="{{ \App\Voiture::max('prix') }}">

@if(session('currency') == "dzd")
<input type="hidden" id="currency" value="1">
@elseif(session('currency') == "eur")
<input type="hidden" id="currency" value="0.0067">
@elseif(session('currency') == "gbp")
<input type="hidden" id="currency" value="0.0062">
@elseif(session('currency') == "usd")
<input type="hidden" id="currency" value="0.0077">
@endif



@foreach($voitures as $product)

<div class="flight-list-box rt-mb-30">
    <div class="top-content d-flex flex-md-row flex-column justify-content-lg-between">
         <div class="car-thumb mr-4 mr-lg-0 mb-5 mb-md-0" style="max-width: 15em;">
                    <img src="{{ secure_asset( $product->image) }}" alt="image voiture" class="rt-border-primary2">
                    <span class="d-block f-size-13 text-555 " style="margin-bottom: -14px;">Ajoutée le : {{ $product->created_at->format('d/m/Y')  }}</span>
                </div>
                @if($product->promotion_pourcentage > 0)
                <div class="promotion">
                           reduction de {{ $product->promotion_pourcentage }} %
                </div><!-- /.inner-badge -->
                @endif
                <div class="economy mb-5 mb-md-0">
                    <h5 class="f-size-16 rt-medium mt-1">{{ $product->titre }}</h5>
                    <span class="d-block f-size-13 text-555 mt-1">{{ $product->portes }} portes</span>

                    <span class="badge rt-gradinet-badge pill rt-mr-10 mt-2">{{ $product->etoiles}}<small>/5</small></span>
                    <span class="primary-color">
                        @if($product->etoiles >= 5) Super
                        @elseif ($product->etoiles >= 3) Excellent
                        @else Satisfaisante
                        @endif
                    </span>
                    <span class="f-size-12 text-878"></span>
                    
            </div>

        <div class="ck-list">
            <ul class="rt-list">
                <li class="d-block"> {{ $product->nombre_places}} Places
                </li>
                <li class="d-block"> {{ $product->portes}} Portes
                </li>
                <li class="d-block"> Année {{ $product->annee}}
                </li>
                <li class="d-block " style="background-color: #faf2d8;"> {{ $product->type_voiture}}
                </li>
                <li class="d-block">
                </li>
            </ul><!-- /.rt-list -->
        </div><!-- /.ck-list -->
        <div class="price-mant text-lg-right row" style="display: block;">
            <div class="col-12" style="float: left; display: block;">
                        @for ($i = 0;$i < $product->etoiles;$i++)
                        <i class="fa fa-star review"></i>
                        @endfor
            </div>
            <div class="col-12">
                <span class="d-block f-size-12 text-878 col-12" style="float: left;">1 jour pour :<br></span>
                @if($product->promotion_pourcentage == 0)
                <span class="d-block  f-size-24 rt-semiblod title-font col-12">{{ getPriceHelper($product->prix)}}</span>
                @else
                <span class="d-block  f-size-24 rt-semiblod title-font col-12"><strike style="font-size: 16px;">{{ getPriceHelper($product->prix)}}</strike><br>{{ getPriceHelper_Pourcentage($product->prix,$product->promotion_pourcentage) }}</span>
                @endif
                <a href="{{ route('voitures.show', $product->slug) }}" class="rt-btn rt-gradient pill rt-sm3 text-uppercase rt-mt-10 ">Voir</a>
            </div>
        </div><!-- /.price-mant -->
    </div><!-- /.top-content -->
    <div class="bottom-content row">
        <div class="single-discribe col-md-4">
            <h3 class="f-size-16 rt-medium text-424 rt-mb-10">Lieu d'emprunt</h3>
            <p class="f-size-14 line-height-24 text-555">
                {{ $product->lieu }}
            </p>
        </div><!-- /.single-discribe -->
        <div class="single-discribe col-md-4">
            <h3 class="f-size-16 rt-medium text-424 rt-mb-10">Inclus gratuitement</h3>
            <ul class="rt-list">
                <li class="d-block">
                    @if($product->electric)
                    <span class="text-primary rt-mr-3"><i class="fa fa-check-circle"></i> moteur electrique</span>
                    @else
                    <span class="primary-color rt-mr-3"><i class="fa fa-check-circle"></i> moteur fuel</span>
                    @endif
                </li>
                <li class="d-block">
                    @if($product->manuel)
                    <span class="primary-color rt-mr-3"><i class="fa fa-check-circle"></i> transmission manuelle</span>
                    @else
                    <span class="text-primary rt-mr-3"><i class="fa fa-check-circle"></i> transmission automatique</span>

                    @endif
                </li>


                <li class="d-block">
                    @if($product->climatiseur)
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
                    @if($product->assurance)
                    <span class="text-success rt-mr-3"><i class="fa fa-check-circle"></i> avec assurance</span>
                    @else
                    <span class="text-danger rt-mr-3"><i class="fa fa-times-circle"></i> sans assurance</span>
                    @endif
                </li>

                <li class="d-block">
                    @if($product->km_illimite)
                    <span class="text-success rt-mr-3"><i class="fa fa-check-circle"></i> Kilométrage illimite</span>
                    @else<span class="text-danger rt-mr-3"><i class="fa fa-times-circle"></i> Kilométrage limite</span>
                    @endif
                </li>
                <li class="d-block">
                    @if($product->annulation)
                    <span class="text-success rt-mr-3"><i class="fa fa-check-circle"></i> annulation gratuite</span>

                    @else
                    <span class="text-danger rt-mr-3"><i class="fa fa-times-circle"></i> pas d'annulation</span>
                    @endif
                </li>
            </ul><!-- /.rt-list -->
        </div><!-- /.single-discribe -->
    </div><!-- /.bottom-content -->
</div><!-- /.flight-box -->

@endforeach
{{ $voitures->appends(request()->input())->links() }}

@endsection


