<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="AdminKit">
    <link rel="shortcut icon" href="{{ secure_asset('styleAdmin/img/icons/icon-48x48.png') }}" />

    @yield('title-page-admin')

    <link href="{{ secure_asset('styleAdmin/css/app.css')}}" rel="stylesheet">

    <style>
        .table-child-style :nth-child(4) {
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle"></span>
                </a>

                <ul class="sidebar-nav">


                    <li class="sidebar-item">
                        <a href="#" data-toggle="" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Voiture</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Hôtels</span>
                        </a>
                        <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Rechercher des Hôtels</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Rechercher des Promotions</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#ui1" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Vols</span>
                        </a>
                        <ul id="ui1" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Rechercher des Vols</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Rechercher des Promotions</a></li>
                        </ul>
                    </li>

                </ul>

                
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Identification</h1>

                    <div class="row">
                        <div class="col-12"></div>
                        <div class="col-6 mx-auto ">
                            <div class="card">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Veuillez s'identifier</h5>
                                    </div>
                                    <div class="card-body col-12 mx-auto">

                        <form class="text-center" method="POST" action="{{ route('login') }}">
                        <a href="{{ route('home') }}"><img src="{{ secure_asset('img/logo.png') }}" class="img-fluid mt-2" alt="" title=""/></a>
                        @csrf
                        <div class="form-group row mt-5">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-dark font-weight-bold">{{ __('Adresse e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control bg-light text-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right text-dark font-weight-bold">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control bg-light text-dark @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-dark font-weight-italic" for="remember">
                                        {{ __('Se souvenir de moi') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-block text-dark font-weight-bold" style="background-color: #28405d80;">
                                    {{ __('S\'identifier') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-between mx-auto">
                                <div class="p-2">
                                @if (Route::has('password.request'))
                                    <a class="btn-link text-secondary font-weight-bold text-xs mx-auto" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                                </div>
                                
                            </div>
                        </div>    
                    </form>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-left">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong></strong></a> &copy;
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ secure_asset('styleAdmin/js/vendor.js')}}"></script>
    <script src="{{ secure_asset('styleAdmin/js/app.js')}}"></script>

</body></html>