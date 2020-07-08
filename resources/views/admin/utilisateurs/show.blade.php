s@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Utilisateur</title>
@endsection

@section('Tables')

    @include('admin.utilisateurs.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Utilisateurs</h1>

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
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td >Email</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td >Avatar</td>
                                                <td ><img src="{{ secure_asset( $user->avatar) }}" style="width: 11%;"></td>
                                            </tr>
                                            <tr>
                                                <td>Email vérifiée dans</td>
                                                <td>{{ $user->email_verified_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ajoutée le </td>
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Modifiée le</td>
                                                <td>{{ $user->updated_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
