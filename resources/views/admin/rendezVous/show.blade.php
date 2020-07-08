@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Rendez-Vous</title>
@endsection

@section('Tables')
    @include('admin.rendezVous.sideBar')
@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Rendez-Vous</h1>

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
                                                <td >Nom</td>
                                                <td>{{ $meet->nom }}</td>
                                            </tr>
                                            <tr>
                                                <td >Prénom</td>
                                                <td>{{ $meet->prenom }}</td>
                                            </tr>
                                            <tr>
                                                <td >au Sujet de</td>
                                                <td>{{ $meet->omra->titre }}</td>
                                            </tr>
                                            <tr>
                                                <td>Téléphone</td>
                                                <td>{{ $meet->telephone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $meet->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date de Rendeez-Vous</td>
                                                <td>{{ $meet->date_rendez_vous }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ajoutée le </td>
                                                <td>{{ $meet->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Modifiée le</td>
                                                <td>{{ $meet->updated_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
