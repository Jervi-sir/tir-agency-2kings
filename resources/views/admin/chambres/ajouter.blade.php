@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Ajouter une chambre</title>
@endsection

@section('Tables')

    @include('admin.chambres.sideBar')

@endsection


@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h2 mb-2">Ajouter une chambre</h1>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title mb-0">Informations</h3>
                    </div>
                    <div class="card-body">
                          <form action="{{ route('adminChambres.ajouter')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputAddress2">Nombre de copie de chambres </label>
                                    <input type="number" class="form-control" min="1" value="1" name="nb_chambres" placeholder="Nombre de copie de chambres">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre</label>
                                    <input type="text" class="form-control" name="titre" placeholder="Titre" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputAddress2">Lits</label>
                                    <input type="number" min="1" class="form-control" name="nb_lit" placeholder="Lits" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputAddress2">Superficie</label>
                                    <input type="text" class="form-control" name="superficie" placeholder="Superficie">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="inputLastName">Prix</label>
                                    <input type="number" min="1" class="form-control" name="prix" placeholder="Prix" required>
                                </div>
                            
                            <div class="form-group col-md-12">
                                <label for="inputLastName">Promotion</label>
                                <input type="number" min="0" class="form-control" name="promotion" placeholder="Promotion">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Délai de promotion</label>
                                <input type="date" class="form-control" name="delai_promotion" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" value="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" placeholder="Delai de promotion">
                            </div>


                                <div class="form-group col-md-12">
                                    <label for="inputState">Hôtel</label>
                                    <select id="inputState" class="form-control" name="hotel_id" required>
                                        <option selected="">Choisir...</option>
                                        @foreach($hotels as $hotel)
                                        <option class="row"><div class="col-5">{{ $hotel->id}} ..</div><div class="col-7">{{ $hotel->titre}}</div></option>
                                        @endforeach
                                    </select>
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


                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 mt-4 mb-4">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-4 pt-sm-0">Repas</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="repas">
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div> 
                                        <div class="form-group row">   
                                            <label class="col-form-label col-sm-4 pt-sm-0">Enfant</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="enfant">
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
                                    <div class="col-md-6 mt-4 mb-4">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Textarea" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;" name="description"></textarea>
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