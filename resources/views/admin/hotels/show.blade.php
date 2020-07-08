@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Hôtels</title>
@endsection

@section('Tables')

    @include('admin.hotels.sideBar')

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
                                                <td>Titre</td>
                                                <td>{{ $hotel->titre }}</td>
                                            </tr>
                                            <tr>
                                                <td>Image</td>
                                                <td><img src="{{secure_asset($hotel->image) }}" width="100"></td>
                                            </tr>
                                            <tr>
                                                <td>Images</td>
                                                <td>
                                                    @if($hotel->images)
                                                    @foreach (json_decode($hotel->images, true) as $image)
                                                    <img src="{{secure_asset( $image)}}" width="50" class="img-thumbnail">
                                                    @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $hotel->description }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $hotel->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lieu</td>
                                                <td>{{ $hotel->lieu }}</td>
                                            </tr>
                                            <tr>
                                                <td>Etoiles</td>
                                                <td>{{ $hotel->etoiles }}</td>
                                            </tr>
                                            <tr>
                                                <td>Wifi</td>
                                                <td>{{ $hotel->avec_wifi }}</td>
                                            </tr>
                                            <tr>
                                                <td>Gym</td>
                                                <td>{{ $hotel->avec_gym }}</td>
                                            </tr>
                                            <tr>
                                                <td>Animaux</td>
                                                <td>{{ $hotel->allowanimals }}</td>
                                            </tr>
                                            <tr>
                                                <td>Parking</td>
                                                <td>{{ $hotel->avec_parking }}</td>
                                            </tr>
                                            <tr>
                                                <td>Piscine</td>
                                                <td>{{ $hotel->avec_piscine }}</td>
                                            </tr>
                                            <tr>
                                                <td>Annulation</td>
                                                <td>{{ $hotel->annulation }}</td>
                                            </tr>
                                            <tr>
                                                <td>Chambres Libres</td>
                                                <td>{{ $hotel->chambres_disponible}}</td>
                                            </tr>
                                            <tr>
                                                <td>Prix minimum</td>
                                                <td>{{ $hotel->prix }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ajoutée le</td>
                                                <td>{{ $hotel->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Modifiée le</td>
                                                <td>{{ $hotel->updated_at }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
@endsection
