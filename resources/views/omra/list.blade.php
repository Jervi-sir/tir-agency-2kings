@extends('layouts.master')

@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Rendez-vous</title>
@endsection


@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner-omra relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Mes Rendez-vous 
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mr-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="{{ route('cart.index') }}" class="ml-3"> Rendez-vous</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

@endsection

@section('content-noSidebar')
     @if (session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
    </div>
    @endif
@if($rendez_vous->count())
<div class="px-4 px-lg-0 mt-5">

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
                                        <div class="py-2 text-uppercase">Au sujet de </div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Sous le nom de </div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Date de demande</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Date rendez-vous</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Annuler la reservation</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rendez_vous as $meet)
                                <tr>
                                    <td class="border-0 align-middle">
                                        <strong>{{ $meet->omra->titre }}</strong>
                                    </td>
                                    
                                    <td class="border-0 align-middle">
                                        <strong>{{ $meet->nom }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <strong>{{ $meet->created_at }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <strong>{{ $meet->date_rendez_vous }}</strong>
                                    </td>
                                    



                                    <td class="border-0 align-middle">
                                        <form action="{{ route('omra.annulerRendezVous') }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="rendez_vous_id" value="{{ $meet->id }}">

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
                                                                Voulez vous vraiment annuler la réservation?
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
                                    </td>
                                </tr>

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
        <div class=" mx-auto text-xs mx-2 p-3" style="text-align: center;">Vous n'avez Pas Encore Reserver.</div>
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