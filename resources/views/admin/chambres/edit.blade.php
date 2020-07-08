@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Modifier une chambre</title>
@endsection

@section('Tables')

    @include('admin.chambres.sideBar')

@endsection


@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h2 mb-2">Modifier une Chambre</h1>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title mb-0">Informations</h3>
                    </div>
                    <div class="card-body">
                          <form action="{{ route('adminChambres.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre</label>
                                    <input type="text" class="form-control" name="titre" placeholder="Titre" value="{{ $chambre->titre }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Slug</label>
                                    <input type="text" class="form-control" name="slug" placeholder="Slug" value="{{ $chambre->slug }}">
                                </div>
                                <!-- <div class="form-group col-md-12">
                                    <label for="inputAddress2">Numero du chambre</label>
                                    <input type="text" class="form-control" name="numero_chambre" placeholder="Numero Chambre" value="{{ $chambre->numero_chambre }}">
                                </div> -->
                                <div class="form-group col-md-12">
                                    <label for="inputAddress2">Lits</label>
                                    <input type="number" min="1" class="form-control" name="nb_lit" placeholder="Lits" value="{{ $chambre->nb_lit }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputAddress2">Superficie</label>
                                    <input type="text" class="form-control" name="superficie" placeholder="Superficie" value="{{ $chambre->superficie }}">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="inputLastName">Prix</label>
                                    <input type="number" min="1" class="form-control" name="prix" placeholder="Prix" value="{{ $chambre->prix }}">
                                </div>
                            
                            <div class="form-group col-md-12">
                                <label for="inputLastName">Promotion</label>
                                <input type="number" min="1" class="form-control" name="promotion" placeholder="Promotion" value="{{ $chambre->promotion_pourcentage }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Délai de promotion</label>
                                <input type="date" class="form-control" name="delai_promotion" min="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" placeholder="Delai de promotion" value="{{ $chambre->promotion_delai }}">
                            </div>
                                <div class="form-group col-md-12">
                                    <label for="inputState">Hôtel</label>
                                    <select id="inputState" class="form-control" name="hotel_id" >
                                        <option selected=>
                                            <div class="col-5">{{ $chambre->hotel_id}} ..</div>
                                            <div class="col-7">{{ $chambre->hotel->titre}}</div>
                                        </option>
                                        @foreach($hotels as $hotel)
                                        <option class="row">
                                            <div class="col-5">{{ $hotel->id}} ..</div>
                                            <div class="col-7">{{ $hotel->titre}}</div>
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                            </div>
                            <div class="form-group">
                                <label class="form-label w-100">Image</label>
                                <div class="mb-1">
                                    <img src="{{secure_asset($chambre->image) }}" class="img-thumbnail" width="90">
                                </div>
                                <input type="file" name="image" accept="image/*">

                                <div class="form-group">
                                    <label class="form-label w-100">Images</label>
                                    <div class="mb-1">
                                        @if($chambre->images)
                                            @foreach (json_decode($chambre->images, true) as $image)
                                                <img src="{{secure_asset( $image)}}" width="70" class="img-thumbnail">
                                            @endforeach
                                        @endif
                                    </div>
                                    <input id="images_multiple" type="file" name="images[]" multiple="multiple" accept="image/*" />
                                </div>
                            </div>


                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 mt-4 mb-4">
                                        @if($chambre->repas)
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-4 pt-sm-0">Repas</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="repas" checked>
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div> 
                                        @else
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-4 pt-sm-0">Repas</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="repas">
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div> 
                                        @endif

                                        @if($chambre->avec_enfant)
                                        <div class="form-group row">   
                                            <label class="col-form-label col-sm-4 pt-sm-0">Enfant</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="enfant" checked>
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @else
                                         <div class="form-group row">   
                                            <label class="col-form-label col-sm-4 pt-sm-0">Enfant</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="enfant" >
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @endif
                                        

                                        @if($chambre->annulation)
                                        <div class="form-group row">     
                                            <label class="col-form-label col-sm-4 pt-sm-0">Annulation</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="annulation" checked>
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div> 
                                        @else
                                        <div class="form-group row">     
                                            <label class="col-form-label col-sm-4 pt-sm-0">Annulation</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="annulation">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>    
                                        @endif

                                    </div>
                                    <div class="col-md-6 mt-4 mb-4">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Textarea" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;">{{ $chambre->description }}</textarea>
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