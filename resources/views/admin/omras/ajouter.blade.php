@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Ajouter une Omra</title>
@endsection

@section('Tables')

    @include('admin.omras.sideBar')

@endsection

@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Omras</h1>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                        <h5 class="card-title mb-0"></h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminOmras.ajouter')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre</label>
                                    <input type="text" class="form-control" name="titre" placeholder="Titre">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre du vol</label>
                                    <input type="text" class="form-control" name="vol_titre" placeholder="Titre du vol">
                                </div>

                                 <div class="form-group col-md-12">
                                    <label for="inputFirstName">Titre du vol</label>
                                    <input type="text" class="form-control" name="hotel_titre" placeholder="Titre d'hôtel">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="inputFirstName">Slug</label>
                                    <input type="text" class="form-control" name="slug" placeholder="Slug">
                                </div>

                            </div>
                            

                            <div class="form-group">
                                <label for="inputAddress">Lieu</label>
                                <input type="text" class="form-control" name="lieu" placeholder="Lieu">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Adresse e-mail">
                            </div>

                            <div class="form-group">
                                <label for="inputLastName">Prix</label>
                                <input type="number" min="1" class="form-control" name="prix" placeholder="Prix">
                            </div>
                            
                            <div class="form-group">
                                <label for="inputAddress2">Max jour:</label>
                                <input type="number" min="1" class="form-control" name="max_jour" placeholder="Max jour">
                            </div>

                            <!--mazal-->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputState">Type de omra</label>
                                    <select name="type_omra" class="form-control">
                                        <option selected="">Choisir...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label w-100">Image</label>
                                <input type="file" name="image" accept="image/*">

                            </div>
                            
                            <div class="form-group">
                                <label class="form-label w-100">Images</label>
                                <input id="images_multiple" type="file" name="images1[]" multiple="multiple" accept="image/*" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Textarea" rows="1" style="margin-top: 0px; margin-bottom: 0px; height: 64px;"></textarea>
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