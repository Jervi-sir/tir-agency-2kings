@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Modifier une omra</title>
@endsection

@section('Tables')

    @include('admin.omras.sideBar')

@endsection
@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Omras</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0"></h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('adminOmras.update') }}">
                                            @csrf
                                            <input type="hidden" name="omra_id" value="{{ $omra->id }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputFirstName">Titre</label>
                                                    <input type="text" class="form-control" id="inputFirstName" name="titre" placeholder="Titre" value="{{ $omra->titre }}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="inputFirstName">Titre du vol</label>
                                                    <input type="text" class="form-control" id="inputFirstName" name="vol_titre" placeholder="Titre" value="{{ $omra->vol_titre }}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="inputFirstName">Titre du hôtel</label>
                                                    <input type="text" class="form-control" id="inputFirstName" name="hotel_titre" placeholder="Titre" value="{{ $omra->hotel_titre }}">
                                                </div>

                                            </div>    


                                            <div class="form-group">
                                                <label for="inputAddress2">Email</label>
                                                <input type="text" class="form-control" id="inputAddress2" name="email" placeholder="Adresse email" value="{{ $omra->email }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress">Lieu</label>
                                                <input type="text" class="form-control" id="inputAddress" name="lieu" placeholder="Lieu" value="{{ $omra->lieu }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress2">Max jour:</label>
                                                <input type="number" min="1" class="form-control" name="max_jour" placeholder="Max jour" value="{{ $omra->max_jour }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputLastName">Prix</label>
                                                <input type="number" min="1" class="form-control" id="inputLastName" name="prix" placeholder="Prix" value="{{ $omra->prix }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputState">Type de omra</label>
                                                <select id="inputState" class="form-control" name="type_omra" value="{{ $omra->type_service }}">
                                                    <option selected="">Choisir...</option>
                                                    <option>...</option>
                                                </select>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label class="form-label w-100">Image</label>
                                                <div class="mb-1">
                                                    <img src="{{secure_asset($omra->image) }}" class="img-thumbnail" width="20%">
                                                </div>
                                                <input type="file" name="image" value="{{ $omra->image }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label w-100">Images</label>
                                                <div class="mb-1">
                                                    @if($omra->images)
                                                        @foreach (json_decode($omra->images, true) as $image)
                                                            <img src="{{secure_asset( $image)}}" width="10%" class="img-thumbnail">
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="file" name="images[]" multiple value="{{ $omra->images }}">
                                            </div>

                                            
                                        
                                        <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description" placeholder="Textarea" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;" value="{{ $omra->description }}"></textarea>
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
