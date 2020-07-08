@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Copyrights</title>
@endsection


@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Copyrights
                </h1>
                <p class="text-white link-nav"><a href="{{ route('home') }}" class="mr-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('copyrights.index') }}" class="ml-3"> Copyrights </a></p>
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
			<div class="col-lg-12">
				
			</div>
		</div>
	</div>	
</section>
<!-- End contact-page Area -->

@endsection