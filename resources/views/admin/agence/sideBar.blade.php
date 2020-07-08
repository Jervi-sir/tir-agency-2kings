<ul class="sidebar-nav">
    <li class="sidebar-item ">
        <a class="sidebar-link" href="{{ route('adminProfile.index') }}">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
        </a>
    </li>
    <li class="sidebar-item ">
        <a class="sidebar-link" href="{{ route('adminAnaletique.index') }}">
            <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Analytiques</span>
        </a>
    </li>
    <li class="sidebar-item active">
        <a class="sidebar-link" href="{{ route('adminAgence.index') }}">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Agence</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('rendezvous.index') }}">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Rendez-Vous</span>
        </a>
    </li>


    <li class="sidebar-item ">
        <a href="#ui" data-toggle="collapse" class="sidebar-link">
            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Vos Tables</span>
        </a>
        <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
        @if(Auth::user()->role_id == 1)
        <li class="sidebar-item "><a class="sidebar-link" href="{{ route('adminUtilisateur.index') }}">Utilisateur</a></li>
        @endif
            <li class="sidebar-item "><a class="sidebar-link" href="{{ route('adminHotels.index') }}">Hôtels</a></li>
            <li class="sidebar-item "><a class="sidebar-link" href="{{ route('adminChambres.index') }}">Chambres</a></li>
            <li class="sidebar-item "><a class="sidebar-link" href="{{ route('adminVoitures.index') }}">Voitures</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('adminAvions.index') }}">Avions</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('adminPlaces.index') }}">Places de Vol</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('adminOmras.index') }}">Omras</a></li>
        </ul>
    </li>
</ul>