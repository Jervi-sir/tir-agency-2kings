<form action="{{ route('adminVoitures.rechercher') }}" class="form-inline d-none d-sm-inline-block">
    <div class="input-group input-group-navbar">
        <input type="text" class="form-control" placeholder="Rechercher..." aria-label="Search" name="titre" value="{{ request()->titre ?? '' }}">
        <div class="input-group-append">
            <button class="btn" type="submit">
                <i class="align-middle" data-feather="search"></i>
            </button>
        </div>
    </div>
</form>
