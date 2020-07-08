@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Contacter Nous</title>
@endsection


@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-contacer relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Contacter Nous
                </h1>
                <p class="text-white link-nav"><a href="{{ route('home') }}" class="mr-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('contacter.index') }}" class="ml-3"> Contacter Nous</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->


@endsection

@section('contact-area')
<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
	<div class="container">
		<div class="row">
			<div class="map-wrap" style="width:100%; height: 400px;" id="map"></div>
			<input type="hidden" id="lieu_lat_long" value="{{ \App\Agence::first()->lieu_lat_long}}">

			<div class="col-lg-4 d-flex flex-column address-wrap">
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-home"></span>
					</div>
					<div class="contact-details">
						<h5>Binghamton, New York</h5>
						<p>
							4343 Hinkle Deegan Lake Road
						</p>
					</div>
				</div>
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-phone-handset"></span>
					</div>
					<div class="contact-details">
						<h5>+213 000000000</h5>
						<p>Mon to Fri 9am to 6 pm</p>
					</div>
				</div>
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-envelope"></span>
					</div>
					<div class="contact-details">
						<h5>admin@example.com</h5>
						<p>Send us your query anytime!</p>
					</div>
				</div>														
			</div>
			<div class="col-lg-8">
				<form method="POST" action="/contacter_nous">
					@csrf
					<div class="row">	
						<div class="col-lg-6 form-group">
							
    						<input id="nom" name="nom" type="text" class="form-control mb-4" placeholder="Nom">

    						@error('nom')
    							<div class="text-danger text-xs"> {{ $message }}</div>
    						@enderror
    						
    						<input id="email" name="email" type="email" class="form-control mb-4" aria-describedby="emailHelp" placeholder="Email">

    						@error('email')
    							<div class="text-danger text-xs"> {{ $message }}</div>
    						@enderror

    						<input id="objet" name="objet" type="text" class="form-control mb-4" placeholder="Objet">

    						@error('objet')
    							<div class="text-danger text-xs"> {{ $message }}</div>
    						@enderror

  						</div>	
  						<div class="col-lg-6 form-group">

							<textarea class="common-textarea form-control" name="message" placeholder="Ecrire votre message ici" rows="2" cols="50"></textarea>		

							@error('message')
    							<div class="text-danger text-xs"> {{ $message }}</div>
    						@enderror

    						<div>
    						@if(session('success'))
								<div class="text-xs text-success">
									{{ session('success') }}
								</div>
							@endif	
    						</div>
						</div>

						
						<div class="col-lg-12">
							<div class="alert-msg" style="text-align: left;"></div>
							<button type="submit" class="genric-btn primary" style="float: right;">Envoyer le message</button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>	
</section>
<!-- End contact-page Area -->

@endsection