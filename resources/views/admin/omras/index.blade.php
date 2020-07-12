@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Omras</title>
@endsection


@section('search-data')
    
    @include('admin.partialsAdmin.omraSearch')

@endsection


@section('Tables')

    @include('admin.omras.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Omras</h1>
                    
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
                                    <form action="{{ route('adminOmras.supprimerBulk') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
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
                                    <a href="{{ route('adminOmras.pageAjouter')}}" class="btn btn-success btn-add-new col-5 mr-2 d-flex justify-content-center align-items-center">
                                        <i class="voyager-plus"></i> <span>Ajouter une omra</span>
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
                                            <th>Slug</th>
                                            <th>Titre du vol</th>
                                            <th>Titre du hôtel</th>
                                            <th>Image</th>
                                            <th>Images</th>
                                            <th>Prix</th>
                                            <th>Lieu</th>
                                            <th>Email</th>
                                            <th>Max jours</th>
                                            <th>Type de paiment</th>
                                            <th>Type de service</th>
                                            <th>Description</th>
                                            <th class="d-none d-md-table-cell" >Ajoutée le </th>
                                            <th class="d-none d-md-table-cell" >Modifiée le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($omras as $omra)
                                        <tr >
                                            <td><input type="checkbox" name="row_id" id="checkbox-{{$omra->id}}" value="{{$omra->id}}"></td>
                                            <td>{{ $omra->id }}</td>
                                            <td>{{ $omra->titre }}</td>
                                            <td>{{ $omra->slug }}</td>
                                            <td>{{ $omra->vol_titre }}</td>
                                            <td>{{ $omra->hotel_titre }}</td>
                                            <td >
                                                <img src="{{secure_asset($omra->image) }}" width="50"></td>
                                            </td>
                                            <td>
                                                 @if($omra->images)
                                                    @foreach(json_decode($omra->images) as $image)
                                                        <img src="{{secure_asset( $image)}}" width="50" class="img-thumbnail">
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $omra->prix }}</td> 
                                            <td>{{ $omra->lieu }}</td>
                                            <td>{{ $omra->email }}</td>
                                            <td>{{ $omra->max_jour }}</td>
                                            <td>{{ $omra->type_payment }}</td>
                                            <td>{{ $omra->type_service }}</td>
                                            <td>
                                                <?php 
                                                    echo substr($omra->description, 0, 75).'...';
                                                 ?>
                                            </td>


                                            <td class="d-none d-md-table-cell">{{ $omra->created_at }}</td>
                                            <td class="d-none d-md-table-cell">{{ $omra->updated_at }}</td>
                                            <td class="table-action">
                                                <form action="{{ route('adminOmras.edit') }}" method="GET" data-toggle="tooltip" data-placement="top" title="modifier">
                                                    @csrf
                                                    <input type="hidden" name="omra_id" value="{{ $omra->id }}">
                                                    <button class="btn btn-md btn-secondary d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="edit-2"></i></button>

                                                </form>

                                                <form action="{{ route('adminOmras.afficher') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="voir">
                                                    @csrf
                                                    <input type="hidden" name="omra_id" value="{{ $omra->id }}">
                                                    <button class="btn btn-md btn-warning d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="info"></i></button>
                                                                                            
                                                </form>

                                                <button type="button" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#modelOf{{ (string)$omra->id }}"  data-placement="top" title="supprimer">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modelOf{{ (string)$omra->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmer-suppression" aria-hidden="true">
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
                                                                <form action="{{ route('adminOmras.supprimer') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
                                                                    @csrf
                                                                    <input type="hidden" name="omra_id" value="{{ $omra->id }}">
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


                                        {{ $omras->appends(request()->input())->links() }}



@endsection
