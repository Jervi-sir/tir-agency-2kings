<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('storage/' . \App\Agence::first()->logo) }}">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    @yield('titleSite')
    @yield('extra-meta')

    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@yield('extra-script')
        <!--CSS=========================================================== -->
        <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">             
        <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">                           
        <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">              
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/additional.css') }}">
        <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lightpick.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

            @yield('extra-style')
        <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
        </script>
    
</head>
<body >
     <header id="header">
        <div class="header-top pt-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-6 header-top-left">
                        <ul>
                            <li class="nav-item pl-0">
                                <a class=" text-white" href="tel:+2130000000"> <i class="fa fa-phone"></i>{{ \App\Agence::first()->telephone}}</a>
                            </li>
                            <li class="nav-item ml-3 ">

                                <a class="text-white" href="{{ route('contacter.index') }}"><!-- mailto:business-yeee@yeee.com -->
                                    <i class="fa fa-envelope-o"></i> {{ \App\Agence::first()->email}}</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6 header-top-right">
                        <div class="header-social">
                            <div class="row">
                                 <div class="col-7">
                                    <a class="mr-4" href="{{json_decode(\App\Agence::first()->reseaux_sociaux)[0] }}"><i class="fa fa-facebook"></i></a>
                                    <!-- <a class="mr-4" href="#"><i class="fa fa-twitter"></i></a> -->
                                    <a class="mr-4" href="{{json_decode(\App\Agence::first()->reseaux_sociaux)[1] }}"><i class="fa fa-instagram"></i></a>
                                    <a class="mr-4" href="{{json_decode(\App\Agence::first()->reseaux_sociaux)[2] }}"><i class="fa fa-youtube"></i></a>
                                    <a class="mr-0" href="{{json_decode(\App\Agence::first()->reseaux_sociaux)[3] }}"><i class="fa fa-linkedin"></i></a>
                                </div>
                                <div class="col-5">
                                    @include('partials.auth')
                                </div>
                            </div>
                            <!--        
                                <a class="mr-4" href="#">s'identifie</a>
                                <a> | </a>
                                <a class="mr-4" href="#">s'enrengistrer</a>
-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container main-menu">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <div class="row">
                        <div class="col-5">
                            <a href="index.html"><img src="{{ asset('storage/' . \App\Agence::first()->logo) }}" alt="" title="" /></a>
                        </div>
                        <div class="col-6 pl-0">
                            <div class="logo-style"> {{ \App\Agence::first()->nom_agence}}</div>
                        </div>

                    </div>
                </div>

                <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="mx-3"><a href="{{ route('/') }}">accueil</a></li>
                            <li class="mx-3"><a href="{{ route('vols.index') }}">vols</a></li>
                            <li class="mx-3"><a href="{{ route('hotels.index') }}">Hôtels</a></li>
                            <li class="mx-3"><a href="{{ route('voitures.index') }}">Voitures</a></li>

                            <li class="mx-3 nav-item dropdown" style="white-space: normal;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                  Contact
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ route('contacter.index') }}">Contacter nous</a>
                                  <a class="dropdown-item" href="">Confidentialitées</a>
                                  <a class="dropdown-item" href="">À propos</a>
                                </div>
                            </li>
                            <li class="mx-3">
                                <a href="{{ route('omra.index') }}">
                                    <img style="transform: translate(0px,-4px);width: 25px;" src="{{ asset('img/crescent-moon-on-top-of-minaret.png') }}" >

                                    omra</a>
                            </li>

                            <li class="mx-3 nav-item dropdown" style="white-space: normal;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#f8b600;   font-weight: bold;">
                                  promos
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ route('vols.promotion') }}">Vols</a>
                                  <a class="dropdown-item" href="{{ route('hotels.promotion') }}">Hotels</a>
                                  <a class="dropdown-item" href="{{ route('voitures.promotion') }}">Voiture</a>
                                </div>
                            </li>
                        </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->


    @yield('bannerArea')
    @yield('content-noSidebar')
    
    <main class="py-4 bg-light">
        @yield('content')
    </main>

    @yield('extra-js')
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/easing.min.js') }}"></script>
    <script src="{{ asset('js/hoverIntent.js') }}"></script>
    <script src="{{ asset('js/superfish.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/additional.js') }}"></script>
    <script async src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/lightpick.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>


</body>
</html>