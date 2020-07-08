@extends('layouts.master-nofooter')



@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-login relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    S'identifier
                </h1>
            </div>        
        </div>
    </div>
</section>
<!-- End banner Area -->
@endsection

@section('content')

<div class="container p-lg-5 p-sm-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white">

                <div class="card-header bg-white text-dark font-weight-bold">{{ __('S\'identifier') }}</div>

                <div class="card-body">
                    <form class="text-center" method="POST" action="{{ route('login') }}">
                        <a href="{{ route('home') }}"><img src="{{ secure_asset('storage/' . \App\Agence::first()->logo) }}" class="img-fluid mt-2" alt="" title=""/></a>
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

                                    <label class="form-check-label text-dark font-weight-italic mx-3" for="remember">
                                        {{ __('Se souvenir de moi') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning btn-block text-dark font-weight-bold">
                                    {{ __('S\'identifier') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="p-2">
                                @if (Route::has('password.request'))
                                    <a class="btn-link text-secondary font-weight-bold text-xs" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                                </div>
                                <div class="p-2">
                                    <p class="text-white">y</p>
                                </div>
                                <div class="p-2">
                                    <a class="btn-link text-secondary font-weight-normal text-xs" href="{{ route('register') }}">
                                    {{ __('Vous avez pas un compte? Inscriver-vous maintenant!') }}</a>
                                </div> 
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
