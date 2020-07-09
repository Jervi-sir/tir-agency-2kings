<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ secure_asset( \App\Agence::first()->logo) }}">
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
    <script src="{{ secure_asset('js/vue.min.js') }}"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@yield('extra-script')
        <!--CSS=========================================================== -->
        <link rel="stylesheet" href="{{ secure_asset('css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/jquery-ui.css') }}">             
        <link rel="stylesheet" href="{{ secure_asset('css/nice-select.css') }}">                           
        <link rel="stylesheet" href="{{ secure_asset('css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/owl.carousel.css') }}">              
        <link rel="stylesheet" href="{{ secure_asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/additional.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/checkbox.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/lightpick.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">

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
                            <a href="index.html"><img src="{{ secure_asset( \App\Agence::first()->logo) }}" alt="" title="" /></a>
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
                            <li class="mx-3"><a href="{{ route('voitures.theIndex') }}">Voitures</a></li>

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
                                    <img style="transform: translate(0px,-4px);width: 25px;" src="{{ secure_asset('img/crescent-moon-on-top-of-minaret.png') }}" >

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
    @yield('contact-area')




    <!-- start footer Area + le copyRight de colorLib-->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 class="text-light mb-4">À propos de l'agence</h4>
                        <p>
                            {{ \App\Agence::first()->a_propos_agence}}
                        </p>
                    </div>
                </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 class="text-light mb-4">Liens de navigation</h4>
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li><a href="{{ route('home') }}">Acceuil</a></li>
                                    <li><a href="#">À propos</a></li>


                                    <li><a href="{{ route('vols.index') }}">Vols</a></li>
                                    <li><a href="{{ route('voitures.theIndex') }}">Voitures</a></li>

                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li><a href="{{ route('hotels.index') }}">Hotels</a></li>
                                    <li><a href="#">Confidentialitées</a></li>
                                    <li><a href="#">Conditions générales</a></li>
                                    <li><a href="{{ route('contacter.index') }}">Contacter nous</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 class="text-light mb-4">Lettre de nouvelles</h4>
                        <p>
                            Inscrivez-vous à notre newsletter en nous envoyant votre email.
                        </p>
                        <div id="">
                            <form method="POST" action="/home" class="">


                                <div class="input-group d-flex flex-row">

                                    @csrf

                                    <input id="email" name="email" type="email" class="form-control" placeholder="Entrer votre email">

                                    @error('email')
                                        <div class="text-danger text-xs"> {{ $message }}</div>
                                    @enderror

                                    
                                    <button type="submit" class="btn bb-btn"><span class="lnr lnr-location"></span></button>

                                </div>
                                <div class="mt-2 info">
                                    @if(session('successMail'))
                                        <div class="text-xs text-success">
                                            {{ session('successMail') }}
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 class="text-light mb-20">Site / devise</h4>
                        <ul class="d-flex flex-wrap">
                            <li>
                                <ul class="mb-2">
                                    <div class="control d-flex">
                                        <form action="/home" >    
                                            <select class="bg-dark bg-outline-dark form-control text-light" id="select-1" onchange="doSomething();" name="currency" style="width: 100%;">
                                                @if(session('currency') == "dzd")
                                                <option value="0">Devise</option>
                                                <option value="1" selected>دج  DZD</option>
                                                <option value="2">€ EUR</option>
                                                <option value="3">£ GBP</option>
                                                <option value="4">$ USD</option>

                                                @elseif(session('currency') == "eur")
                                                <option value="0">Devise</option>
                                                <option value="1">دج  DZD</option>
                                                <option value="2" selected>€ EUR</option>
                                                <option value="3">£ GBP</option>
                                                <option value="4">$ USD</option>

                                                @elseif(session('currency') == "gbp")
                                                <option value="0">Devise</option>
                                                <option value="1">دج  DZD</option>
                                                <option value="2">€ EUR</option>
                                                <option value="3" selected>£ GBP</option>
                                                <option value="4">$ USD</option>

                                                @elseif(session('currency') == "usd")
                                                <option value="0">Devise</option>
                                                <option value="1">دج  DZD</option>
                                                <option value="2">€ EUR</option>
                                                <option value="3">£ GBP</option>
                                                <option value="4" selected>$ USD</option>    
                                                @else
                                                <option value="0">Devise</option>
                                                <option value="1" >دج  DZD</option>
                                                <option value="2">€ EUR</option>
                                                <option value="3">£ GBP</option>
                                                <option value="4">$ USD</option>
                                                @endif
                                            </select>
                                            <button class="position-absolute p-1" id="test" type="submit" style="visibility: hidden;">test</button>
                                        </form>
                                    </div>
                                </ul>
                                <ul>
                                    
                                <div id="google_translate_element"></div>    
                                    
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row footer-bottom d-block text-center justify-content-between align-items-center">
                <p class="footer-text m-0">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> Les Services sont creer par <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">Gacem & Aymen</a>
                    <br>Consulter la page "<a href="{{ route('copyrights.index')}}">Copyright</a>" pour les Copyrights
                </p>
                <div class="footer-social text-center">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                </div>
            </div>
        </div>
    </footer>

    @yield('extra-js')

    <script type="text/javascript">
        var selectedElement = document.getElementById('select-1');

        function doSomething()
        {
            var btn = document.getElementById('test');
            console.log('works');
            btn.click();
        }
        


    </script>


    <script src="{{ secure_asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ secure_asset('js/popper.min.js') }}"></script>
    <script src="{{ secure_asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="{{ secure_asset('js/jquery-ui.js') }}"></script>
    <script src="{{ secure_asset('js/easing.min.js') }}"></script>
    <script src="{{ secure_asset('js/hoverIntent.js') }}"></script>
    <script src="{{ secure_asset('js/superfish.min.js') }}"></script>
    <script src="{{ secure_asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ secure_asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ secure_asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ secure_asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ secure_asset('js/mail-script.js') }}"></script>
    <script src="{{ secure_asset('js/main.js') }}"></script>
    <script src="{{ secure_asset('js/additional.js') }}"></script>
    <script async src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ secure_asset('js/moment.min.js') }}"></script>
    <script src="{{ secure_asset('js/lightpick.js') }}"></script>
    <script src="{{ secure_asset('js/demo.js') }}"></script>


</body>
</html>