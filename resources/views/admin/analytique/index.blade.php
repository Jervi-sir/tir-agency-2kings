@extends('admin.masterAdmin')


@section('title-page-admin')
<title>Agence</title>
@endsection

@section('Tables')

    @include('admin.analytique.sideBar')

@endsection

@section('table-content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Total des different services</h1>
        <div class="row">
            <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                             <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Hotels</h5>
                                    <h1 class="display-5 mt-1 mb-3">{{ $hotels->count() }}</h1>
                                    <div class="mb-1">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $chambres->count() }} </span>
                                        <span class="text-muted">Chambres au total</span>
                                    </div>
                                </div>
                            </div>
                           <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Voitures</h5>
                                    <h1 class="display-5 mt-1 mb-3">{{ $voitures->count()}} </h1>
                                    <div class="mb-1">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>{{ $voitures->where('occupee','1')->count()}} </span>
                                        <span class="text-muted">voitures occupées</span>
                                    </div>
                                    <div class="mb-1">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>{{ $voitures->where('occupee','0')->count()}} </span>
                                        <span class="text-muted">voitures libres</span>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-6">
                             <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Avions</h5>
                                    <h1 class="display-5 mt-1 mb-3">{{ $vols->count() }}</h1>
                                    <div class="mb-1">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $places->count() }}</span>
                                        <span class="text-muted">places au total</span>
                                    </div>
                                    <div class="mb-1">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> </span>
                                        <span class="text-muted"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Clients</h5>
                                    <h1 class="display-5 mt-1 mb-3" style="padding-bottom: 1.78em;">{{ $utilisateurs->where('role_id',2)->count()}}</h1>
                                    <div class="mb-1">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> </span>
                                        <span class="text-muted"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Analytique des Voitures</h5>
                            <h6 class="card-subtitle text-muted">Percevoire les voitures occupées des voitures libres.</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-pie"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
    <script>
        var libres = JSON.parse("{{ json_encode($voitures->where('occupee','0')->count()) }}");
        var occupees = JSON.parse("{{ json_encode($voitures->where('occupee','1')->count()) }}");

        $(function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-pie"), {
                type: "pie",
                data: {
                    labels: ["Libres", "Occupées"],
                    datasets: [{
                        data: [libres, occupees],
                        backgroundColor: [
                            "#222e3c",
                            "#dee2e6"
                        ],
                        borderColor: "transparent"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    }
                }
            });
        });
    </script>


@endsection