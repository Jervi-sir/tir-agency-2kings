@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Omra</title>
@endsection


@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-omra relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Omra
                </h1>
                <p class="text-white link-nav"><a href="{{ route('home') }}" class="mr-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('omra.index') }}" class="ml-3"> Omra</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

@endsection

@section('content-noSidebar')   

<div class="container positioned-in-half">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            
            
        </div><!-- /.col-lg-10 -->
    </div><!-- /.row -->
</div><!-- /.container -->

@endsection

@section('contact-area')
@foreach($omras as $product)
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12 mt-4">
            <div class="box-style__1 rt-mb-30">
                <div class="hotel-inner-content row">
                    <div class="hotel-thumb col-md-3 mb-4 mb-md-0">
                        <div class="mb-0">

                            <img src="{{ secure_asset('storage/' . $product->image) }}" class="hotel-bg rtbgprefix-cover">

                            <div class='control-group'>
                                <input class='red-heart-checkbox' id='{{ $product->id+33 }}' type='checkbox'>
                                <label for='{{ $product->id+33 }}'>

                                </label>
                            </div><!-- /.inner-icon -->

                        </div>

                    </div><!-- /.hotel-thumb -->

                    <div class="hotel-text col-md-9">
                        <div class="row top mb-4 mb-md-0">
                            <div class="col-9">
                                <h5 class="left">{{ $product->titre }} </h5>
                                 <span>{{ $product->lieu }}</span>
                            </div>
                        </div><!-- /.top -->
                        <div class="middle-text d-md-flex justify-content-md-between mb-4 mb-md-0 row" style="user-select: none;">
                            <div class="left col-4">
                               <span class="primary-color">
                                    @if($product->etoiles >= 5) Super
                                    @elseif ($product->etoiles >= 3) Excellent
                                    @else Satisfaisante
                                    @endif
                                </span>
                                
                            </div><!-- /.left- -->
                            <div class="col-8 right text-left text-md-right mt-4 mt-md-0">
                                <span class="d-block text-left" style="text-align: right !important;">à partir de </span>
                                <span class="d-block mt-2">{{ getPriceHelper($product->prix) }}</span>

                            </div><!-- /.right -->
                        </div><!-- /.middle-text -->

                        <div class=" footer-elements d-flex justify-content-md-between align-items-center row">
                            <div class="col-8"></div>
                            <div class="left col-4 pr-0">
                                 <a href="{{ route('omra.show', $product->slug) }}" class="rt-btn rt-gradient rt-sm2 pill text-uppercase"  draggable="false">Voir</a>
                            </div><!-- /.right -->

                        </div><!-- /.footer-elements -->

                    </div><!-- /.hotel-text -->
                </div><!-- /.hotel-inner-content -->
            </div><!-- /.hotel-list-box -->
        </div>
        
    </div>
</div>
        
@endforeach

@endsection

