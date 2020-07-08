@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Omra</title>
@endsection



@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-omra relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Omra       
                </h1>
                <p class="text-white link-nav"><a href="{{ route('home') }}" class="mr-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('omra.index') }}" class="ml-3"> Omra</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

@endsection



@section('content-noSidebar')

<section class="content-area mt-5">
        @if (session('success'))
        <div class="alert alert-success text-center">
          {{ session('success') }}
        </div>
        @endif
         <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="rt-duel-slider-main rt-mb-30">
                    <div class="single-main rtbgprefix-cover" >
                        <img class="single-main rtbgprefix-cover" src="{{ secure_asset( $omra->image) }}" id="mainImage">
                        <div class="mt-2">
                            @if($omra->images)
                            <img class="img-thumbnail" src="{{ secure_asset( $omra->image) }}"  width="50" >

                                @foreach (json_decode($omra->images, true) as $image)
                                    <img src="{{secure_asset( $image)}}" width="50" class="img-thumbnail">
                                @endforeach
                            @endif
                        </div>
                        <div class="inner-badge badge-bg-1 f-size-14 rt-strong">
                        </div><!-- /.inner-badge -->
                        
                    </div><!-- /.single-main -->
               
                </div><!-- /.rt-duel-slider-main -->
            </div><!-- /.col-lg-7 -->
            <div class="col-lg-5 mt-5 mt-lg-0">
                <div class="hotel-inner-content">
                    <h5 class="f-size-18 rt-medium">{{ $omra->titre }}</h5>
                        <br>
                    <span class="pl-2 text-777"> {{ $omra->lieu }}</span></p>

                    <p class="f-size-14 text-333 mt-3">{{ $omra->options }}</p>

                    <div class="rt-divider style-one rt-mb-30"></div><!-- /.rt-divider -->
                    <div class="d-flex flex-md-row flex-column justify-content-md-between">
                        <span>payment par {{ $omra->type_payment }}</span>
                            <span class="d-block f-size-12 text-878">à partir de</span>
                        <div>
                            <span class="d-block f-size-24 primary-color rt-strong">{{ getPriceHelper($omra->prix) }}</span>
                        </div>

                        

                    </div><!-- /.d-flex -->
                    <div class="d-flex flex-md-row flex-column justify-content-md-between mt-4">
                            <span class="d-block f-size-12 text-878">
                                <ul>
                                    <li>{{ $omra->description }}</li>
                                </ul>
                            </span>
                        </div>
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

                    
        </div><!-- /.row -->
        

        
    </div><!-- /.container -->
     @auth
    <div class="flight-list-box rt-mb-30 pt-30" id="reserver">
                    <h4 class="f-size-24 text-capitalize rt-mb-30  rt-semiblod">Mes Information</h4>
                    <h6 class="text-333 rt-medium">Veuillez entrer vos information <br> pour votre nouveau ticket de réservation d'Omra</h6>
                    <br>
                    <br>
                    <script type="text/javascript">
                       
                    </script>


                <form action="{{ route('omra.rendezvous') }}" id="payment-form"  class="rt-form rt-line-form flight-lable" method="POST">
                    @csrf
                    <input type="hidden" name="omra_id" value="{{ $omra->id }}">


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
                            <input type="text" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" placeholder="telephone" class="form-control" name="telephone" required>
                        </div><!-- /.col-md-6 -->

                    </div><!-- /.row -->


                    @auth
                    <div class="col-md-12 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-warning btn-lg text-light" id="submit">Prenez un rendez-vous</button>
                            </div>
                        </div>
                    </div>
                    @endauth
                    
                </form>
                </div><!-- /.flight-list-box -->
                  @endauth
                 
                </div><!-- /.hotel-text -->

            </div><!-- /.col-lg-5 -->
             @guest
                    <div class="alert-warning text-xs mb-3 p-3 text-center">Veuillez vous connecter pour prendre rendez-vous.</div>
                  @endguest
            <div class="alert-danger text-xs mb-3 p-3 text-center">AVERTISSEMENT: la réservation se fait dans l'agence de voyage.</div>
</section>
@endsection