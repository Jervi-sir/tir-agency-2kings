
@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Hotels</title>
@endsection



@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-hotel relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Hotels       
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
    .promotion 
    {
        color: #fff;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ffaa57), to(#fe5c76));
        box-shadow: 0 5px 30px 0 rgba(13, 21, 75, .4);
        position: absolute;
        top: 18px;
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

<section class="content-area mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="rt-duel-slider-main rt-mb-30">
                    <div class="single-main rtbgprefix-cover" >
                        <img class="single-main rtbgprefix-cover" src="{{ secure_asset($hotel->image) }}" id="mainImage">
                        <div class="mt-2">
                            @if($hotel->images)
                            <img class="img-thumbnail" src="{{ secure_asset($hotel->image) }}"  width="50" >

                                @foreach (json_decode($hotel->images, true) as $image)
                                    <img src="{{secure_asset($image)}}" width="50" class="img-thumbnail">
                                @endforeach
                            @endif
                        </div>
                        <div class="inner-badge badge-bg-1 f-size-14 rt-strong">
                           ajoutée le {{ $hotel->created_at->format('d/m/Y')   }}
                        </div><!-- /.inner-badge -->
                        
                    </div><!-- /.single-main -->
               
                </div><!-- /.rt-duel-slider-main -->
            </div><!-- /.col-lg-7 -->
            <div class="col-lg-5 mt-5 mt-lg-0">
                <div class="hotel-inner-content">
                    <h5 class="f-size-18 rt-medium">{{ $hotel->titre }}</h5>
                    <p class="f-size-13"><span class="text-555">( {{ $chambres->total() }} ) pièces libres</span>
                    <br>
                     <span class="pl-2 text-777"> {{ $hotel->lieu }}</span></p>
                     <div class="rt-mt-15 rt-mb-20">
                        <div >
                            <span class="right">
                                @for ($i = 0;$i < $hotel->etoiles;$i++)
                                <i class="fa fa-star review"></i>
                                @endfor
                            </span>
                        </div>    
                    <span class="badge rt-gradinet-badge pill">{{ $hotel->etoiles }} <small>/5</small></span>
                         @if($hotel->etoiles == 5)<span>Super</span>
                            @elseif($hotel->etoiles == 4)<span>Excellent</span>
                                @elseif($hotel->etoiles == 3)<span>Satisfesant</span>
                                    @elseif($hotel->etoiles == 2)<span>Passable</span>
                         @endif          
                         <span></span>
                        
                    </div>
                    <div>
                 
                        </div>
                    <p class="f-size-14 text-333 mt-3">{{ $hotel->options }}</p>
                    <p>
                       <div class="col-8 row">
                    @if($hotel->avec_wifi)
                    <div class="col-6 fa fa-wifi mb-2"> Wifi</div>
                    @endif
                    @if($hotel->avec_parking)
                    <div class="col-6 fa fa-car mb-2"> Parking gratuit</div>
                    @endif
                    @if($hotel->avec_animaux)
                    <div class="col-6 fa fa-paw mb-2">Animaux autorisés</div>
                    @endif
                    @if($hotel->avec_piscine || $hotel->avec_gym)
                        @if($hotel->avec_piscine)
                        <div class="col-6 fa fa-check-square-o mb-2">piscine</div>
                        @endif
                        @if($hotel->avec_gym)
                        <div class="col-6 fa fa-check-square-o mb-2">gym</div>
                        @endif
                    
                    @endif
                </div>
                    </p>
                    <div class="rt-divider style-one rt-mb-30"></div><!-- /.rt-divider -->
                    <div class="d-flex flex-md-row flex-column justify-content-md-between">
                        <span></span>
                            <span class="d-block f-size-12 text-878">à partir de</span>
                        <div>
                            <span class="d-block f-size-24 primary-color rt-strong">{{ getPriceHelper($hotel->chambres->where('occupee',0)->min('prix')) }}</span>
                        </div>

                    </div><!-- /.d-flex -->
                    <div class="rt-divider style-one rt-mt-30"></div><!-- /.rt-divider -->
                    <div class="rt-mt-25">
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

            <div class="col-12 mt-5">
                <div class="hotel-tabs">
                    <div class="flight-list-box rt-mb-40 px-5">
                        <ul class="nav rt-tab-nav-1 pill justify-content-lg-between pl-md-4 pr-md-4 justify-content-center" id="myTab-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " id="rt-itm_1-tab" data-toggle="tab" href="#rt-itm_1" role="tab"
                                    aria-controls="rt-itm_1" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="rt-itm_2-tab" data-toggle="tab" href="#rt-itm_2" role="tab"
                                    aria-controls="rt-itm_2" aria-selected="false" selected>Chambres</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rt-itm_3-tab" data-toggle="tab" href="#rt-itm_3" role="tab"
                                    aria-controls="rt-itm_3" aria-selected="false">Hotel Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rt-itm_4-tab" data-toggle="tab" href="#rt-itm_4" role="tab"
                                    aria-controls="rt-itm_4" aria-selected="false">Services & Amenities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rt-itm_5-tab" data-toggle="tab" href="#rt-itm_5" role="tab"
                                    aria-controls="rt-itm_5" aria-selected="false">Policies</a>
                            </li>

                        </ul>
                    </div><!-- /.hotle-del-box -->
                    
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade " id="rt-itm_1" role="tabpanel" aria-labelledby="rt-itm_1-tab">
                                <div class="flight-list-box rt-mb-30">
                                    <div class="inner-content rt-pl-15">
                                        <h4 class="badge-hilighit color--1 f-size-14 text-white text-font text-uppercase rt-mb-30 rt-mt-15">{{ $hotel->titre }}</h4>
                                        <ul class="rt-list">
                                            {!! $hotel->description !!}
                                        </ul>
                                        <br>
                                        {!! $hotel->description !!}
                                    </div><!-- /.inner-content -->
                                </div><!-- /.flight-list-box -->

                                <div class="googleMap">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116834.1509316622!2d90.34928591742289!3d23.780620653401414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1569663745803!5m2!1sen!2sbd"
                                        width="100%" height="292" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                </div>
                            </div>


                            <div class="tab-pane fade show active" id="rt-itm_2" role="tabpanel" aria-labelledby="rt-itm_2-tab">

                                <div class="box-style__1 rt-light-gray rt-mb-30">
                                    <div class="row">
                                        
                                        <div class="col-md-12 col-lg-12"> 
                                                     <div class="d-flex flex-md-row flex-column justify-content-md-between rt-mb-20 rt-mt-10 row">
                                                        <span class="f-size-16 text-656 title-font rt-medium text-uppercase col-3">Aperçu</span>
                                                        <span class="f-size-16 text-656 title-font rt-medium text-uppercase col-3">Options</span>
                                                        <span class="f-size-16 text-656 title-font rt-medium text-uppercase col-2">Règles</span>
                                                        <span class="f-size-16 text-656 title-font rt-medium text-uppercase col-2">Prix par nuit</span>
                                                        <span class="f-size-16 text-656 title-font rt-medium text-uppercase col-2">Voir les details</span>
                                                     </div>
                                                  
                                                    <div class="row">
                                                        @foreach($chambres as $product)

                                                        <div class="col-lg-12 col-md-6">
                                                            <ul class="rt-list d-flex flex-lg-row flex-column justify-content-md-between box-style__1 rt-light-bg rt-mb-10">
                                                                
                                                                <li class="rt-pt-8 col-3">
                                                                    <span class="d-block">
                                                                        <img src="{{secure_asset( $product->image)}}" alt="hotel iamge" draggable="false" width="100%">
                                                                        <span class="text-333"><i class="icofont-bed"></i> <i class="icofont-bed"></i></span>
                                                                    <span class="d-block"></span>
                                                                    @if($product->promotion_pourcentage > 0)
                                                                    <div class="promotion">
                                                                        Réduction de {{ $product->promotion_pourcentage }} %
                                                                    </div><!-- /.inner-badge -->
                                                                    @endif 
                                                                </li>
                                                                <li class="rt-pt-8 col-3">
                                                                     <p>   
                                                                        <span class="f-size-13 text-333"> {{$product->nb_lit}} lit(s)</span>
                                                                    </p>
                                                                    <p>
                                                                        <span class="rt-mr-5"><img src="assets/images/all-img/hottel-cion-10.png" alt=""></span>
                                                                        <span class="f-size-13 text-333">{{ $product->superficie }} m²</span>
                                                                    </p>
                                                                    <p>
                                                                        <span class="rt-mr-5"><img src="assets/images/all-img/hottel-cion-11.png" alt=""></span>
                                                                        <span class="f-size-13 text-333">etage : {{ $product->etage }} - {{ $product->numero_chambre }}</span>
                                                                    </p>

                                                                    @if($product->avec_enfant )
                                                                    <span class="fa fa-check-circle"> avec enfant</span><br>
                                                                    @else
                                                                    <span class="fa fa-times-circle-o"> sans enfant</span><br>

                                                                    @endif

                                                                    @if($product->repas)
                                                                    <span class="fa fa-check-circle"> avec repat et diner</span>
                                                                    @else
                                                                    <span class="fa fa-times-circle-o"> sans repat et diner</span>
                                                                    
                                                                    @endif
                                                                        
                                                                </li>
                                                                <li class="rt-pt-8 col-2">
                                                                    <p class="f-size-13 text-333 line-height-20">
                                                                        <span class="rt-pr-4">
                                                                        @if($product->annulation)
                                                                        <i class="fa fa-check-circle text-lowercase"></i> avec annulation
                                                                        @else
                                                                        <i class="fa fa-times-circle text-lowercase"></i> pas d'annulation</a>
                                                                         @endif                   
                                                                        </span>
                                                                    </p>     
                                                                    <p class="f-size-13 text-333 line-height-20"><span class="rt-pr-4"><i class="fa fa-check-circle"></i></span>
                                                                        Confirmation instantanée </p>
                                                                    
                                                            
                                                                </li>
                                           @if($product->promotion_pourcentage == 0)
                                            <li class="rt-pt-8 col-2">
                                                <span class="d-block f-size-12 text-878">pour une nuite</span>
                                                <span class="d-block f-size-24 primary-color rt-strong"> </span>
                                                <span class="d-d-block f-size-24 primary-color rt-strong" style="font-weight: 700;font-size: 21px;color: #f8b600; float: right;">{{ getPriceHelper($product->prix)}}</span>
                                                @if(session()->has('hotel_days_search'))
                                                <span class="d-block f-size-12 text-444">pour {{session()->get('hotel_days_search')}} jours</span>
                                                <span class="d-block f-size-12 text-444" style="font-weight: 700;font-size: 21px;color: #f8b600; float: right;">{{ getPriceHelper($product->prix*session()->get('hotel_days_search'))}}</span>
                                                @endif
                                            </li>
                                            @else              
                                            <li class="rt-pt-8 col-2">
                                                <span class="d-block f-size-12 text-878">pour une nuite</span>
                                                <span class="d-block f-size-24 primary-color rt-strong"> </span>
                                                <span class="d-d-block f-size-24 primary-color rt-strong" style="font-weight: 700;font-size: 21px;color: #f8b600; float: right;">
                                                    <strike style="font-size: 16px;">
                                                        {{ getPriceHelper($product->prix)}}
                                                    </strike>
                                                    <br>
                                                    {{ 
                                                    getPriceHelper_Pourcentage($product->prix,$product->promotion_pourcentage)
                                                    }}
                                                </span>
                                                @if(session()->has('hotel_days_search'))
                                                <span class="d-block f-size-12 text-444">pour {{session()->get('hotel_days_search')}} jours</span>
                                                <span class="d-block f-size-12 text-444" style="font-weight: 700;font-size: 21px;color: #f8b600; float: right;">
                                                    {{  getPriceHelper_days_Pourcentage($product->prix,
                                                            session()->get('hotel_days_search'),
                                                            $product->promotion_pourcentage)}}
                                                </span>
                                               


                                                @endif
                                            </li>
                                            @endif
           

                                                                <li class="rt-pt-8 col-2">
                                                                    <a href="{{ route('hotels.showRoom', $product->slug) }}" class="rt-btn rt-gradient rt-sm2 pill text-uppercase">Voir</a>
                                                                    <p class="f-size-13 text-2f7"><span class="rt-pr-5"><i class="icofont-check"></i></span></p>
                                                                </li>
                                                            </ul>
                                                        </div><!-- /.col-lg-12 -->

                                                        @endforeach
                                                        {{ $chambres->appends(request()->input())->links() }}

                                                    </div><!-- /.row -->
                                        </div><!-- /.col-md-9 -->
                                    </div><!-- /.row -->
                                </div><!-- /.flight-list-box -->

                            </div>


                            <div class="tab-pane fade" id="rt-itm_3" role="tabpanel" aria-labelledby="rt-itm_3-tab">

                                <div class="flight-list-box rt-mb-30">
                                    <h3 class="f-size-18 rt-semiblod rt-mt-15 rt-mb-30">Hotel Description</h3>
                                   
                                        <h3 class="f-size-16 rt-semiblod text-uppercase"><span class="rt-mr-15">Opened: 1990</span> <span class="rt-mr-15">Number of rooms: 142</span> Renovated: 2016</h3>
                                    <br>
                                        <p>
                                            À distance de marche de l'un des centres d'affaires et financiers de Hong Kong ainsi que de plusieurs centres commerciaux, le Garden View Hong Kong met la station de tramway Peak, le quartier branché de la discothèque "Lan Kwai Fong" et le jardin zoologique et botanique de Hong Kong à la disposition des clients. des portes. Plusieurs options de transports en commun et la gare centrale MTR sont également à proximité.
                                        </p>
                                    <br>
                                   
                                   <p>
                                        Les chambres et suites spacieuses de l'hôtel surplombant la ville avec vue panoramique sur le jardin, offrent un confort optimal avec un service à un prix raisonnable. Les suites sont équipées d'une cuisine entièrement équipée.
                                   </p>
                                    
                                    
                                </div>
                                <div class="googleMap">
                                    
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29220.818804296498!2d90.37472176549844!3d23.72589036448156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8d73a64e709%3A0x65a4e99bd5bb0ebd!2sOld%20Dhaka%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1570045602199!5m2!1sen!2sbd"
                                            width="100%" height="292" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="rt-itm_4" role="tabpanel" aria-labelledby="rt-itm_4-tab">
                                
                              <div class="flight-list-box">
                                    <div class="inner-content rt-pt-10 rt-pl-15">
                                        <h4 class="f-size-18 rt-semiblod rt-mb-35 ">Services & Amenities</h4>
                                    </div><!-- /.inner-content -->
                                    <div class="media service-amitence-box rt-mb-30">
                                        <img src="assets/images/all-img/hottel-cion-12.png" class="rt-pr-23" alt="hottel-cion">
                                        <div class="media-body rt-pl-23">
                                            <h5 class="f-size-16 rt-semiblod">Transportation Services</h5>
                                            <p class="f-size-13 text-333">
                                                <span class="rt-mr-40"><i class="icofont-check-circled primary-color rt-pr-4"></i> Airport pickup service</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Parking</span>
                                                <span> <i class="icofont-check-circled primary-color"></i> Car rental</span>
                                            </p>
                                        </div>
                                    </div><!-- /.service-amitence-box -->
                                    <div class="media service-amitence-box rt-mb-30">
                                        <img src="assets/images/all-img/hottel-cion-13.png" class="rt-pr-23" alt="hottel-cion">
                                        <div class="media-body rt-pl-23">
                                            <h5 class="f-size-16 rt-semiblod">General</h5>
                                            <p class="f-size-13 text-333">
                                                <span class="rt-mr-40"><i class="icofont-check-circled primary-color rt-pr-4"></i> Free Wi-Fi areas</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Heating</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Elevator</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Newspaper in lobby</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> CCTV in public areas</span> <br>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> CCTV in public areas</span>
                                                <span> <i class="icofont-check-circled primary-color"></i>PA system</span>
                                            </p>
                                        </div>
                                    </div><!-- /.service-amitence-box -->
                                    <div class="media service-amitence-box rt-mb-30">
                                        <img src="assets/images/all-img/hottel-cion-15.png" class="rt-pr-23" alt="hottel-cion">
                                        <div class="media-body rt-pl-23">
                                            <h5 class="f-size-16 rt-semiblod">Food & Drink</h5>
                                            <p class="f-size-13 text-333">
                                                <span class="rt-mr-40"><i class="icofont-check-circled primary-color rt-pr-4"></i> Western restaurant</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Chinese</span>
                                                <span> <i class="icofont-check-circled primary-color"></i>Café</span>
                                            </p>
                                        </div>
                                    </div><!-- /.service-amitence-box -->
                                    <div class="media service-amitence-box rt-mb-30">
                                        <img src="assets/images/all-img/hottel-cion-14.png" class="rt-pr-23" alt="hottel-cion">
                                        <div class="media-body rt-pl-23">
                                            <h5 class="f-size-16 rt-semiblod">Front Desk Services</h5>
                                            <p class="f-size-13 text-333">
                                                <span class="rt-mr-40"><i class="icofont-check-circled primary-color rt-pr-4"></i> Luggage storage</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Porter</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Tourist map</span>
                                                <span class="rt-mr-40"> <i class="icofont-check-circled primary-color"></i> Ticket service</span>
                                                <span> <i class="icofont-check-circled primary-color"></i> Postal service</span>
                                            </p>
                                        </div>
                                    </div><!-- /.service-amitence-box -->
                                    
                              </div><!-- /.flight-list-box -->
                            </div><!-- ./ tab content -->
                            <div class="tab-pane fade" id="rt-itm_5" role="tabpanel" aria-labelledby="rt-itm_5-tab">
                                <div class="flight-list-box rt-mb-30">
                                    <div class="inner-content rt-pt-10 rt-pl-15">
                                        <h4 class="f-size-18 rt-semiblod rt-mb-35 ">Conditions de l'hôtel</h4>
                                    </div><!-- /.inner-content -->

                                    <div class="media service-amitence-box rt-mb-30">
                                        <img src="assets/images/all-img/hottel-cion-17.png" class="rt-pr-23" alt="hottel-cion">
                                        <div class="media-body rt-pl-23">
                                            <h5 class="f-size-16 rt-semiblod">Enfants et lits supplémentaires</h5>
                                            <p class="f-size-13 text-333">    
                                                Les personnes de moins de 18 ans doivent être accompagnées d'un parent ou d'un tuteur légal.

                                            </p>
                                        </div>
                                    </div><!-- /.service-amitence-box -->
                                    <div class="media service-amitence-box rt-mb-30">
                                        <img src="assets/images/all-img/hottel-cion-15.png" class="rt-pr-23" alt="hottel-cion">

                                    </div><!-- /.service-amitence-box -->
                                    <div class="media service-amitence-box rt-mb-30">
                                        <img src="assets/images/all-img/hottel-cion-14.png" class="rt-pr-23" alt="hottel-cion">
                                        <div class="media-body rt-pl-23">
                                            <h5 class="f-size-16 rt-semiblod rt-mb-10">Paying at the Hotel</h5>
                                            <div class="rt-footer-social">
                                                {{ $hotel->type_payment }}
                                            </div>
                                        </div>
                                    </div><!-- /.service-amitence-box -->
                                
                                </div><!-- /.flight-list-box -->
                                <div class="flight-list-box">
                                    <h3 class="f-size-18 rt-semiblod rt-mt-15 rt-mb-30">Annulation</h3>
                                    <h3 class="f-size-14 text-uppercase rt-mt-15 rt-mb-30">ANNULATIONS ET REMBOURSEMENTS</h3>
                                
                                    <h4 class="f-size-14 rt-medium rt-mb-10">Notre faute</h4>
                                    
                                    <p class="f-size-14">
                                        Nous travaillons très dur pour garantir que toutes les visites se déroulent comme prévu et bénéficient d'un taux de réussite de 99%. Lorsqu'une visite est annulée et que c'est la faute de The Shoreditch Pub Crawl ou de l'un des guides indépendants avec lesquels nous travaillons, nous vous rembourserons votre place préacheté et offrirons jusqu'à 100% de la valeur du prix du place d'origine en tant que crédit pour l'achat d'une autre tournée à titre de compensation. Ce crédit ne peut être utilisé d'aucune autre manière et ne sera pas encaissable.
                                    </p>
                                    <br>
                                    <h4 class="f-size-14 rt-medium rt-mb-10">Votre demande</h4>
                                    
                                    <p class="f-size-14">
                                        Si vous ne pouvez pas assister à votre visite et devez annuler une réservation de visite en nous informant au moins 24 heures avant votre visite, nous annulerons votre place et vous créditerons 50% du prix d'achat pour l'achat d'une future visite supplémentaire. Nous n'avons aucune politique de remboursement, sauf si nous sommes responsables de l'annulation de votre visite.
                                    </p>
                                    <br>
                                    <h4 class="f-size-14 rt-medium rt-mb-10">Actes de Dieu</h4>
                                    <p class="f-size-14">
                                        Nous ne pouvons être tenus responsables si nous ne sommes pas en mesure d'offrir une visite en raison de catastrophes naturelles (tsunamis, tremblements de terre, volcanisme
                                         nuages de poussière, extrême
                                         météo, etc.).
                                    </p>
                                
                                
                                </div>
                            </div>
                            <div class="tab-pane fade" id="rt-itm_6" role="tabpanel" aria-labelledby="rt-itm_6-tab">
                                
                                <div class="flight-list-box single-commnets row rt-mb-30">
                                    <div class="col-lg-3 col-md-4  rt-dashed-primary rt-pt-30 rt-pl-30 rt-pb-30 rt-pr-30 rt-dborder-primary rounded">
                                            <div class="cmnt-thumb rt-hw-60 rt-border-primary rounded-circle rtbgprefix-cover rt-mb-20" style="background-image: url(assets/images/all-img/cmnt-2.jpg)">   
                                            </div><!-- /.cmnt-thumb -->
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-ui-calendar rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-edit rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                    </div><!-- /.left-coulmn -->
                                    <div class="col-lg-9 col-md-8 pl-md-5">
                                            <h4 class="f-size-17 rt-strong">Simon Lopez <span class="rt-pl-15 f-size-14"> <i class="icofont-star review"></i><i class="icofont-star review"></i> <i class="icofont-star review"></i><i
                                                    class="icofont-star review"></i> <i class="icofont-star review"></i></span></h4>
                                            <span class="f-size-13 text-878 d-block rt-mb-15">November 20, 2018 at 8:31 pm</span>
                                            <p class="f-size-14 text-333">
                                                I am very please with Garden View Hong Kong Hotel! I will certainly return. I got a wonderful from the 15 floor to the
                                                Botanical Garden a great Supermarket in the corner, about 2 minutes walking, and a bus stop to downtown within few
                                                meters. It is close to downtown and great price!
                                            </p>

                                            <a href="#" class="replay-cmnt text-uppercase rt-strong">Reply <i class="icofont-reply-all"></i> </a>
                                    </div><!-- /.right-column -->
                                </div><!-- /.flight-list-box -->
                                <div class="flight-list-box single-commnets row rt-mb-30">
                                    <div class="col-lg-3 col-md-4  rt-dashed-primary rt-pt-30 rt-pl-30 rt-pb-30 rt-pr-30 rt-dborder-primary rounded">
                                            <div class="cmnt-thumb rt-hw-60 rt-border-primary rounded-circle rtbgprefix-cover rt-mb-20" style="background-image: url(assets/images/all-img/cmnt-3.jpg)">   
                                            </div><!-- /.cmnt-thumb -->
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-ui-calendar rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-edit rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                    </div><!-- /.left-coulmn -->
                                    <div class="col-md-8 col-lg-9 pl-md-5">
                                            <h4 class="f-size-17 rt-strong">Gary Dunn <span class="rt-pl-15 f-size-14"> <i class="icofont-star review"></i><i class="icofont-star review"></i> <i class="icofont-star review"></i><i
                                                    class="icofont-star review"></i> <i class="icofont-star review"></i></span></h4>
                                            <span class="f-size-13 text-878 d-block rt-mb-15">November 20, 2018 at 8:31 pm</span>
                                            <p class="f-size-14 text-333">
                                                I am very please with Garden View Hong Kong Hotel! I will certainly return. I got a wonderful from the 15 floor to the
                                                Botanical Garden a great Supermarket in the corner, about 2 minutes walking, and a bus stop to downtown within few
                                                meters. It is close to downtown and great price!
                                            </p>

                                            <a href="#" class="replay-cmnt text-uppercase rt-strong">Reply <i class="icofont-reply-all"></i> </a>
                                    </div><!-- /.right-column -->
                                </div><!-- /.flight-list-box -->
                                <div class="flight-list-box single-commnets row rt-mb-30">
                                    <div class="col-lg-3 col-md-4  rt-dashed-primary rt-pt-30 rt-pl-30 rt-pb-30 rt-pr-30 rt-dborder-primary rounded">
                                            <div class="cmnt-thumb rt-hw-60 rt-border-primary rounded-circle rtbgprefix-cover rt-mb-20" style="background-image: url(assets/images/all-img/cmnt-4.jpg)">   
                                            </div><!-- /.cmnt-thumb -->
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-ui-calendar rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-edit rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                    </div><!-- /.left-coulmn -->
                                    <div class="col-md-8 col-lg-9 pl-md-5">
                                            <h4 class="f-size-17 rt-strong">Mark Ques <span class="rt-pl-15 f-size-14"> <i class="icofont-star review"></i><i class="icofont-star review"></i> <i class="icofont-star review"></i><i
                                                    class="icofont-star review"></i> <i class="icofont-star review"></i></span></h4>
                                            <span class="f-size-13 text-878 d-block rt-mb-15">November 20, 2018 at 8:31 pm</span>
                                            <p class="f-size-14 text-333">
                                                I am very please with Garden View Hong Kong Hotel! I will certainly return. I got a wonderful from the 15 floor to the
                                                Botanical Garden a great Supermarket in the corner, about 2 minutes walking, and a bus stop to downtown within few
                                                meters. It is close to downtown and great price!
                                            </p>

                                            <a href="#" class="replay-cmnt text-uppercase rt-strong">Reply <i class="icofont-reply-all"></i> </a>
                                    </div><!-- /.right-column -->
                                </div><!-- /.flight-list-box -->
                                <div class="flight-list-box single-commnets row rt-mb-30">
                                    <div class="col-lg-3 col-md-4  rt-dashed-primary rt-pt-30 rt-pl-30 rt-pb-30 rt-pr-30 rt-dborder-primary rounded">
                                            <div class="cmnt-thumb rt-hw-60 rt-border-primary rounded-circle rtbgprefix-cover rt-mb-20" style="background-image: url(assets/images/all-img/cmnt-5.jpg)">   
                                            </div><!-- /.cmnt-thumb -->
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-ui-calendar rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-edit rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                    </div><!-- /.left-coulmn -->
                                    <div class="col-md-8 col-lg-9 pl-md-5">
                                            <h4 class="f-size-17 rt-strong">Mans Livly <span class="rt-pl-15 f-size-14"> <i class="icofont-star review"></i><i class="icofont-star review"></i> <i class="icofont-star review"></i><i
                                                    class="icofont-star review"></i> <i class="icofont-star review"></i></span></h4>
                                            <span class="f-size-13 text-878 d-block rt-mb-15">November 20, 2018 at 8:31 pm</span>
                                            <p class="f-size-14 text-333">
                                                I am very please with Garden View Hong Kong Hotel! I will certainly return. I got a wonderful from the 15 floor to the
                                                Botanical Garden a great Supermarket in the corner, about 2 minutes walking, and a bus stop to downtown within few
                                                meters. It is close to downtown and great price!
                                            </p>

                                            <a href="#" class="replay-cmnt text-uppercase rt-strong">Reply <i class="icofont-reply-all"></i> </a>
                                    </div><!-- /.right-column -->
                                </div><!-- /.flight-list-box -->
                                <div class="flight-list-box single-commnets row rt-mb-30">
                                    <div class="col-lg-3 col-md-4  rt-dashed-primary rt-pt-30 rt-pl-30 rt-pb-30 rt-pr-30 rt-dborder-primary rounded">
                                            <div class="cmnt-thumb rt-hw-60 rt-border-primary rounded-circle rtbgprefix-cover rt-mb-20" style="background-image: url(assets/images/all-img/cmnt-2.jpg)">   
                                            </div><!-- /.cmnt-thumb -->
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-ui-calendar rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                            <span class="d-block f-size-13 text-878"> <span><i class="icofont-edit rt-mr-5"></i></span>Stayed in Nov 2018</span>
                                    </div><!-- /.left-coulmn -->
                                    <div class="col-md-8 pl-md-5">
                                            <h4 class="f-size-17 rt-strong">Sirlon Mika <span class="rt-pl-15 f-size-14"> <i class="icofont-star review"></i><i class="icofont-star review"></i> <i class="icofont-star review"></i><i
                                                    class="icofont-star review"></i> <i class="icofont-star review"></i></span></h4>
                                            <span class="f-size-13 text-878 d-block rt-mb-15">November 20, 2018 at 8:31 pm</span>
                                            <p class="f-size-14 text-333">
                                                I am very please with Garden View Hong Kong Hotel! I will certainly return. I got a wonderful from the 15 floor to the
                                                Botanical Garden a great Supermarket in the corner, about 2 minutes walking, and a bus stop to downtown within few
                                                meters. It is close to downtown and great price!
                                            </p>

                                            <a href="#" class="replay-cmnt text-uppercase rt-strong">Reply <i class="icofont-reply-all"></i> </a>
                                    </div><!-- /.right-column -->
                                </div><!-- /.flight-list-box -->
                            </div>
                        </div>
                    
                </div><!-- /.hotel-tabs -->
            </div><!-- /.col-12 -->
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