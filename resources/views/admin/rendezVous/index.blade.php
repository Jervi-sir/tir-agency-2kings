@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Rendez-Vous</title>
@endsection


@section('search-data')
    
    @include('admin.partialsAdmin.rendezVousSearch')

@endsection


@section('Tables')
    @include('admin.rendezVous.sideBar')
@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Tous les Rendez-Vous</h1>

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
                                    <form action="{{ route('adminRendezvous.supprimerBulk') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
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
                                     <button type="button" id="bulk" class="col-5 btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#bulkPopup" >
                                        Suppression groupée
                                    </button>
                                </div>
                                <table class="table table-bordered table-striped" style="overflow-x: scroll;display: block;">
                                    <thead>
                                        <tr>
                                            <th ><input type="checkbox" id="callBulk" class="select_all"></th>
                                            <th >Nom</th>
                                            <th >Prenom</th>
                                            <th >au Sujet de</th>
                                            <th >Téléphone</th>
                                            <th >Email</th>
                                            <th >Date de Rendez-Vous</th>
                                            <th class="d-none d-md-table-cell" >Ajoutée le </th>
                                            <th class="d-none d-md-table-cell" >Modifiée le</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($meets as $meet)
                                        <tr >
                                            <td><input type="checkbox" name="row_id" id="checkbox-{{$meet->id}}" value="{{$meet->id}}"></td>
                                            <td>{{ $meet->nom }}</td>
                                            <td>{{ $meet->prenom }}</td>
                                            <td>{{ $meet->omra->titre }}</td>
                                            <td>{{ $meet->telephone }}</td>
                                            <td>{{ $meet->email }}</td>
                                            <td>{{ $meet->date_rendez_vous }}</td>

                                            <td class="d-none d-md-table-cell">{{ $meet->created_at }}</td>
                                            <td class="d-none d-md-table-cell">{{ $meet->updated_at }}</td>
                                            <td class="table-action">

                                                <form action="{{ route('adminRendezvous.afficher') }}" method="POST" data-toggle="tooltip" data-placement="top" title="voir">
                                                    @csrf
                                                    <input type="hidden" name="meet_id" value="{{ $meet->id }}" >
                                                    <button class="btn btn-md btn-warning d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="info"></i></button>
                                                                                            
                                                </form>
                                               
                                                <button type="button tooltip" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#modelOf{{ (string)$meet->id }}" data-placement="top" title="supprimer">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modelOf{{ (string)$meet->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmer-suppression" aria-hidden="true">
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
                                                                <form action="{{ route('adminRendezvous.supprimer') }}" method="POST" data-toggle="tooltip" data-placement="top" title="supprimer">
                                                                    @csrf
                                                                    <input type="hidden" name="meet_id" value="{{ $meet->id }}">
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
		{{ $meets->appends(request()->input())->links() }}



@endsection
