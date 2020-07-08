@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Agence</title>
@endsection

@section('Tables')

    @include('admin.agence.sideBar')

@endsection

@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Agence</h1>

        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Détails de l'Agence</h5>
                    </div>
                    <div class="card-body text-center">
                        <img class="text-center" src="{{ asset('storage/' . $agence->logo) }}" width="25%" >
                        <h5 class="card-title mb-0"></h5>
                        <div class="text-muted mb-2">{{ $agence->nom_agence }}</div>

                        <div>
                            <a class="btn btn-primary btn-sm text-white" disable>{{ $agence->email }}</a>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role_id == 1)
                <div class="card-header">
                   <a href="{{ route('adminAgence.edit')}}" class="btn btn-success btn-add-new col-12 mx-auto">
                        <i class="voyager-plus"></i> <span>Modifier les données de l'agence</span>
                    </a>
                </div>
                @endif
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
                                <td>Nom de l'Agence</td>
                                <td class="text-primary text-weight-bold">{{ $agence->nom_agence }}</td>
                            </tr>
                            <tr>
                                <td>Email </td>
                                <td>{{ $agence->email }}</td>
                            </tr>
                            <tr>
                                <td>Téléphone</td>
                                <td>{{ $agence->telephone }}</td>
                            </tr>
                            
                            <tr>
                                <th>Facebook</th>
                                <th>{{json_decode($agence->reseaux_sociaux)[0] }} </th>
                            </tr>
                            <tr>
                                <th>Twitter</th>
                                <th>{{json_decode($agence->reseaux_sociaux)[1] }}  </th>
                            </tr>                            
                            <tr>
                                <th>Instagram</th>
                                <th>{{json_decode($agence->reseaux_sociaux)[2] }}  </th>
                            </tr>
                            <tr>
                                <th>LinkedIn</th>
                                <th>{{json_decode($agence->reseaux_sociaux)[3] }}  </th>
                            </tr>
                            <tr>
                                <th>Données de Localisation</th>
                                <th>{{$agence->lieu_lat_long }} </th>
                            </tr>
                            <tr>
                                <th>à propos de l'Agence</th>
                                <th>{{$agence->a_propos_agence }} </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
        </div>

    </div>
</main>


@endsection