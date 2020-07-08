@extends('layouts.master-nofooter')

@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-login relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Réinitialiser le mot de passe
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
                <div class="card-header bg-white text-dark font-weight-bold">{{ __('Réinitialiser le mot de passe') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="text-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-dark font-weight-bold">{{ __('Adresse e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-block btn-warning btn-md text-dark font-weight-bold">
                                    {{ __('Envoyer le lien de réinitialisation') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
