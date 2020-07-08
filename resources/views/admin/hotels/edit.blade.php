@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Modifier un hôtels</title>
@endsection

@section('Tables')

    @include('admin.hotels.sideBar')

@endsection


@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h2 mb-2">Modifier un hôtel</h1>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title mb-0">Informations</h3>
                    </div>
                    <div class="card-body">
                          <form action="{{ route('adminHotels.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre</label>
                                    <input type="text" class="form-control" name="titre" placeholder="Titre" value="{{ $hotel->titre }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Slug</label>
                                    <input type="text" class="form-control" name="slug" placeholder="Slug" value="{{ $hotel->slug }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Lieu</label>
                                <input type="text" class="form-control" name="lieu" placeholder="Lieu" value="{{ $hotel->lieu }}">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Etoiles</label>
                                <input type="number" min="1" max="5" class="form-control" name="etoiles" placeholder="Etoiles" value="{{ $hotel->etoiles }}">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Langues parlées</label>
                                <input type="text" class="form-control" name="language" placeholder="Langues parlées" value="{{ $hotel->langues }}">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Téléphone</label>
                                <input type="text" class="form-control" name="telephone" placeholder="Téléphone" value="{{ $hotel->telephone }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label w-100">Image</label>
                                <div class="mb-1">
                                    <img src="{{secure_asset($hotel->image) }}" class="img-thumbnail" width="90">
                                </div>

                                <input type="file" name="image" accept="image/*" value="{{ $hotel->image }}">

                                <div class="form-group">
                                    <label class="form-label w-100">Images</label>
                                    <div class="mb-1">
                                        @if($hotel->images)
                                            @foreach (json_decode($hotel->images, true) as $image)
                                                <img src="{{secure_asset( $image)}}" width="70" class="img-thumbnail">
                                            @endforeach
                                        @endif
                                    </div>

                                    <input id="images_multiple" type="file" name="images[]" multiple="multiple" accept="image/*" value="{{ $hotel->images }}"/>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 mt-4 mb-4">

                                        @if($hotel->avec_wifi )
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-4 pt-sm-0">Wifi</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="wifi" checked>
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @else 
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-4 pt-sm-0">Wifi</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="wifi">
                                                <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @endif

                                        @if($hotel->avec_gym )
                                        <div class="form-group row">   
                                            <label class="col-form-label col-sm-4 pt-sm-0">Gym</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="gym" checked="">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @else 
                                        <div class="form-group row">   
                                            <label class="col-form-label col-sm-4 pt-sm-0">Gym</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="gym">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @endif


                                        @if($hotel->avec_animaux )
                                        <div class="form-group row">     
                                            <label class="col-form-label col-sm-4 pt-sm-0">Animaux</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="animaux" checked>
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @else 
                                        <div class="form-group row">     
                                            <label class="col-form-label col-sm-4 pt-sm-0">Animaux</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="animaux">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @endif

                                    </div>

                                    <div class="col-md-6 text-center mt-4 mb-4">
                                        @if($hotel->avec_parking )
                                        <div class="form-group row">    
                                            <label class="col-form-label col-sm-4 pt-sm-0">Parking</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="parking" checked>
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @else 
                                        <div class="form-group row">    
                                            <label class="col-form-label col-sm-4 pt-sm-0">Parking</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" name="parking">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @endif


                                        @if($hotel->avec_pisicine )
                                        <div class="form-group row">        
                                            <label class="col-form-label col-sm-4 pt-sm-0">Pisicine</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="piscine" checked>
                                                <span class="custom-control-label"></span>
                                              </label>
                                            </div>
                                        </div> 
                                        @else 
                                        <div class="form-group row">        
                                            <label class="col-form-label col-sm-4 pt-sm-0">Pisicine</label>
                                            <div class="col-sm-4">
                                                <label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" class="custom-control-input" name="piscine">
                                                <span class="custom-control-label"></span>
                                              </label>
                                            </div>
                                        </div>
                                        @endif

                                        @if($hotel->annulation )
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
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Description" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;" value="">{{ $hotel->description }}</textarea>
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