@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Vols</title>
@endsection



@section('search-data')
    
    @include('admin.partialsAdmin.volSearch')

@endsection


@section('Tables')

    @include('admin.avions.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Vols</h1>

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
                                    <form action="{{ route('adminAvions.supprimerBulk') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
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
                                    <a href="{{ route('adminAvions.pageAjouter')}}" class="btn btn-success btn-add-new col-5 mr-2 d-flex justify-content-center align-items-center">
                                        <i class="voyager-plus"></i> <span>Ajouter un Vol</span>
                                    </a>
                                    <button type="button" id="bulk" class="col-5 btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#bulkPopup" >
                                        Suppression groupée
                                    </button>
                                </div>
                                <table class="table table-bordered table-striped" style="overflow-x: scroll;display: block;">
                                    <thead>
                                        <tr>
                                            <th ><input type="checkbox" id="callBulk" class="select_all"></th>
                                            <th >Id</th>
                                            <th >Titre</th>
                                            <th >Place</th>
                                            <th >Image</th>
                                            <th >Images</th>
                                            <th >Lieu de départ</th>
                                            <th >Lieu d'arrivée</th>
                                            <th >Aeroport de départ</th>
                                            <th >Aeroport d'arrivée</th>
                                            <th >Date de départ</th>
                                            <th >Date de retour</th>
                                            <th >Prix</th>
                                            <th >Délai de promotion</th>
                                            <th >Promotions %</th>
                                            <th >Annulation</th>
                                            <th >Description</th>
                                            <th class="d-none d-md-table-cell" >Ajoutée le </th>
                                            <th class="d-none d-md-table-cell" >Modifiée le</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($avions as $vol)
                                        <tr >
                                            <td><input type="checkbox" name="row_id" id="checkbox-{{$vol->id}}" value="{{$vol->id}}"></td>
                                            <td>{{ $vol->id }}</td>
                                            <td>{{ $vol->titre }}</td>
                                            <td>{{ $vol->nombre_places }}</td>
                                            <td><img src="{{ secure_asset( $vol->image)  }}"></td>
                                            <td>
                                              @if($vol->images)
                                                    @foreach(json_decode($vol->images) as $image)
                                                        <img src="{{secure_asset( $image)}}" width="50" class="img-thumbnail">
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $vol->lieu_depart }}</td>
                                            <td>{{ $vol->lieu_arrivee }}</td>
                                            <td>{{ $vol->aeroport_depart }}</td>
                                            <td>{{ $vol->aeroport_arrivee }}</td>
                                            <td>{{ $vol->date_depart }}</td>
                                            <td>{{ $vol->date_retour }}</td>
                                            <td>{{ $vol->etoiles }}</td>
                                            <td>{{ $vol->date_depart }}</td>
                                            <td>{{ $vol->date_arrivee }}</td>
                                            <td>{{ $vol->ligne_depart }}</td>
                                            <td>{{ $vol->ligne_retour }}</td>
                                            <td>{{ $vol->prix }}</td>
                                            <td>{{ $vol->promotion_delai }}</td>
                                            <td>{{ $vol->promotion_pourcentage }}</td>
                                            <td>{{ $vol->annulation }}</td>
                                            <td>{{ $vol->description }}</td>
                                            <td class="d-none d-md-table-cell">{{ $vol->created_at }}</td>
                                            <td class="d-none d-md-table-cell">{{ $vol->updated_at }}</td>
                                            <td class="table-action">
                                                <form action="{{ route('adminAvions.edit') }}" method="GET" data-toggle="tooltip" data-placement="top" title="modifier">
                                                    @csrf
                                                    <input type="hidden" name="vol_id" value="{{ $vol->id }}">
                                                    <button class="btn btn-md btn-secondary d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="edit-2"></i></button>

                                                </form>
                                                <form action="{{ route('adminAvions.afficher') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="voir">
                                                    @csrf
                                                    <input type="hidden" name="vol_id" value="{{ $vol->id }}">
                                                    <button class="btn btn-md btn-warning d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="info"></i></button>
                                                                                            
                                                </form>
                                                <button type="button" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal tooltip" data-target="#modelOf{{ (string)$vol->id }}" data-placement="top" title="supprimer">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modelOf{{ (string)$vol->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmer-suppression" aria-hidden="true">
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
                                                                <form action="{{ route('adminAvions.supprimer') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
                                                                    @csrf
                                                                    <input type="hidden" name="vol_id" value="{{ $vol->id }}">
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
										{{ $avions->appends(request()->input())->links() }}



@endsection
