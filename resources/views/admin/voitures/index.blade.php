@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Voitures</title>
@endsection


@section('search-data')
    
    @include('admin.partialsAdmin.voitureSearch')

@endsection


@section('Tables')

    @include('admin.voitures.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Voitures</h1>
                    
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
                                    <form action="{{ route('adminVoitures.supprimerBulk') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
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
                                <div class="card-header row col-sm-12 col-md-5 ">
                                    <a href="{{ route('adminVoitures.pageAjouter')}}" class="btn btn-success btn-add-new col-5 mr-2 d-flex justify-content-center align-items-center">
                                        <i class="voyager-plus"></i> <span>Ajouter une Voiture</span>
                                    </a>
                                    <button type="button" id="bulk" class="col-5 btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#bulkPopup" >
                                        Suppression groupée
                                    </button>
                                </div>
                                <table class="table table-bordered table-striped" style="overflow-x: scroll;display: block; ">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="callBulk" class="select_all"></th>
                                            <th>Id</th>
                                            <th>Titre</th>
                                            <th>Image</th>
                                            <th>Images</th>
                                            <th>Prix</th>
                                            <th>Promotion</th>
                                            <th>Délai de promotion</th>
                                            <th>Lieu</th>
                                            <th>Occupée</th>
                                            <th>Portes</th>
                                            <th>Places</th>
                                            <th>Etoiles</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Année</th>
                                            <th>Km limitation</th>
                                            <th>Assurance</th>
                                            <th>Climatiseur</th>
                                            <th>Manuelle</th>
                                            <th>Electrique</th>
                                            <th>Annulation</th>
                                            <th class="d-none d-md-table-cell" >Ajoutée le </th>
                                            <th class="d-none d-md-table-cell" >Modifiée le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($voitures as $voiture)
                                        <tr >
                                            <td><input type="checkbox" name="row_id" id="checkbox-{{$voiture->id}}" value="{{$voiture->id}}"></td>
                                            <td>{{ $voiture->id }}</td>
                                            <td>{{ $voiture->titre }}</td>
                                            <td >
                                                <img src="{{secure_asset($voiture->image) }}" width="50">
                                            </td>
                                            <td>
                                                 @if($voiture->images)
                                                    @foreach(json_decode($voiture->images) as $image)
                                                        <img src="{{secure_asset( $image)}}" width="50" class="img-thumbnail">
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $voiture->prix }}</td>
                                            <td>{{ $voiture->promotion_pourcentage }}</td>
                                            <td>{{ $voiture->promotion_delai }}</td>
                                            <td>{{ $voiture->lieu }}</td>
                                            <td>{{ $voiture->occupee }}</td>
                                            <td>{{ $voiture->portes }}</td>
                                            <td>{{ $voiture->nombre_places }}</td>
                                            <td>{{ $voiture->etoiles }}</td>
                                            <td>{{ $voiture->type_voiture }}</td>
                                            <td>
                                                <?php 
                                                echo substr($voiture->description, 0, 50).'...';
                                                 ?>
                                            </td>
                                            <td>{{ $voiture->annee }}</td>
                                            <td>{{ $voiture->km_illimite }}</td>
                                            <td>{{ $voiture->assurance }}</td>
                                            <td>{{ $voiture->climatiseur }}</td>
                                            <td>{{ $voiture->manuel }}</td>
                                            <td>{{ $voiture->electric }}</td>
                                            <td>{{ $voiture->annulation }}</td>
                                            <td class="d-none d-md-table-cell">{{ $voiture->created_at }}</td>
                                            <td class="d-none d-md-table-cell">{{ $voiture->updated_at }}</td>
                                            <td class="table-action">
                                                <form action="{{ route('adminVoitures.edit') }}" method="GET" data-toggle="tooltip" data-placement="top" title="modifier">
                                                    @csrf
                                                    <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
                                                    <button class="btn btn-md btn-secondary d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="edit-2"></i></button>

                                                </form>

                                                <form action="{{ route('adminVoitures.afficher') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="voir">
                                                    @csrf
                                                    <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
                                                    <button class="btn btn-md btn-warning d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="info"></i></button>
                                                                                            
                                                </form>

                                                <button type="button" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="tooltip modal" data-target="#modelOf{{ (string)$voiture->id }}" data-placement="top" title="supprimer">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modelOf{{ (string)$voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmer-suppression" aria-hidden="true">
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
                                                                <form action="{{ route('adminVoitures.supprimer') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
                                                                    @csrf
                                                                    <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
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

            <!-- a pop up for Bulk yaaa -->


										{{ $voitures->appends(request()->input())->links() }}



@endsection
