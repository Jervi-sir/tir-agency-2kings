@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Omras</title>
@endsection

@section('Tables')

    @include('admin.omras.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Omras</h1>

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
                                                <td>{{ $omra->titre }}</td>
                                            </tr>
                                            <tr>
                                                <td>Image</td>
                                                <td><img src="{{ secure_asset('storage/' . $omra->image) }}"></td>
                                            </tr>

                                            <tr>
                                                <td>Prix</td>
                                                <td>{{ $omra->prix }}</td>
                                            </tr>

                                            <tr>
                                                <td>Lieu</td>
                                                <td>{{ $omra->lieu }}</td>
                                            </tr>

                                            <tr>
                                                <td>Max jours</td>
                                                <td>{{ $omra->max_jour }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $omra->email }}</td>
                                            </tr>

                                            <tr>
                                                <td>Type</td>
                                                <td>{{ $omra->type_service }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $omra->description }}</td>
                                            </tr>
                                             <tr>
                                                <td>Ajoutée le</td>
                                                <td>{{ $omra->created_at }}</td>
                                            </tr>
                                             <tr>
                                                <td>Modifiée le</td>
                                                <td>{{ $omra->updated_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
