<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="shortcut icon" href="{{ asset('styleAdmin/img/icons/icon-48x48.png') }}" />

    @yield('title-page-admin')

    <link href="{{ asset('styleAdmin/css/app.css')}}" rel="stylesheet">

    <style>
        .table-child-style :nth-child(4) {
            background-color: black;
        }
        .tooltip {
          position: relative;
          display: inline-block;
          border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
          visibility: hidden;
          width: 120px;
          background-color: black;
          color: #fff;
          text-align: center;
          border-radius: 6px;
          padding: 5px 0;

          /* Position the tooltip */
          position: absolute;
          z-index: 1;
        }

        .tooltip:hover .tooltiptext {
          visibility: visible;
        }
    </style>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>




        //Pours bulk delete
        $(document).ready(function() {
            $('#bulk').click(function(){
                var favorite = [];
                $.each($("input[name='row_id']:checked"), function(){
                    favorite.push($(this).val());
                });
                document.getElementById('array_id').value = favorite;       //pass data in input
                if(favorite.length)
                {
                    document.getElementById('confirmer-suppression').innerHTML = "Êtes-vous sûr de vouloir supprimer " +favorite.length+ " colonne?";       
                    document.getElementById('confirmBulk').disabled = false;
                }
                else
                {
                    document.getElementById('confirmer-suppression').innerHTML = "Veuillez selectionner, Appuiyez sur Annuler pour retourner";       
                    document.getElementById('confirmBulk').disabled = true;
                }

            });
        });




    </script>

</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Panneau d'adminstration</span>
                </a>
                    @yield('Tables')


                <div class="sidebar-cta">
                    <div class="sidebar-cta-content" style="text-align: center">
                        <strong class="d-inline-block mb-2">Tir Admin</strong>
                        <div class="mb-3 text-sm">
                            Crée par <br> Gacem & Aymen
                        </div>
                        <a href="" target="_blank" class="btn btn-primary btn-block">Voir Nos Profils</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                @yield('search-data')
                
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align ">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="{{ route('rendezvous.index')}}">
                                <div class="position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell align-middle"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                    @if(\App\OmraRendezVous::count())
                                    <span class="indicator">{{ \App\OmraRendezVous::count() }}</span>
                                    @endif
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                            <div class="position-relative">
                                Soyez le bienvenue
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar img-fluid rounded mr-1" alt="{{Auth::user()->name }}" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('adminProfile.index') }}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="pie-chart"></i> Analytiques</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('home') }}"><i class="align-middle mr-1" data-feather="airplay"></i> Mon Site</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="help-circle"></i> Aide</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </a>
<!-- {{ route('home') }} -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            @if (session('success'))
            <div class="alert alert-success" style="padding: 3%;padding-left: 6%;">
              {{ session('success') }}
            </div>
            @endif
            @if (session('successEdit'))
            <div class="alert alert-success" style="padding: 3%;padding-left: 6%;">
              {{ session('successEdit') }}
            </div>
            @endif
            @if (session('successDelete'))
            <div class="alert alert-danger"  style="padding: 3%;padding-left: 6%;">
              {{ session('successDelete') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger"  style="padding: 3%;padding-left: 6%;">
              {{ session('error') }}
            </div>
            @endif
            @yield('table-content')
            
            
        </div>
    </div>
    <script type="text/javascript">
            $("#callBulk").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
            });
    </script>
    <script src="{{ asset('styleAdmin/js/vendor.js')}}"></script>
    <script src="{{ asset('styleAdmin/js/app.js')}}"></script>

</body>

</html>