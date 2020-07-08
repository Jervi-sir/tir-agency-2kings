@extends('layouts.master-nofooter')

@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-login relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    S'inscrire
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
                <div class="card-header bg-white text-dark font-weight-bold ">{{ __('S\'inscrire') }}</div>

                <div class="card-body">
                    <form class="text-center" method="POST" action="{{ route('register') }}">
                        <a href="{{ route('home') }}"><img src="{{ secure_asset( \App\Agence::first()->logo) }}" class="img-fluid mt-2" alt="" title=""/></a>
                        @csrf

                        <div class="form-group row mt-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-dark font-weight-bold">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control bg-light text-dark @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-dark font-weight-bold">{{ __('Adresse e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control bg-light text-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control bg-light text-dark @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right text-dark font-weight-bold">{{ __('Confirmer le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control bg-light text-dark" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center mt-4">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-block btn-warning btn-md text-dark font-weight-bold">
                                    {{ __('S\'inscrire') }}
                                </button>

                                <a class="btn btn-link text-dark mt-4" href="{{ route('login') }}">
                                    {{ __('Vous avez déja un compte?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
