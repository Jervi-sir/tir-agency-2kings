@extends('admin.masterAdmin')

@section('title-page-admin')
    <title>Modifier l'Agence</title>
@endsection

@section('Tables')

    @include('admin.agence.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Voitures</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Private info</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('adminAgence.update') }}">
                                            @csrf
                                            <input type="hidden" name="agence_id" value="{{ $agence->id }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputFirstName">Nom de l'Agence</label>
                                                    <input type="text" class="form-control" name="nom_agence" placeholder="Titre" value="{{ $agence->nom_agence }}">
                                                </div>
                                            </div>  
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputFirstName">Email de l'Agence</label>
                                                    <input type="text" class="form-control" name="email" placeholder="Email de l'Agence" value="{{ $agence->email }}">
                                                </div>
                                            </div>    
                                

                                            <div class="form-group">
                                                <label for="inputAddress2">Téléphone</label>
                                                <input type="text" class="form-control" name="telephone" placeholder="Année" value="{{ $agence->telephone }}">
                                            </div>
                                          
                                             <div class="form-group">
                                                <label for="inputAddress">Facebook</label>
                                                <input type="text" class="form-control" name="facebook" placeholder="Facebook" value=" {{json_decode($agence->reseaux_sociaux)[0]}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress2">Twitter</label>
                                                <input type="text" class="form-control" name="twitter" placeholder="Twitter" value=" {{json_decode($agence->reseaux_sociaux)[1]}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress2">Instagram</label>
                                                <input type="text" class="form-control" name="instagram" placeholder="Instagram" value=" {{json_decode($agence->reseaux_sociaux)[2]}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputLastName">LinkedIn</label>
                                                <input type="text" class="form-control" name="linkedin" placeholder="LinkedIn" value=" {{json_decode($agence->reseaux_sociaux)[3]}}">
                                            </div>
                                        
                                            <div class="form-row col-md-12">
                                                <div class="form-group col-md-12">
                                                    <label class="form-label w-100">Logo</label>
                                                    <img class="text-center" src="{{ secure_asset( $agence->logo) }}" width="8%" value="$agence->logo">
                                                </div>

                                                <div class="form-group col-md-12">   
                                                    <input type="file" name="image" id="image" accept="image/*" value="{{ $agence->logo }}">
                                                 </div>    
                                            </div>  
                                                

                                            <div class="form-group">
                                                    <label class="form-label">à propos de l'Agence</label>
                                                    <textarea class="form-control" name="description" placeholder="à propos de l'Agence" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;">{{ $agence->a_propos_agence }}</textarea>
                                            </div>

                                        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
