@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Vols</title>
@endsection

@section('Tables')

    @include('admin.avions.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Vols</h1>

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
                                                <td>{{ $vol->titre }}</td>
                                            </tr>
                                            <tr>
                                                <td >Place</td>
                                                <td>{{ $vol->nombre_places }}</td>
                                            </tr>
                                            <tr>
                                                <td >Image</td>
                                                <td>{{ $vol->image }}</td>
                                            </tr>
                                            <tr>
                                                <td >Images</td>
                                                <td>{{ $vol->images }}</td>
                                            </tr>
                                            <tr>
                                                <td >Type de vol</td>
                                                <td>{{ $vol->type_Vol }}</td>
                                            </tr>
                                            <tr>
                                                <td >Lieu</td>
                                                <td>{{ $vol->lieu }}</td>
                                            </tr>
                                            <tr>
                                                <td >Nom d'avion</td>
                                                <td>{{ $vol->nom_avion }}</td>
                                            </tr>
                                            <tr>
                                                <td >Code d'avion</td>
                                                <td>{{ $vol->code_vol }}</td>
                                            </tr>
                                            <tr>
                                                <td >Nom de la ligne</td>
                                                <td>{{ $vol->ligne_nom }}</td>
                                            </tr>
                                            <tr>
                                                <td >Description</td>
                                                <td>{{ $vol->description }}</td>
                                            </tr>
                                            <tr>
                                                <td >Etoiles</td>
                                                <td>{{ $vol->etoiles }}</td>
                                            </tr>
                                            <tr>
                                                <td >Date de départ</td>
                                                <td>{{ $vol->date_depart }}</td>
                                            </tr>
                                            <tr>
                                                <td >Date d'arrivée</td>
                                                <td>{{ $vol->date_arrivee }}</td>
                                            </tr>
                                            <tr>
                                                <td >Ligne de départ</td>
                                                <td>{{ $vol->ligne_depart }}</td>
                                            </tr>
                                            <tr>
                                                <td >Ligne d'arrivée</td>
                                                <td>{{ $vol->ligne_arrivee }}</td>
                                            </tr>
                                            <tr>
                                                <td >Dernier délai de vol</td>
                                                <td>{{ $vol->dernier_delai_de_vol }}</td>
                                            </tr>
                                            <tr>
                                                <td >Délai de promotion</td>
                                                <td>{{ $vol->promotion_delai }}</td>
                                            </tr>
                                            <tr>
                                                <td >Prix</td>
                                                <td>{{ $vol->prix }}</td>
                                            </tr>
                                            <tr>
                                                <td >Promotion</td>
                                                <td>{{ $vol->promotion_pourcentage }}</td>
                                            </tr>
                                            <tr>
                                                <td >Annulation</td>
                                                <td>{{ $vol->annulation }}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
