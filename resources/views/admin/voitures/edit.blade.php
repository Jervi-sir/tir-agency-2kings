@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Modifier une voiture</title>
@endsection

@section('Tables')

    @include('admin.voitures.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Voitures</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0"></h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('adminVoitures.update') }}">
                                            @csrf
                                            <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputFirstName">Titre</label>
                                                    <input type="text" class="form-control" id="inputFirstName" name="titre" placeholder="Titre" value="{{ $voiture->titre }}">
                                                </div>
                                            </div>    
                                            
                                            <div class="form-group">
                                                <label for="inputAddress2">Etoiles</label>
                                                <input type="number"  min="1"  max="5" class="form-control" id="inputAddress2" name="etoiles" placeholder="Etoiles" value="{{ $voiture->etoiles }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress2">Année</label>
                                                <input type="text" class="form-control" id="inputAddress2" name="annee" placeholder="Année" value="{{ $voiture->annee }}">
                                            </div>

                                             <div class="form-group">
                                                <label for="inputAddress">Lieu</label>
                                                <input type="text" class="form-control" id="inputAddress" name="lieu" placeholder="Lieu" value="{{ $voiture->lieu }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress2">Portes</label>
                                                <input type="number"  min="1" class="form-control" id="inputAddress2" name="portes" placeholder="Portes" value="{{ $voiture->portes }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress2">Places</label>
                                                <input type="number"  min="1" class="form-control" id="inputAddress2" name="nombre_places" placeholder="Places" value="{{ $voiture->nombre_places }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputLastName">Prix</label>
                                                <input type="number"  min="1" class="form-control" id="inputLastName" name="prix" placeholder="Prix" value="{{ $voiture->prix }}">
                                            </div>


                                            <div class="form-group">
                                                <label for="inputLastName">Promotion</label>
                                                <input type="number" min="1"  class="form-control" name="promotion" placeholder="Promotion" value="{{ $voiture->promotion_pourcentage }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail4">Délai de promotion</label>
                                                <input type="date" class="form-control" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" name="delai_promotion" placeholder="Delai de promotion" value="{{ $voiture->promotion_delai }}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="inputState">Type de voiture</label>
                                                <select id="inputState" class="form-control" name="type_voiture" value="{{ $voiture->type_voiture }}">
                                                    <option selected="">Choisir...</option>
                                                    <option>Sedan</option>
                                                    <option>Sedan-Mini</option>
                                                    <option>Coupe</option>
                                                    <option>Sport</option>
                                                    <option>Familliale</option>
                                                    <option>4x4</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label w-100">Image</label>
                                                <div class="mb-1">
                                                    <img src="{{secure_asset('storage/' .$voiture->image) }}" class="img-thumbnail" width="90">
                                                </div>
                                                <input type="file" name="image" value="{{ $voiture->image }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label w-100">Images</label>
                                                 <div class="mb-1">
                                                    @if($voiture->images)
                                                        @foreach (json_decode($voiture->images, true) as $image)
                                                            <img src="{{secure_asset('storage/' . $image)}}" width="70" class="img-thumbnail">
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="file" name="images[]" multiple value="{{ $voiture->images }}">
                                            </div>


                                        <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 mt-4 mb-4">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-6 pt-sm-0">Moteur électrique</label>
                                                            <div class="col-sm-4">
                                                                <label class="custom-control custom-checkbox m-0">
                                                                <input type="checkbox" class="custom-control-input" name="electric" value="{{ $voiture->electric }}">
                                                                <span class="custom-control-label"></span>
                                                                </label>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group row">   
                                                            <label class="col-form-label col-sm-6 pt-sm-0">Transmission manuelle</label>
                                                            <div class="col-sm-4">
                                                                <label class="custom-control custom-checkbox m-0">
                                                                    <input type="checkbox" class="custom-control-input" name="manuel" value="{{ $voiture->manuel }}">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">     
                                                            <label class="col-form-label col-sm-6 pt-sm-0">Climatiseur</label>
                                                            <div class="col-sm-4">
                                                                <label class="custom-control custom-checkbox m-0">
                                                                    <input type="checkbox" class="custom-control-input" name="climatiseur" value="{{ $voiture->climatiseur }}">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                            </div>
                                                        </div>   
                                                    </div>

                                                    <div class="col-md-6 text-center mt-4 mb-4">
                                                        <div class="form-group row">    
                                                            <label class="col-form-label col-sm-6 pt-sm-0">Assurance</label>
                                                            <div class="col-sm-4">
                                                                <label class="custom-control custom-checkbox m-0">
                                                                    <input type="checkbox" class="custom-control-input" name="assurance" value="{{ $voiture->assurance }}">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">        
                                                            <label class="col-form-label col-sm-6 pt-sm-0">Kilométrage illimité</label>
                                                            <div class="col-sm-4">
                                                                <label class="custom-control custom-checkbox m-0">
                                                                <input type="checkbox" class="custom-control-input" name="km_illimite" value="{{ $voiture->km_illimite }}">
                                                                <span class="custom-control-label"></span>
                                                              </label>
                                                            </div>
                                                        </div>    
                                                        <div class="form-group row">    
                                                            <label class="col-form-label col-sm-6 pt-sm-0">Annulation</label>
                                                            <div class="col-sm-4">
                                                                <label class="custom-control custom-checkbox m-0">
                                                                <input type="checkbox" class="custom-control-input" name="annulation" value="{{ $voiture->annulation }}">
                                                                <span class="custom-control-label"></span>
                                                              </label>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>    

                                        
                                        <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description" placeholder="Textarea" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;" value="{{ $voiture->description }}"></textarea>
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
