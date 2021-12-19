<div class="card mb-3" style="border: 1px solid gray;">
    <a href="{{ route('programme.show',compact('programme')) }}">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ isset($programme->image) ? asset('uploads/programmes/images/' . $programme->image) : asset('assets/images/fulllogo_nobuffer.png') }}"
                    class="img-fluid rounded-start" alt="{{ $programme->nom }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title display-6">{{ $programme->nom }}</h5>
                    <p class="card-text display-4">Clôture prévue pour le
                        <strong>{{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong>
                    </p>
                    <div class="progress">
                        <div class="progress-bar actif" role="progressbar" style="width: 25%;" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
