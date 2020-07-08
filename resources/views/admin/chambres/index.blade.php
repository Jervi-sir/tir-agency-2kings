@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Chambres > Hôtels</title>
@endsection

@section('search-data')
    
    @include('admin.partialsAdmin.chambreSearch')

@endsection

@section('Tables')

    @include('admin.chambres.sideBar')

@endsection


@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Chambres d'Hôtels</h1>

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
                                    <form action="{{ route('adminChambres.supprimerBulk') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
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
                                    <a href="{{ route('adminChambres.pageAjouter')}}" class="btn btn-success btn-add-new col-5 mr-2 d-flex justify-content-center align-items-center">
                                        <i class="voyager-plus"></i> <span>Ajouter une Chambre</span>
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
                                            <th >Image</th>
                                            <th >Images</th>
                                            <th >Id d'Hôtel</th>
                                            <th >Nom d'Hôtel</th>
                                            <th >Occupée</th>
                                            <th >Etage</th>
                                            <th >Numero du chambre</th>
                                            <th >Lits</th>
                                            <th >Superficie</th>
                                            <th >Description</th>
                                            <th >Prix</th>
                                            <th >Promotion</th>
                                            <th >Délai promotion</th>
                                            <th >Repas</th>
                                            <th >Annulation</th>
                                            <th >Enfant</th>
                                            
                                            <th class="d-none d-md-table-cell" >Ajoutée le </th>
                                            <th class="d-none d-md-table-cell" >Modifiée le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($chambres as $chambre)
                                        <tr >
                                            <td><input type="checkbox" name="row_id" id="checkbox-{{$chambre->id}}" value="{{$chambre->id}}"></td>
                                            <td>{{ $chambre->id }}</td>
                                            <td>{{ $chambre->titre }}</td>
                                            <td ><img src="{{secure_asset('storage/' .$chambre->image) }}" width="50"></td>
                                            <td>
                                            @if($chambre->images)
                                                @foreach (json_decode($chambre->images, true) as $image)
                                                    <img src="{{secure_asset('storage/' . $image)}}" width="50" class="img-thumbnail">
                                                @endforeach
                                            @endif
                                            </td>
                                            <td>{{ $chambre->hotel->id }}</td>
                                            <td>{{ $chambre->hotel->titre }}</td>
                                            <td>{{ $chambre->occupee }}</td>
                                            <td>{{ $chambre->etage }}</td>
                                            <td>{{ $chambre->numero_chambre }}</td>
                                            <td>{{ $chambre->nb_lit }}</td>
                                            <td>{{ $chambre->superficie }}</td>
                                            <td>
                                                <?php 
                                                echo substr($chambre->description, 0, 75).'...';
                                                 ?>
                                            </td>
                                            <td>{{ $chambre->prix }}</td>
                                            <td>{{ $chambre->promotion_pourcentage }}</td>
                                            <td>{{ $chambre->promotion_delai }}</td>
                                            <td>{{ $chambre->reoas }}</td>
                                            <td>{{ $chambre->annulation }}</td>
                                            <td>{{ $chambre->avec_enfant  }}</td>
                                            
                                            <td class="d-none d-md-table-cell">{{ $chambre->created_at }}</td>
                                            <td class="d-none d-md-table-cell">{{ $chambre->updated_at }}</td>
                                            <td class="table-action">
                                                <form action="{{ route('adminChambres.edit') }}" method="GET" data-toggle="tooltip" data-placement="top" title="modifier">
                                                    @csrf
                                                    <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">
                                                    <button class="btn btn-md btn-secondary d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="edit-2"></i></button>

                                                </form>
                                                <form action="{{ route('adminChambres.afficher') }}" method="POST" data-toggle="tooltip" data-placement="top" title="voir">
                                                    @csrf
                                                    <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">
                                                    <button class="btn btn-md btn-warning d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="info" ></i></button>
                                                                                            
                                                </form>
                                                

                                                <button type="button" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal tooltip" data-target="#modelOf{{ (string)$chambre->id }}" data-placement="top" title="supprimer">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modelOf{{ (string)$chambre->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmer-suppression" aria-hidden="true">
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
                                                                <form action="{{ route('adminChambres.supprimer') }}" method="POST" data-toggle="tooltip" data-placement="top" title="supprimer">
                                                                    @csrf
                                                                    <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">
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
										{{ $chambres->appends(request()->input())->links() }}



@endsection
