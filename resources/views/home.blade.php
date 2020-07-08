@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} </title>
@endsection
    
@section('content-noSidebar')

<!-- banner Area -->

<section class="banner-area relative">
    <!--layer transparent-->           
    <div class="overlay overlay-bg1"></div>
    <!--the content of the area-->
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-between">

            <!--little message-->
            <div class="col-lg-6 col-md-6 banner-left">
                <h6 class="text-white">Loin de la vie monotone</h6>
                <h1 class="text-white">Voyage magique</h1>
                <p class="text-white">
                    si vous cherchez et désirez le meilleur voyage pour vos critères et vos besoins

                </p>
                @guest
                <a href="{{ route('register') }}" class="rt-gradient3 primary-btn  text-uppercase" style="color: rgb(0, 0, 0); font-weight: 750;border-radius: 5px;">Créer un compte Maintenant</a>
                @endguest
            </div>
            <!-- the searchform -->
            @include('partials.searchHome')
        </div>
    
</section>
            <!-- End banner Area -->


<!-- Start price Area -->
<section class="price-area ">

    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <h2>nos <b>Hôtels</b> en tendance</h2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Carousel indicators -->
                        <div class="owl-carousel owl-theme">
                            @foreach($hotels as $product)
                            <div class="item leftToRight">
                                <div class="thumb-wrapper">

                                        <div class="img-box img-hover-zoom" >
                                                 <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="">
                                                 <div class="price">à partir de <span class="review">{{ getPriceHelper($product->chambres->where('occupee',0)->min('prix')) }}</span></div>
                                        </div>
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="thumb-content">
                                            <h4>
                                                <?php 
                                                    echo substr($product->titre, 0, 30).'...';
                                                ?>
                                            </h4>
                                            <div class="star-rating">
                                                @for ($i = 0;$i < $product->etoiles;$i++)
                                                <i class="fa fa-star review"></i>
                                                @endfor
                                            </div>
                                            <div class="row">
                                                <div class="col-5 mx-0 px-0">
                                                    <span class="d-block text-left col-12 mt-1">pour une nuit </span>
                                                </div>
                                                <div class="col-7 mx-0 px-0">
                                                   <span class="d-block mt-2 col-12" style="color: rgba(255, 167, 0, 0.79);font-weight: 600;font-size: 20px;">
                                                    {{ getPriceHelper($product->chambres->min('prix')) }}</span>
                                                </div>
                                            </div>
                                            <p class="item-price">
                                                    <?php 
                                                            echo substr($product->lieu, 0, 25).'...';
                                                     ?>
                                            </p>
                                            <a href="{{ route('hotels.show', $product->slug) }}" class="btn btn-primary">voir l'offre</a>
                                        </div>
                                </div>
                            </div>
                            @endforeach      
                        </div>
                </div>
            </div>
        </div>
    </div>  
 </section>     
    </div>
</section>
<!-- End price Area -->

<!-- Start blog Area -->
<section class="recent-blog-area ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <h2>nos récentes <b>Voitures</b></h2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Carousel indicators -->
                        <div class="owl-carousel owl-theme">
                            @foreach(\App\Voiture::latest()->where('occupee',0)->take(4)->get() as $product)
                            <div class="item leftToRight">
                                <div class="thumb-wrapper">

                                        <div class="img-box img-hover-zoom" >
                                                 <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="">
                                                 <div class="price">à partir de <span class="review">{{ getPriceHelper($product->prix) }}</span></div>
                                        </div>
                                        <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                        <div class="thumb-content">
                                            <h4>{{ $product->titre }}</h4>
                                            <div class="star-rating">
                                                @for ($i = 0;$i < $product->etoiles;$i++)
                                                <i class="fa fa-star review"></i>
                                                @endfor
                                            </div>
                                            <div class="row">
                                                <div class="col-5 mx-0 px-0">
                                                    <span class="d-block text-left col-12 mt-1">pour un jour </span>
                                                </div>
                                                <div class="col-7 mx-0 px-0">
                                                   <span class="d-block mt-2 col-12" style="color: rgba(255, 167, 0, 0.79);font-weight: 600; font-size: 20px;">
                                                    {{ getPriceHelper($product->prix) }}</span>
                                                </div>
                                            </div>
                                            <p class="item-price">
                                                    <?php 
                                                            echo substr($product->lieu, 0, 25).'...';
                                                     ?>
                                            </p>
                                            <a href="{{ route('voitures.show', $product->slug) }}" class="btn btn-primary">voir l'offre</a>
                                        </div>
                                </div>
                            </div>
                            @endforeach      
                        </div>
                </div>
            </div>
        </div>
    </div>  
</section>
<!-- End recent-blog Area -->      

<!-- Start other-issue Area -->
<section class="other-issue-area ">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-9">
                <div class="title text-center">
                    <h1 class="mb-10">Autres rêves dont nous pouvons vous aider</h1>
                    <p>Nous vivons tous à une époque qui nous tient à cœur.<br> une vie dont nous pouvons la réaliser .</p>
                </div>
            </div>
        </div>                  
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="single-other-issue">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ asset('../img/o1.jpg')}}" width="20%" alt="voiture">                   
                    </div>
                    <a href="#">
                        <h4>Louer une voiture</h4>
                    </a>
                    <p>
                        Au-delà du chemin, nous vous proposons de découvrir le charme du voyage sur la route, avec une voiture que vous pouvez vous permettre.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="single-other-issue">
                    <div class="thumb">
                        <img class="img-fluid" src="{{ asset('../img/hotel-4.jpg')}}" width="20%" alt="hotel">                   
                    </div>
                    <a href="#">
                        <h4>Réserver une chambre d'un de nos hôtels</h4>
                    </a>
                    <p>
                       Vous aurez la possibilité de choisir et réserver les chambres de nos meilleures offres, si Vous changez d'avis Vous pouvez également annuler gratuitement avant la date limite.
                    </p>
                </div>
            </div>
        </div>
    </div>  
</section>
<!-- End other-issue Area -->
            

<!-- Start testimonial Area -->
<section class="testimonial-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Avis de nos Clients</h1>
                    <p>Nous nous soucions du plaisir de nos clients<br> et nous les proposons de partager librement leurs expériences avec nos services </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="active-testimonial">
                <div class="single-testimonial item d-flex flex-row">
                    <div class="thumb">
                        <img class="img-fluid" src="img/elements/user1.png" alt="">
                    </div>
                    <div class="desc">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                        </p>
                        <h4>Lorem ipsum</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>                
                        </div>  
                    </div>
                </div>
                <div class="single-testimonial item d-flex flex-row">
                    <div class="thumb">
                        <img class="img-fluid" src="img/elements/user2.png" alt="">
                    </div>
                    <div class="desc">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.                                                </p>
                        <h4>Lorem ipsum</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>            
                        </div>  
                    </div>
                </div>
                <div class="single-testimonial item d-flex flex-row">
                    <div class="thumb">
                        <img class="img-fluid" src="img/elements/user1.png" alt="">
                    </div>
                    <div class="desc">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.             
                        </p>
                        <h4>Lorem ipsum</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>                
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End testimonial Area -->

     
@endsection
