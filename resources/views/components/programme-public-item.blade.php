<div class="card mb-3" style="border: 2px solid #BA265E;">
    <a href="{{ route('programme.show', compact('programme')) }}">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}"
                    class="img-fluid rounded-start" alt="{{ $programme->nom }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title display-7"><strong>{{ $programme->nom }}</strong></h5>
                    <div class="row">
                        <div class="col-12">
                            @foreach ($programme->profilConcernes as $profilConcerne)
                                @if(!$loop->first) &nbsp; &nbsp; @endif <span class="badge bg-secondary">{{ $profilConcerne->profil->nom }}
                                    ({{ $profilConcerne->montant > 0 ? $profilConcerne->montant . ' CFA' : 'Gratuit' }})</span>
                                {{-- <button type="button" class="btn btn-primary position-relative">
                                    {{ $profilConcerne->profil->nom }}
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $profilConcerne->montant > 0 ? $profilConcerne->montant . ' CFA' : 'Gratuit' }}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </button> --}}
                            @endforeach
                        </div>
                    </div>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>Par
                            {{ $programme->user->name }}</strong> -
                        <strong>{{ $programme->modeDeroulement }}</strong>
                        <br>
                        Démarrage: {{ date_format(new DateTime($programme->dateDemarrage), 'd/m/Y') }}
                    </p>
                    <p class="card-text"><small class="text-muted">Clôture des inscriptions prévue pour le
                            <strong>{{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong></small>
                    </p>
                </div>
            </div>
        </div>
    </a>
</div>
