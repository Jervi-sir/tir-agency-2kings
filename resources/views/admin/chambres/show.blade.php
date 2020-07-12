@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Hotels</title>
@endsection

@section('Tables')

    @include('admin.chambres.sideBar')

@endsection


@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Hôtels</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"></h5>
                                    <h6 class="card-subtitle text-muted"></h6>
                                </div>
                              <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Valeurs</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td >Titre</td>
                                                <td>{{ $chambre->titre }}</td>
                                            </tr>
                                            <tr>
                                                <td >Image</td>
                                                <td ><img src="{{secure_asset($chambre->image) }}" width="100"></td>
                                                
                                            </tr>
                                            <tr>
                                                <td >Images</td>
                                                <td>
                                                @if($chambre->images)
                                                    @foreach (json_decode($chambre->images, true) as $image)
                                                        <img src="{{secure_asset( $image)}}" width="50" class="img-thumbnail">
                                                    @endforeach
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Occupée</td>
                                                <td>{{ $chambre->occupee }}</td>
                                            </tr>
                                            <tr>
                                                <td >Etage</td>
                                                <td>{{ $chambre->etage }}</td>
                                            </tr>
                                            <tr>
                                                <td >Numero du chambre</td>
                                                <td>{{ $chambre->numero_chambre }}</td>
                                            </tr>
                                            <tr>
                                                <td >Lits</td>
                                                <td>{{ $chambre->nb_lit }}</td>
                                            </tr>
                                            <tr>
                                                <td >Superficie</td>
                                                <td>{{ $chambre->superficie }}</td>
                                            </tr>
                                            <tr>
                                                <td >Description</td>
                                                <td>{{ $chambre->description }}</td>
                                            </tr>
                                            <tr>
                                                <td >Prix</td>
                                                <td>{{ $chambre->prix }}</td>
                                            </tr>
                                            <tr>
                                                <td >Promotion</td>
                                                <td>{{ $chambre->promotion_pourcentage }}</td>
                                            </tr>
                                            <tr>
                                                <td >Délai promotion</td>
                                                <td>{{ $chambre->promotion_delai }}</td>
                                            </tr>
                                            <tr>
                                                <td >Repas</td>
                                                <td>{{ $chambre->reoas }}</td>
                                            </tr>
                                            <tr>
                                                <td >Annulation</td>
                                                <td>{{ $chambre->annulation }}</td>
                                            </tr>
                                            <tr>
                                                <td >Enfant</td>
                                                <td>{{ $chambre->avec_enfant  }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
