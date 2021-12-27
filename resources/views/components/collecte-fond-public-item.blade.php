<div class="card mb-3" style="border: 2px solid #BA265E;">
    <a href="{{ route('souscription.new',compact('programme')) }}">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ isset($programme->image) ? asset('uploads/programmes/images/' . $programme->image) : asset('assets/images/fulllogo_nobuffer.png') }}"
                    class="img-fluid rounded-start" alt="{{ $programme->nom }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title display-4"><strong>{{ $programme->nom }}</strong></h5>
                    <p class="card-text display-4">Clôture prévue pour le
                        <strong>{{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong>
                    </p>
                    <div class="progress">
                        <div class="progress-bar  progress-bar-striped actif" role="progressbar" style="width: {{ $programme->taux_collecte }}%;" aria-valuenow="{{ $programme->taux_collecte }}"
                            aria-valuemin="0" aria-valuemax="100">{{ $programme->taux_collecte }}%</div>
                    </div>
                    <p class="mbr-section-text mbr-fonts-style align-left display-4 mt-1">{{ $programme->gain_net }} FCFA collecté sur {{ $programme->montantObjectif }} FCFA</p>
                    <p class="mbr-section-text mbr-fonts-style align-left mt-1">{!! \Str::limit($programme->description, 200, '...') !!}</p>
                </div>
            </div>
        </div>
    </a>
</div>
