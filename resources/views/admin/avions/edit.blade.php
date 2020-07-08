@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Modifier un Vol</title>
@endsection

@section('Tables')

    @include('admin.avions.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Modifier un Vol</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Informations</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('adminAvions.update')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="avion_id" value="{{ $avion->id }}">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Titre</label>
                                                <input type="text" class="form-control" name="titre" placeholder="Titre" value="{{ $avion->titre }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Slug</label>
                                                <input type="text" class="form-control" name="slug" placeholder="Slug" value="{{ $avion->slug }}">
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label for="inputState">Nombres des places</label>
                                                <select id="inputState" class="form-control" name="nb_place">
                                                    <option selected="">Avion de {{ $avion->nombre_places }} places</option>
                                                    <option class="row">Avion de 100 places</option>
                                                    <option class="row">Avion de 200 places</option>
                                                    <option class="row">Avion de 300 places</option>
                                                    <option class="row">Avion de 400 places</option>
                                                    
                                                </select>
                                            </div>

                                            
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Etoiles</label>
                                                <input type="number"  min="1" max="5" class="form-control" name="etoiles" placeholder="Etoiles" value="{{ $avion->etoiles }}">
                                            </div>
                                             <div class="form-group col-md-12">
                                                    <label for="inputFirstName">Nom d'avion</label>
                                                    <input type="text" class="form-control" name="nom_avion" placeholder="Nom d'avion" value="{{ $avion->nom_avion }}">
                                            </div>


                                         <div class="form-group col-md-12">
                                                <label for="inputFirstName">lieu de départ</label>
                                                <input type="text" class="form-control" name="lieu_depart" placeholder="lieu de départ" value="{{ $avion->lieu_depart }}">
                                        </div>
                                       <div class="form-group col-md-12">
                                                <label for="inputFirstName">lieu d'arrivée</label>
                                                <input type="text" class="form-control" name="lieu_arrivee" placeholder="lieu d'arrivée" value="{{ $avion->lieu_arrivee}}">
                                        </div>

                                         <div class="form-group col-md-12">
                                                <label for="inputFirstName">Aeroport de départ</label>
                                                <input type="text" class="form-control" name="aeroport_depart" placeholder="Aeroport de départ" value="{{ $avion->aeroport_depart}}">
                                        </div>
                                       <div class="form-group col-md-12">
                                                <label for="inputFirstName">Aeroport d'arrivée</label>
                                                <input type="text" class="form-control" name="aeroport_arrivee" placeholder="Aeroport d'arrivée" value="{{ $avion->aeroport_arrivee}}">
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Date de départ</label>
                                                <input type="datetime-local" class="form-control" name="date_depart" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" placeholder="Date de depart" value="<?php echo str_replace(" ", "T", $avion->date_depart); ?>">
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Date de retoure</label>
                                                <input type="datetime-local" class="form-control" name="date_retour" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" placeholder="Date de retour" value="<?php echo str_replace(" ", "T", $avion->date_retour); ?>">
                                        </div>
                                         <div class="form-group col-md-12">
                                                <label for="inputFirstName">Heurs de Vol</label>
                                                <input type="text" pattern="([0-1][0-9]|2[0-3]):[0-5][0-9]" class="form-control" name="duree_vol" placeholder="HH:mm" value="{{ $avion->duree_vol }}" required>
                                        </div>


                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Prix</label>
                                                <input type="number"  min="1" class="form-control" name="prix" placeholder="Prix" value="{{ $avion->prix }}">
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Promotion</label>
                                                <input type="number" min="0" class="form-control" name="promotion" placeholder="Promotion" value="{{ $avion->promotion_pourcentage }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Délai de promotion</label>
                                                <input type="date" class="form-control" name="delai_promotion" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" placeholder="Delai de promotion" value="{{ $avion->promotion_delai }}">
                                        </div>  
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-2 mt-4 mb-4">
                                                @if($avion->annulation )
                                                <div class="form-group row">    
                                                    <label class="col-form-label col-sm-8 pt-sm-0">Annulation</label>
                                                    <div class="col-sm-4">
                                                        <label class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" class="custom-control-input" name="annulation" checked>
                                                        <span class="custom-control-label"></span>
                                                      </label>
                                                    </div>
                                                </div>
                                                @else 
                                                <div class="form-group row">    
                                                    <label class="col-form-label col-sm-8 pt-sm-0">Annulation</label>
                                                    <div class="col-sm-4">
                                                        <label class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" class="custom-control-input" name="annulation">
                                                        <span class="custom-control-label"></span>
                                                      </label>
                                                    </div>
                                                </div>
                                                @endif
                                                </div>
                                                <div class="col-md-2 mt-4 mb-4">

                                                </div>    
                                                <div class="col-md-8 mt-4 mb-4">

                                                </div>    
                                            </div>            
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label w-100">Image</label>
                                            <div class="mb-1">
                                                <img src="{{secure_asset('storage/' .$avion->image) }}" class="img-thumbnail" width="90">
                                            </div>

                                            <input type="file" name="image" accept="image/*" value="{{ $avion->image }}">

                                            <div class="form-group">
                                                <label class="form-label w-100">Images</label>
                                                <div class="mb-1">
                                                    @if($avion->images)
                                                        @foreach (json_decode($avion->images, true) as $image)
                                                            <img src="{{secure_asset('storage/' . $image)}}" width="70" class="img-thumbnail">
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <input id="images_multiple" type="file" name="images[]" multiple="multiple" accept="image/*" value="{{ $avion->images }}"/>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" placeholder="Description" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;">{{ $avion->description }}</textarea>
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
