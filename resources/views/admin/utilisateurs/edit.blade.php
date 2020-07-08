@extends('admin.masterAdmin')


@section('title-page-admin')
    <title>Modifier un Utilisateur</title>
@endsection

@section('Tables')

    @include('admin.utilisateurs.sideBar')

@endsection

@section('table-content')
<main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h2 mb-3">Modifier un Utilisateur</h1>

                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">

                                    <h3 class="card-title mb-0">Informations</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('adminUtilisateur.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputFirstName">Nom</label>
                                                <input type="text" class="form-control" id="inputFirstName" name="nom" placeholder="Nom" value="{{ $user->name }}">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">Email</label>
                                                <input type="email" class="form-control" id="inputAddress" name="email" placeholder="Email" value="{{ $user->email }}">
                                            </div>
                                            
                                            <div class="form-row col-md-12">
                                                <div class="form-group col-md-12">
                                                    <label class="form-label w-100">Image</label>
                                                    <img class="text-center" src="{{ asset('storage/' . $user->avatar) }}" width="8%" >
                                                </div>

                                                <div class="form-group col-md-12">   
                                                    <input type="file" name="image" accept="image/*" value="{{ $user->avatar }}">

                                                    <small class="form-text text-muted">Example block-level help text here.</small>
                                                </div>    
                                            </div>  
                                                
                                        
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
