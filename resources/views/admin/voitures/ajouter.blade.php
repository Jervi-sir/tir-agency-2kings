@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Ajouter une Voiture</title>
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
                        <form action="{{ route('adminVoitures.ajouter')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre</label>
                                    <input type="text" class="form-control" name="titre" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Etoiles</label>
                                <input type="number" min="1" max="5" class="form-control" name="etoiles" placeholder="Etoiles">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Annee</label>
                                <input type="text" class="form-control" name="annee" placeholder="Annee">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Lieu</label>
                                <input type="text" class="form-control" name="lieu" placeholder="Lieu">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Portes</label>
                                <input type="number" min="1" class="form-control" name="portes" placeholder="Portes">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Places</label>
                                <input type="number" min="1" class="form-control" name="places" placeholder="Places">
                            </div>

                            <div class="form-group">
                                <label for="inputLastName">Prix</label>
                                <input type="number" min="1" class="form-control" name="prix" placeholder="Prix">
                            </div>
                            <div class="form-group">

                                <label for="inputLastName">Promotion</label>
                                <input type="number" min="0" class="form-control" name="promotion" placeholder="Promotion">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail4">Délai de promotion</label>
                                <input type="date" class="form-control" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" name="delai_promotion" placeholder="Delai de promotion">
                            </div>

                            <!--mazal-->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputState">Type de voiture</label>
                                    <select name="type_voiture" class="form-control">
                                        <option selected="">Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label w-100">Image</label>
                                <input type="file" name="image" accept="image/*">
                                <small class="form-text text-muted">Example block-level help text here.</small>

                            </div>
                            <div class="form-group">
                                <label class="form-label w-100">Images</label>
                                <input id="images_multiple" type="file" name="images1[]" multiple="multiple" accept="image/*" />
                                <small class="form-text text-muted">Example block-level help text here.</small>
                            </div>


                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 mt-4 mb-4">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-6 pt-sm-0">Moteur électrique</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="electric">
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </div>

                                        </div> 
                                        <div class="form-group row">   
                                            <label class="col-form-label col-sm-6 pt-sm-0">Transmission manuelle</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="manuelle">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">     
                                            <label class="col-form-label col-sm-6 pt-sm-0">Climatiseur</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="climatiseur">
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
                                                    <input type="checkbox" class="custom-control-input" name="assurance">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">        
                                            <label class="col-form-label col-sm-6 pt-sm-0">Kilométrage illimité</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="km_ilimitee">
                                                <span class="custom-control-label"></span>
                                              </label>
                                            </div>
                                        </div>    
                                        <div class="form-group row">    
                                            <label class="col-form-label col-sm-6 pt-sm-0">Annulation</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="annulation">
                                                <span class="custom-control-label"></span>
                                              </label>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Textarea" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;"></textarea>
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