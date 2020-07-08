@extends('layouts.master')

@section('content-noSidebar')
<!-- start searchForm -->
<div class="container positioned-in-half">
	<div class="row">
		<div class="col-lg-10 mx-auto">
			<div class="rt-banner-searchbox flight-search wow fade-in-bottom" data-wow-duration="1s" data-wow-delay="1s">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane show active" id="rt-item_a_first" role="tabpanel" aria-labelledby="rt-item_a_first">

						@yield('searchForm')
					</div>
				</div>
			</div><!-- /.rt-banner-searchbox -->
		</div><!-- /.col-lg-10 -->
	</div><!-- /.row -->
</div><!-- /.container -->

<!-- /end searchForm -->
@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif


@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul class="mb-0 mt-0">
      @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif


<!-- start Result List -->
<section class="destinations-area section-gap1">
    <div class="container">
        <div class="container">
            <div class="tab-pane rtIncative fade-in-bottom" id="rt-item_b_four" role="tabpanel" aria-labelledby="rt-item_b_four">
                <div class="row">

                    <!-- start sideBar -->
                    <div class="col-lg-3  my-3 col-md-12 ">
                        <div class="rt-sidebar-group pr-0 mr-0">

                            <!-- Panier -->
                            @auth
                            <div class="rt-widget widget_rating">
                                <a href="{{ route('reserver.show') }}">
                                    <h4>Réservation<span class="badge badge-pill badge-dark ml-2"> {{ \App\Reservation::where('user_id','=',Auth::user()->id)->count() }}</span></h4>
                                </a>
                            </div>
                             @endauth
                            @yield('total-recherche')

                            <!-- Stars Rating -->
                            <div class="rt-widget widget_rating">
                                <h3 class="rt-widget-title">
                                    Trier par étoiles
                                </h3><!-- /.rt-widget-title -->
                                <ul>
                                    @yield('stars')
                                </ul>
                            </div>
                            <div class="rt-widget widget_range-slider">
                                <h3 class="rt-widget-title" style="margin: 0;padding: 0;">
                                    Tri de prix
                                </h3><!-- /.rt-widget-title -->
                                @yield('sorting')

                            </div>
                            <!-- Price Range -->

                            <div class="rt-widget widget_range-slider">
                                <h3 class="rt-widget-title">
                                    Filtrer le prix
                                </h3>
                                <div class="wrapper mt-5">
                                    <div class="container">
                                        <div class="slider-wrapper">
                                            <div id="slider-range"></div>
                                                <div  class="range-wrapper">
                                                
                                                    <div class="range">
                                                        <span id="range-start" class="range-value range1"  style="width: 4em;">
                                                          
                                                        </span>
                                                        @if(session('currency') == "dzd")
                                                        <sup>DA</sup>
                                                        @elseif(session('currency') == "eur")
                                                        <sup>€</sup>
                                                        @elseif(session('currency') == "gbp")
                                                        <sup>£</sup>
                                                        @elseif(session('currency') == "usd")
                                                        <sup>$</sup>
                                                        @endif

                                                        <span class="range-divider"></span>

                                                        <span id="range-end" class="range-value range2"  style="width: 4em;">
                                                            
                                                        </span>
                                                        @if(session('currency') == "dzd")
                                                        <sup>DA</sup>
                                                        @elseif(session('currency') == "eur")
                                                        <sup>€</sup>
                                                        @elseif(session('currency') == "gbp")
                                                        <sup>£</sup>
                                                        @elseif(session('currency') == "usd")
                                                        <sup>$</sup>
                                                        @endif
                                                    </div>

                                                    <div class="range-alert">+</div>
                                                    <div class="gear-wrapper">
                                                        <div class="gear-large gear-one">
                                                            <div class="gear-tooth"></div>
                                                            <div class="gear-tooth"></div>
                                                            <div class="gear-tooth"></div>
                                                            <div class="gear-tooth"></div>
                                                        </div>
                                                        <div class="gear-large gear-two">
                                                            <div class="gear-tooth"></div>
                                                            <div class="gear-tooth"></div>
                                                            <div class="gear-tooth"></div>
                                                            <div class="gear-tooth"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="slider-range"></div>
                                <br>
                                <div class="text-center">
                                    @yield('price_range_submit')
                                </div>
                            </div> 

                            <script type="text/javascript">
                                function send_price_range() 
                                {
                                    var min_prix_char = document.getElementById('range-start-genuine').innerHTML;
                                    var max_prix_char = document.getElementById('range-end-genuine').innerHTML;

                                    var min_prix = parseFloat(min_prix_char.replace(",",""));
                                    var max_prix = parseFloat(max_prix_char.replace(",",""));

                                    document.getElementById('min_prix').value = min_prix;
                                    document.getElementById('max_prix').value = max_prix;
                                }
                               
                            </script>

                        </div><!-- /.rt-sidebar-group -->
                    </div><!-- /.col-lg-3 -->
                    <!-- /end sideBar -->


                     <!----------------------PreLoader----------------->
                        <div id="pre-loader-infinit">
                            <svg version="1.1" id="preloader" x="0px" y="0px" width="240px" height="120px" viewBox="0 0 240 120" style="z-index: 1000;">

                            <style type="text/css" >
                                <![CDATA[

                                    #plug,
                                    #socket { fill:#FDB515 }

                                    #loop-normal { fill: none; stroke: #f8b600; stroke-width: 12 }
                                    #loop-offset { display: none }

                                ]]>
                            </style>

                            <path id="loop-normal" class="st1" d="M120.5,60.5L146.48,87.02c14.64,14.64,38.39,14.65,53.03,0s14.64-38.39,0-53.03s-38.39-14.65-53.03,0L120.5,60.5
                            L94.52,87.02c-14.64,14.64-38.39,14.64-53.03,0c-14.64-14.64-14.64-38.39,0-53.03c14.65-14.64,38.39-14.65,53.03,0z">
                                <animate attributeName="stroke-dasharray" attributeType="XML"
                                    from="500, 50"  to="450 50"
                                    begin="0s" dur="2s"
                                    repeatCount="indefinite"/>
                                <animate attributeName="stroke-dashoffset" attributeType="XML"
                                    from="-40"  to="-540"
                                    begin="0s" dur="2s"
                                    repeatCount="indefinite"/>  
                            </path>
                              
                            <path id="loop-offset" d="M146.48,87.02c14.64,14.64,38.39,14.65,53.03,0s14.64-38.39,0-53.03s-38.39-14.65-53.03,0L120.5,60.5
                            L94.52,87.02c-14.64,14.64-38.39,14.64-53.03,0c-14.64-14.64-14.64-38.39,0-53.03c14.65-14.64,38.39-14.65,53.03,0L120.5,60.5
                            L146.48,87.02z"/>
                              
                            <path id="socket" d="M7.5,0c0,8.28-6.72,15-15,15l0-30C0.78-15,7.5-8.28,7.5,0z"/>  
                              
                            <path id="plug" d="M0,9l15,0l0-5H0v-8.5l15,0l0-5H0V-15c-8.29,0-15,6.71-15,15c0,8.28,6.71,15,15,15V9z"/>
                              
                            <animateMotion
                                xlink:href="#plug"
                                dur="2s"
                                rotate="auto"
                                repeatCount="indefinite"
                                calcMode="linear"
                                keyTimes="0;1"    
                                keySplines="0.42, 0, 0.58, 1">
                                <mpath xlink:href="#loop-normal"/>
                            </animateMotion>
                              
                            <animateMotion             
                                xlink:href="#socket"
                                dur="2s"
                                rotate="auto"
                                repeatCount="indefinite"
                                calcMode="linear"
                                keyTimes="0;1"
                                keySplines="0.42, 0, 0.58, 1">
                                <mpath xlink:href="#loop-offset"/>
                            </animateMotion>  
                            </svg>
                           
                        </div>
                     <!--------------------------------------------------->

                    <!-- start Result Offers -->
                    <div class="col-lg-9 my-3 col-md-12">
                        <!----------------------PreLoader----------------->
                        <div id="pre-loader-bg" class="pre-loader pre-loader-lay" style="z-index: 200;"></div>

                     <!--------------------------------------------------->

                        @yield('result')
                    </div><!-- /.col-lg-3 -->
                    <!-- /end Result Offers -->

                </div><!-- /.row -->
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">

     setTimeout(function(){ 
        document.getElementById('pre-loader-infinit').style.display ="none";
        document.getElementById('pre-loader-bg').style.display ="none";
     }, 4000);

</script>
<!-- /end Result List -->
@endsection

@section('extra-style')
<style type="text/css">

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

    input.circle-range-select
    {
        display:none
    }

    .circle-range-select-wrapper
    {
        position:relative;
        max-width:100%;
        width:10em;
        height:10em;
        margin:1em;
        border-radius:50%;
        border:.8em solid #ccc;
        padding:0!important;
        cursor:default;
    }

    .circle-range-select-wrapper .handle
    {
        position:absolute;
        z-index:2;
        width:0;
        height:0;
        border:0;
        padding:0;
        cursor:pointer;
    }

    .circle-range-select-wrapper .handle:before
    {
        content:'';
        position:absolute;
        z-index:3;
        top:-1em;
        left:-1em;
        height:2em;
        width:2em;
        border-radius:50%;
        background:#000;
    }

    .circle-range-select-wrapper .selected-range
    {
        position:absolute;
        z-index:1;
        color:#0ff;
    }

    .circle-range-select-wrapper .values
    {
        position:absolute;
        z-index:2;
        top:50%;
        margin-top:-.5em;
        width:100%;
        font-size:.85rem;
        text-align:center;
    }


</style>
@endsection
