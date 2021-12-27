<div class="col-12 mt-2">
    <a href="{{ route('programme.show', compact('programme')) }}"
        class="list-group-item list-group-item-action flex-column align-items-start @if (!$programme->suspendu && $programme->active) actif @endif">
        <div class="row">
            <div class="col-4">
                <img style="height: 85px"
                    src="{{ isset($programme->image) ? asset('uploads/programmes/images/' . $programme->image) : 'https://via.placeholder.com/100' }}">
            </div>
            <div class="col-8">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">{{ $programme->nom }}</h6>
                    @if ($programme->is_proprietaire)
                        <small
                            class="nowrap">{{ count($programme->souscriptions) }}</small>
                    @elseif($programme->montant>0)
                        <small
                            class="nowrap">{{ $programme->montant }} FCFA</small>
                    @endif
                </div>
                <p class="mb-1">
                    {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</p>
                <small>{{ $programme->modeDeroulement }} - </small>
                <small>{{ $programme->typeProgramme->nom }}</small>
            </div>
        </div>
    </a>
</div>
