@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Ajouter un Vol</title>
@endsection

@section('Tables')

    @include('admin.avions.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Ajouter un Vol</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Informations</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('adminAvions.ajouter')}}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Titre</label>
                                                <input type="text" class="form-control" name="titre" placeholder="Titre" required>
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label for="inputState">Nombres des places</label>
                                                <select id="inputState" class="form-control" name="nb_place" required>
                                                    <option selected="">Choisir...</option>
                                                    <option class="row">Avion de 100 places</option>
                                                    <option class="row">Avion de 200 places</option>
                                                    <option class="row">Avion de 300 places</option>
                                                    <option class="row">Avion de 400 places</option>
                                                </select>
                                            </div>

<!--                                             <div class="form-group col-md-12">
                                                <label for="inputFirstName">Nombres des places</label>
                                                <input type="number" min="1"  class="form-control" name="nb_place" placeholder="Numero de place">
                                            </div> -->
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Etoiles</label>
                                                <input type="number" min="1" max="5" class="form-control" name="etoiles" placeholder="Etoiles" required>
                                            </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Nom d'avion</label>
                                                <input type="text" class="form-control" name="nom_avion" placeholder="Nom d'avion" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">lieu de départ</label>
                                                <input type="text" class="form-control" name="lieu_depart" placeholder="lieu de départ" required>
                                        </div>
                                       <div class="form-group col-md-12">
                                                <label for="inputFirstName">lieu d'arrivée</label>
                                                <input type="text" class="form-control" name="lieu_arrivee" placeholder="lieu d'arrivée" required>
                                        </div>
                                         <div class="form-group col-md-12">
                                                <label for="inputFirstName">Aeroport de départ</label>
                                                <input type="text" class="form-control" name="aeroport_depart" placeholder="Aeroport de départ" required>
                                        </div>
                                       <div class="form-group col-md-12">
                                                <label for="inputFirstName">Aeroport d'arrivée</label>
                                                <input type="text" class="form-control" name="aeroport_arrivee" placeholder="Aeroport d'arrivée" required>
                                        </div>

                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Date de départ</label>
                                                <input type="datetime-local" class="form-control" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>T00:00" name="date_depart" placeholder="Date de depart" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Date de retour</label>
                                                <input type="datetime-local" class="form-control" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>T00:00" name="date_retour" placeholder="Date de retoure" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Heurs de Vol</label>
                                                <input type="text" pattern="([0-1][0-9]|2[0-3]):[0-5][0-9]" class="form-control" name="duree_vol" placeholder="HH:mm" required >
                                        </div>
                                        

                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Prix</label>
                                                <input type="number" min="1" class="form-control" min="1" name="prix" placeholder="Prix" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Promotion</label>
                                                <input type="number" min="0" class="form-control"  min="0" name="promotion" placeholder="Promotion" value="0">
                                        </div>

                                        <div class="form-group col-md-12">
                                                <label for="inputFirstName">Délai de promotion</label>
                                                <input type="date" class="form-control" name="delai_promotion" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" placeholder="Delai de promotion" value="<?php echo date('Y-m-d',strtotime("-1 days")) ?>">
                                        </div> 
                                        
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-2 mt-4 mb-4">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-8 pt-sm-0">Annulation</label>
                                                        <div class="col-sm-4">
                                                            <label class="custom-control custom-checkbox m-0">
                                                            <input type="checkbox" class="custom-control-input" name="electric">
                                                            <span class="custom-control-label"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mt-4 mb-4">

                                                </div>    
                                                <div class="col-md-8 mt-4 mb-4">

                                                </div>    
                                            </div>            
                                        </div>

                                        

                                        <div class="form-group">
                                            <label class="form-label w-100">Image</label>
                                            <input type="file" name="image" accept="image/*">

                                            <div class="form-group">
                                                <label class="form-label w-100">Images</label>
                                                <input id="images_multiple" type="file" name="images1[]" multiple="multiple" accept="image/*" />
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" placeholder="Description" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
