@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Ajouter un Utilisateur</title>
@endsection

@section('Tables')

    @include('admin.utilisateurs.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h2 mb-3">Ajouter un utilisateur</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">

                                    <h3 class="card-title mb-0">Informations</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('adminUtilisateur.ajouter')}}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Nom</label>
                                                <input type="text" class="form-control" name="nom" placeholder="Titre">
                                            </div>
                                        </div>
                                       
                                        
                                       <div class="form-group">
                                            <label for="inputAddress">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress">Mot de passe</label>
                                            <input type="text" class="form-control" name="mot_de_pass" placeholder="Mot de pass">
                                        </div>

                                        <div class="form-group ">
                                            <label for="inputState">Role</label>
                                            <select id="inputState" class="form-control" name="role_id">
                                                <option >1 ..Administrateur</option>
                                                <option >2 ..Client</option>
                                                <option selected="">3 ..Réceptionniste</option>
                                                
                                            </select>
                                        </div>

                                        
                                        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



@endsection
