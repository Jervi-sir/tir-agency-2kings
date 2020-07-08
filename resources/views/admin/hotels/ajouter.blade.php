@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Ajouter un hôtels</title>
@endsection

@section('Tables')

    @include('admin.hotels.sideBar')

@endsection

@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h2 mb-2">Ajouter un hôtel</h1>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title mb-0">Informations</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminHotels.ajouter')}}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre</label>
                                    <input type="text" class="form-control" name="titre" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Lieu</label>
                                <input type="text" class="form-control" name="lieu" placeholder="Lieu">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Etoiles</label>
                                <input type="number" min="1" max="5" class="form-control" name="etoiles" placeholder="Etoiles">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Langues parlées</label>
                                <input type="text" class="form-control" name="language" placeholder="Langues parlées">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Téléphone</label>
                                <input type="text" class="form-control" name="telephone" placeholder="Téléphone">
                            </div>

                            <div class="form-group">
                                <label class="form-label w-100">Image</label>
                                <input type="file" name="image" accept="image/*">
                                <small class="form-text text-muted">Example block-level help text here.</small>

                                <div class="form-group">
                                    <label class="form-label w-100">Images</label>
                                    <input id="images_multiple" type="file" name="images1[]" multiple="multiple" accept="image/*" />
                                    <small class="form-text text-muted">Example block-level help text here.</small>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 mt-4 mb-4">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-4 pt-sm-0">Wifi</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="wifi">
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div> 
                                        <div class="form-group row">   
                                            <label class="col-form-label col-sm-4 pt-sm-0">Gym</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="gym">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">     
                                            <label class="col-form-label col-sm-4 pt-sm-0">Animaux</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="animaux">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>   
                                    </div>

                                    <div class="col-md-6 text-center mt-4 mb-4">
                                        <div class="form-group row">    
                                            <label class="col-form-label col-sm-4 pt-sm-0">Parking</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="parking">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">        
                                            <label class="col-form-label col-sm-4 pt-sm-0">Pisicine</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="piscine">
                                                <span class="custom-control-label"></span>
                                              </label>
                                            </div>
                                        </div>    
                                        <div class="form-group row">    
                                            <label class="col-form-label col-sm-4 pt-sm-0">Annulation</label>
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
                                <textarea class="form-control" name="description" placeholder="Description" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;"></textarea>
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