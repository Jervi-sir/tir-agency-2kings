@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Places > Vols</title>
@endsection

@section('Tables')

    @include('admin.volsPlaces.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Places d'Avion</h1>
                    <h4>total des places enrengistrees : {{\App\Place::count()}} place, de {{\App\Avion::count()}} avions</h4>
                    <!-- Bulk delete -->    
                    <div class="modal fade" id="bulkPopup" tabindex="-1" role="dialog" aria-labelledby="confirmer-suppression" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-light">
                                    <h5 class="modal-title text-light">Suppression groupée</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"  id="confirmer-suppression">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="{{ route('adminPlaces.supprimerBulk') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
                                        @csrf
                                        <input type="hidden" name="array_id" id="array_id">
                                        <button id="confirmBulk" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" type="submit">Confirmer</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>      
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header row col-sm-12 col-md-5">
                                    <!-- <h6 class="card-subtitle text-muted">.</h6>
                                     <a href="{{ route('adminPlaces.pageAjouter')}}" class="btn btn-success btn-add-new col-5 mr-2 d-flex justify-content-center align-items-center">
                                        <i class="voyager-plus"></i> <span>Ajouter une Place</span>
                                    </a>
                                    <button type="button" id="bulk" class="col-5 btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#bulkPopup" >
                                        Suppression groupée
                                    </button> -->
                                </div>
                                <table class="table table-bordered table-striped" style="overflow-x: scroll;">
                                    <thead>
                                        <tr>
                                            <th >Id d'avion</th>
                                            <th >Nom d'avion</th>
                                            <th >Companie</th>
                                            <th >Code place</th>
                                            <th >Numéro de place</th>
                                            <th >Occupée</th>
                                            <th class="d-none d-md-table-cell" >Ajoutée le </th>
                                            <th class="d-none d-md-table-cell" >Modifiée le</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($places as $place)
                                        <tr >
                                            <td>{{ $place->avion->id }}</td>
                                            <td>{{ $place->avion->nom_avion }}</td>
                                            <td><img src="{{ secure_asset( $place->avion->image )  }}" width="50%" style="align-content: center;"></td>
                                            <td>{{ $place->code_place }}</td>
                                            <td>{{ $place->numero_place }}</td>
                                            <td>{{ $place->occupee }}</td>
                                            <td class="d-none d-md-table-cell">{{ $place->created_at }}</td>
                                            <td class="d-none d-md-table-cell">{{ $place->updated_at }}</td>
                                            <td class="table-action">
                                                <form action="{{ route('adminPlaces.afficher') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="voir">
                                                    @csrf
                                                    <input type="hidden" name="place_id" value="{{ $place->id }}">
                                                    <button class="btn btn-md btn-warning d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="info"></i></button>
                                                                                            
                                                </form>

                                                <!-- <button type="button" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#modelOf{{ (string)$place->id }}">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </button> -->

                                                <!-- Modal -->
                                                <div class="modal fade" id="modelOf{{ (string)$place->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmer-suppression" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-light">
                                                                <h5 class="modal-title text-light" id="confirmer-suppression">Vous êtes sur vous voulez supprimer cette colonne?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                <form action="{{ route('adminPlaces.supprimer') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
                                                                    @csrf
                                                                    <input type="hidden" name="place_id" value="{{ $place->id }}">
                                                                    <button class="btn btn-md btn-danger d-flex justify-content-center align-items-center" type="submit">Confirmer</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
			{{ $places->appends(request()->input())->links() }}



@endsection
