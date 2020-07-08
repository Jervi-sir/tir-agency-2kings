@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra-script')

  <script src="https://js.stripe.com/v3/"></script>

@endsection


@section('extra-js')

<script type="text/javascript">
    var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
    var elements = stripe.elements();
    var style = {
                    base: {
                            color: "#32325d",
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: "antialiased",
                            fontSize: "16px",
                            "::placeholder": {
                                            color: "#aab7c4"
                                            }
                            },
                            invalid: {
                                    color: "#fa755a",
                                    iconColor: "#fa755a"
                                    }
                };

    var card = elements.create("card", { style: style });
    card.mount("#card-element");
    card.addEventListener('change', ({error}) => {
                const displayError = document.getElementById('card-errors');
                    if (error) {
                                displayError.classList.add('alert', 'alert-warning', 'mt-3');
                                displayError.textContent = error.message;
                            } else {
                                    displayError.classList.remove('alert', 'alert-warning', 'mt-3');
                                    displayError.textContent = '';
                                }
                    });
  
</script>



@endsection


@section('titleSite')
    <title>{{ \App\Agence::first()->nom_agence}} - Caisse</title>
@endsection

@section('bannerArea')
<!-- start banner Area -->
<section class="about-banner relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Paiement
                </h1>
                <p class="text-white link-nav"><a href="{{ route('/') }}" class="mr-3">Accueil </a> <span class="fa fa-angle-right"></span> <a href="#" class="ml-3"> Caisse</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

@endsection



@section('content-noSidebar')

<div class="px-4 px-lg-0 bg-white">
    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-light pb-2">
                    <a href="{{ route('reserver.show') }}" class="btn btn-sm btn-secondary mt-3">Revenir à la liste des réservations</a>
                    <form action="{{ route('paiement.store') }}" id="payment-form">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @if($product2 != null)
                                    <input type="hidden" name="product2_id" value="{{ $product2->id }}">
                                @endif
                                <input type="hidden" name="paymentIntent_id" value="{{ $paymentIntent->id }}">
                                <div class="p-3 rounded bg-secondary text-white mt-5" id="card-element" style="font-weight: 600;">
                                    <!-- Elements will create input elements here -->
                                </div>

                                    <!-- We'll put the error messages in this element -->
                                <div class="mt-2" id="card-errors" role="alert"></div>

                                <button id="submit" class="btn btn-success btn-block mt-4 mb-5">Payer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
