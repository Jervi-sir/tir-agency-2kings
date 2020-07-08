@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Profil</title>
@endsection

@section('Tables')

    @include('admin.profile.sideBar')

@endsection

@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Profil</h1>

        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Détails du Profil</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ secure_asset('storage/' . Auth::user()->avatar) }}" alt="Admin" class="img-fluid rounded-circle mb-2" width="128" height="128">
                        <h5 class="card-title mb-0"></h5>
                        <div class="text-muted mb-2">{{Auth::user()->name }}</div>

                        <div>
                            @if(Auth::user()->role_id == 1)
                            <a class="btn btn-primary btn-sm text-white" disable>Administrateur</a>
                            @endif
                             @if(Auth::user()->role_id == 3)
                            <a class="btn btn-secondary btn-sm text-white" disable>Réceptionniste</a>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Données</th>
                                <th>Valeurs</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Role</td>
                                @if(Auth::user()->role_id == 1)
                                    <td class="text-primary">Administrateur</td>
                                @endif
                                    @if(Auth::user()->role_id == 2)
                                <td class="text-secondary">Réceptionniste</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Nom </td>
                                <td>{{Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Date de création</th>
                                <th>{{Auth::user()->created_at }} </th>
                            </tr>
                            <tr>
                                <th>Date de mis à jour</th>
                                <th>{{Auth::user()->updated_at }} </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
        </div>

    </div>
</main>


@endsection