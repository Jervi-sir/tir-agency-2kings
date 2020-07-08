                        @guest
                                <a href="{{ route('login') }}">{{ __('s\'identifier') }}</a>
                                <a> | </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">{{ __('s\'enrengistrer') }}</a>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="list-style-type:none;"
>
                              
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="padding-top: 0px; padding-bottom: 0px;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role_id != 2)
                                    <a class="dropdown-item" href="{{ route('adminProfile.index')}}">Panneau Administrateur</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('reserver.show')}}">Mes commandes</a>
                                    @if(\App\OmraRendezVous::where('user_id',Auth::user()->id)->count())
                                    <a class="dropdown-item" href="{{ route('omra.list')}}">Ma reservation d'Omra</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
<!-- {{ route('home') }} -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest