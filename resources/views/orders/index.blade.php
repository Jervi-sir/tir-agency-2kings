@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Réservations</title>
@endsection


@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Mes Réservations
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mr-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('cart.index') }}" class="ml-3"> Réservations</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

@endsection

@section('content-noSidebar')

@if($orders->count())
<div class="px-4 px-lg-0">
    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <!-- Shopping cart table -->
                    <div class="table-responsive" style="overflow-x: hidden;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Service</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Prix</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Date de réservation</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Voir le ticket</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Annuler la réservation</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                @if($order->voiture_id)
                                <tr>

                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{ secure_asset( $order->voiture->image) }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> 
                                                    <a href="{{ route('voitures.show', ['slug' => $order->voiture->slug]) }}" class="text-dark d-inline-block align-middle">
                                                                    <?php 
                                                        echo substr($order->voiture->titre, 0, 30).'...';
                                                         ?>
                                                        </a>
                                                </h5><span class="text-muted font-weight-normal font-italic d-block">Category: Voiture</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <strong>{{ getPriceHelper($order->montant) }}</strong>
                                    </td>
                                    <td class="border-0 align-middle"><strong>{{$order->created_at->format('d-m-Y H:i')}}</strong></td>
                                    <td class="border-0 align-middle">
                                        <a href="{{ route('ticket.showVoiture', $order->voiture->slug) }}" class="rt-btn rt-gradient pill rt-sm3 text-uppercase rt-mt-10">Voir</a>
                                    </td>
                                    <td class="border-0 align-middle">
                                        @if(\Carbon\Carbon::parse($order->date_debut)->addDays(-1) > \Carbon\Carbon::now())
                                        <form action="{{ route('reserver.annulerReservation') }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $order->id }}">
                                            <input type="hidden" name="type_product" value="voiture">
                                            <div >
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="rt-btn rt-gradient pill rt-sm2"  id="{{$loop->iteration - 100}}" 
                                                            onclick="showToConfirm({{$loop->iteration - 100}},{{$loop->iteration + 200}})" style="padding-left: 37%;padding-right: 37%;">
                                                         Annuler
                                                        </button>
                                                    </div>
                                                </div>
                                                    <div class="col-12 px-0 mx-0" style="display: none;" id="{{$loop->iteration + 200}}" >
                                                        
                                                            <div class="col-sm-12">
                                                                Voulez vous vraiment annuler?
                                                            </div>
                                                        <div style="display: flex;">
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="rt-btn  pill rt-sm2 bg-danger text-white"  style="padding: 4px 35px;">Oui</button></div>
                                                            <div class="col-sm-6">
                                                                <button type="button" class="rt-btn  pill rt-sm2 bg-success text-white" onclick="hideTheConfirm({{$loop->iteration - 100}},{{$loop->iteration + 200}})" style="padding: 4px 35px;">Non</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                            </div>
                                            
                                        </form>
                                        @else
                                        <div class="text-danger" style="text-align: center;font-weight: 850;user-select: none;">vous ne pouvez pas annuler <br> malheureusement</div>
                                        @endif
                                    </td>
                                </tr>
                                @elseif($order->place_id)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{ secure_asset( $order->place->avion->image) }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> 
                                                    <a href="{{ route('vols.show', ['slug' => $order->place->avion->slug]) }}" class="text-dark d-inline-block align-middle">
                                                        <?php 
                                                        echo substr($order->place->avion->titre, 0, 30).'...';
                                                         ?>

                                                    </a>
                                                </h5>
                                                <span class="text-muted font-weight-normal font-italic d-block">Category: Place de Vol</span>
                                            </div>
                                        </div>
                                    </th>   

                                    <td class="border-0 align-middle"><strong>{{ getPriceHelper($order->montant) }}</strong></td>
                                    <td class="border-0 align-middle"><strong>{{$order->created_at->format('d-m-Y H:i')}}</strong></td>
                                    <td class="border-0 align-middle">
                                        <a href="{{ route('ticket.showPlace',[ $order->place->avion->slug , $order->place_id]) }}" class="rt-btn rt-gradient pill rt-sm3 text-uppercase rt-mt-10">Voir</a>
                                    </td>

                                   <td class="border-0 align-middle">
                                        @if(\Carbon\Carbon::parse($order->date_debut)->addDays(-1) > \Carbon\Carbon::now())
                                         <form action="{{ route('reserver.annulerReservation') }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $order->id }}">
                                            <input type="hidden" name="type_product" value="place">
                                            <div >
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="rt-btn rt-gradient pill rt-sm2"  id="{{$loop->iteration - 100}}" 
                                                            onclick="showToConfirm({{$loop->iteration - 100}},{{$loop->iteration + 200}})" style="padding-left: 37%;padding-right: 37%;">
                                                         Annuler
                                                        </button>
                                                    </div>
                                                </div>
                                                    <div class="col-12 px-0 mx-0" style="display: none;" id="{{$loop->iteration + 200}}" >
                                                        
                                                            <div class="col-sm-12">
                                                                Voulez vous vraiment annuler?
                                                            </div>
                                                        <div style="display: flex;">
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="rt-btn  pill rt-sm2 bg-danger text-white"  style="padding: 4px 35px;">Oui</button></div>
                                                            <div class="col-sm-6">
                                                                <button type="button" class="rt-btn  pill rt-sm2 bg-success text-white" onclick="hideTheConfirm({{$loop->iteration - 100}},{{$loop->iteration + 200}})" style="padding: 4px 35px;">Non</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                            </div>
                                            
                                        </form>

                                        @else
                                        <div class="text-danger" style="text-align: center;font-weight: 850;user-select: none;">vous ne pouvez pas annuler <br> malheureusement</div>
                                        @endif
                                    </td>
                                </tr>
                                @elseif($order->chambre_id)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{ secure_asset( $order->chambre->image) }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> 
                                                    <a href="{{ route('hotels.show', ['slug' => $order->chambre->slug]) }}" class="text-dark d-inline-block align-middle">
                                                         <?php 
                                                        echo substr($order->chambre->titre, 0, 30).'...';
                                                         ?>
                                                    </a>
                                                </h5>
                                                <span class="text-muted font-weight-normal font-italic d-block">Category: Chambre d'hotel</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>{{ getPriceHelper($order->montant) }}</strong></td>
                                    <td class="border-0 align-middle"><strong>{{$order->created_at->format('d-m-Y H:i')}}</strong></td>
                                    <td class="border-0 align-middle">
                                        <a href="{{ route('ticket.showChambre', $order->chambre->slug) }}" class="rt-btn rt-gradient pill rt-sm3 text-uppercase rt-mt-10">Voir</a>
                                    </td>
                                     <td class="border-0 align-middle">
                                        @if(\Carbon\Carbon::parse($order->date_debut)->addDays(-1) > \Carbon\Carbon::now())
                                         <form action="{{ route('reserver.annulerReservation') }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $order->id }}">
                                            <input type="hidden" name="type_product" value="chambre">
                                            <div >
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="button" class="rt-btn rt-gradient pill rt-sm2"  id="{{$loop->iteration - 100}}" 
                                                            onclick="showToConfirm({{$loop->iteration - 100}},{{$loop->iteration + 200}})" style="padding-left: 37%;padding-right: 37%;">
                                                         Annuler
                                                        </button>
                                                    </div>
                                                </div>
                                                    <div class="col-12 px-0 mx-0" style="display: none;" id="{{$loop->iteration + 200}}" >
                                                        
                                                            <div class="col-sm-12">
                                                                Voulez vous vraiment annuler?
                                                            </div>
                                                        <div style="display: flex;">
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="rt-btn  pill rt-sm2 bg-danger text-white"  style="padding: 4px 35px;">Oui</button></div>
                                                            <div class="col-sm-6">
                                                                <button type="button" class="rt-btn  pill rt-sm2 bg-success text-white" onclick="hideTheConfirm({{$loop->iteration - 100}},{{$loop->iteration + 200}})" style="padding: 4px 35px;">Non</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                            </div>
                                            
                                        </form>

                                        @else
                                        <div class="text-danger" style="text-align: center;font-weight: 850;user-select: none;">vous ne pouvez pas annuler <br> malheureusement</div>
                                        @endif
                                    </td>
                                </tr>
                                
                                @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End -->
                </div>
            </div>

        </div>
    </div>
</div>
@else
<div class="col-md-12 px-0">
    <div class="alert-danger ">
        <div class=" mx-auto text-xs mx-2 p-3" style="text-align: center;">Vous n'avez pas encore réserver.</div>
    </div>
</div>
@endif
<script>    
                                        
    function showToConfirm(annuler,confirmer) 
    {
        var annuler = document.getElementById(annuler);
        var confirmer = document.getElementById(confirmer);
        annuler.style.display = "none";
        confirmer.style.display = "block";
    } 
    function hideTheConfirm(annuler,confirmer) 
    {
        var annuler = document.getElementById(annuler);
        var confirmer = document.getElementById(confirmer);
        annuler.style.display = "block";
        confirmer.style.display = "none";
    }

</script>
@endsection