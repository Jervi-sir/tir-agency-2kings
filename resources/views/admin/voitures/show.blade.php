@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Voitures</title>
@endsection

@section('Tables')

    @include('admin.voitures.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Voitures</h1>

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
                                                <td>{{ $voiture->titre }}</td>
                                            </tr>
                                            <tr>
                                                <td>Image</td>
                                                <td >
                                                    <img src="{{secure_asset('storage/' .$voiture->image) }}" width="100">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Images</td>
                                                 <td>
                                                 @if($voiture->images)
                                                    @foreach(json_decode($voiture->images) as $image)
                                                        <img src="{{secure_asset('storage/' . $image)}}" width="50" class="img-thumbnail">
                                                    @endforeach
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Prix</td>
                                                <td>{{ $voiture->prix }}</td>
                                            </tr>
                                            <tr>
                                                <td>Promotion</td>
                                                <td>{{ $voiture->promotion_pourcentage }}</td>
                                            </tr>
                                            <tr>
                                                <td>Délai de promotion</td>
                                                <td>{{ $voiture->promotion_delai }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lieu</td>
                                                <td>{{ $voiture->lieu }}</td>
                                            </tr>
                                            <tr>
                                                <td>Occupée</td>
                                                <td>{{ $voiture->occupee }}</td>
                                            </tr>
                                            <tr>
                                                <td>Portes</td>
                                                <td>{{ $voiture->portes }}</td>
                                            </tr>
                                            <tr>
                                                <td>places</td>
                                                <td>{{ $voiture->nombre_places }}</td>
                                            </tr>
                                            <tr>
                                                <td>Etoiles</td>
                                                <td>{{ $voiture->etoiles }}</td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td>{{ $voiture->type_voiture }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $voiture->description }}</td>
                                            </tr>
                                            <tr>
                                                <td>Année</td>
                                                <td>{{ $voiture->annee }}</td>
                                            </tr>
                                            <tr>
                                                <td>Km limitation</td>
                                                <td>{{ $voiture->km_illimite }}</td>
                                            </tr>                                            
                                            <tr>
                                                <td>Assurance</td>
                                                <td>{{ $voiture->assurance }}</td>
                                            </tr>                                           
                                             <tr>
                                                <td>Climatiseur</td>
                                                <td>{{ $voiture->climatiseur }}</td>
                                            </tr>
                                             <tr>
                                                <td>Manuelle</td>
                                                <td>{{ $voiture->manuel }}</td>
                                                
                                            </tr>                                             
                                            <tr>
                                                <td>Electrique</td>
                                                <td>{{ $voiture->electric }}</td>
                                                
                                            </tr>
                                             <tr>
                                                <td>Aannulation</td>
                                                <td>{{ $voiture->annulation }}</td>
                                            </tr>
                                             <tr>
                                                <td>ajoutee le</td>
                                                <td>{{ $voiture->created_at }}</td>
                                            </tr>
                                             <tr>
                                                <td>modifiee le</td>
                                                <td>{{ $voiture->updated_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
