@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Hôtels</title>
@endsection

@section('search-data')
    
    @include('admin.partialsAdmin.hotelSearch')

@endsection

@section('Tables')

    @include('admin.hotels.sideBar')

@endsection

@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Hôtels</h1>

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
                        <form action="{{ route('adminHotels.supprimerBulk') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
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
                        <a href="{{ route('adminHotels.pageAjouter')}}" class="btn btn-success btn-add-new col-5 mr-2 d-flex justify-content-center align-items-center">
                            <i class="voyager-plus"></i> <span>Ajouter un hôtel</span>
                        </a>
                        <button type="button" id="bulk" class="col-5 btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#bulkPopup" >
                            Suppression groupée
                        </button>
                    </div>
                    <table class="table table-bordered table-striped" style="overflow-x: scroll; display: block;">
                        <thead>
                            <tr>
                                <th ><input type="checkbox" id="callBulk" class="select_all"></th>
                                <th>id</th>
                                <th>Titre</th>
                                <th>Image</th>
                                <th>Images</th>
                                <th>Langues parlées</th>
                                <th>Description</th>
                                <th>téléphone</th>
                                <th>Lieu</th>
                                <th>Etoiles</th>
                                <th>Wifi</th>
                                <th>Gym</th>
                                <th>Animaux</th>
                                <th>Parking</th>
                                <th>Piscine</th>
                                <th>Annulation</th>
                                <th>Chambres Libres</th>
                                <th>Prix minimum </th>
                                <th class="d-none d-md-table-cell">Ajoutée le </th>
                                <th class="d-none d-md-table-cell">Modifiée le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotels as $hotel)
                            <tr>
                                <td><input type="checkbox" name="row_id" id="checkbox-{{$hotel->id}}" value="{{$hotel->id}}"></td>
                                <td>{{ $hotel->id }}</td>
                                <td>{{ $hotel->titre }}</td>
                                <td><img src="{{asset('storage/' .$hotel->image) }}" width="50"></td>
                                <td>
                                    @if($hotel->images)
                                    @foreach (json_decode($hotel->images, true) as $image)
                                    <img src="{{asset('storage/' . $image)}}" width="50" class="img-thumbnail">
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{ $hotel->langues }}</td>
                                <td>
                                    <?php 
                                    echo substr($hotel->description, 0, 75).'...';
                                     ?>
                                </td>
                                <td>{{ $hotel->telephone }}</td>
                                <td>{{ $hotel->lieu }}</td>
                                <td>{{ $hotel->etoiles }}</td>
                                <td>{{ $hotel->avec_wifi }}</td>
                                <td>{{ $hotel->avec_gym }}</td>
                                <td>{{ $hotel->allowanimals }}</td>
                                <td>{{ $hotel->avec_parking }}</td>
                                <td>{{ $hotel->avec_piscine }}</td>
                                <td>{{ $hotel->annulation }}</td>
                                <td>{{ $hotel->chambres_disponible }}</td>
                                <td>{{ $hotel->prix }}</td>
                                <td class="d-none d-md-table-cell">{{ $hotel->created_at }}</td>
                                <td class="d-none d-md-table-cell">{{ $hotel->updated_at }}</td>
                                <td class="table-action">
                                    <form action="{{ route('adminHotels.edit') }}" method="GET" data-toggle="tooltip" data-placement="top" title="modifier">
                                                    @csrf
                                                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                                    <button class="btn btn-md btn-secondary d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="edit-2"></i></button>

                                    </form>
                                    <form action="{{ route('adminHotels.afficher') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="voir">
                                        @csrf
                                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                        <button class="btn btn-md btn-warning d-flex justify-content-center align-items-center mb-1" type="submit"><i class="align-middle" data-feather="info"></i></button>

                                    </form>

                                    <button type="button" class="btn btn-md btn-danger d-flex justify-content-center align-items-center" data-toggle="modal tooltip" data-target="#modelOf{{ (string)$hotel->id }}" data-placement="top" title="supprimer">
                                        <i class="align-middle" data-feather="trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modelOf{{ (string)$hotel->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-light">
                                                    <h5 class="modal-title text-light" id="exampleModalLabel">Vous êtes sur vous voulez supprimer cette colonne?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('adminHotels.supprimer') }}" method="POST"  data-toggle="tooltip" data-placement="top" title="supprimer">
                                                        @csrf
                                                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
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
{{ $hotels->appends(request()->input())->links() }}



@endsection
