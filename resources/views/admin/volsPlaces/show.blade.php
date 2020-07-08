@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Places > Vols</title>
@endsection

@section('Tables')

    @include('admin.volsPlaces.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Places des Vols</h1>

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
                                            <td>Code place</td>
                                            <td>{{ $place->code_place }}</td>
                                        </tr>
                                        <tr>
                                            <td>Numéro de place</td>
                                            <td>{{ $place->numero_place }}</td>
                                        </tr>
                                        <tr>
                                            <td>Occupée</td>
                                            <td>{{ $place->occupee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ajoutée le </td>
                                            <td>{{ $place->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>Modifiée le</td>
                                            <td>{{ $place->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
@endsection