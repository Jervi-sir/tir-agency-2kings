@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Ajouter des Places de Vol</title>
@endsection

@section('Tables')

    @include('admin.volsPlaces.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Vols</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0"></h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Titre</label>
                                                <input type="text" class="form-control" id="inputFirstName" placeholder="Titre">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Numéro de places</label>
                                                <input type="number" min="1" class="form-control" id="inputFirstName" placeholder="Titre">
                                            </div>
                                        </div>
                                        /** mazal since i want les places filll up automatically when a place is created 


                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputState">Type de Voiture</label>
                                                <select id="inputState" class="form-control">
                                                    <option selected="">Choisir...</option>
                                                    <option>...</option>
                                                 </select>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
