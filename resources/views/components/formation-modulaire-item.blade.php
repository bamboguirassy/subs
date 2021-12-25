<div class="card mb-3" style="border: 1px solid gray;">
    <a href="{{ route('programme.show', compact('programme')) }}">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}"
                    class="img-fluid rounded-start" alt="{{ $programme->nom }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $programme->nom }}</h5>
                    <p class="card-text">{!! Str::limit($programme->description, 300, '...lire la suite') !!}</p>
                    <p class="card-text"><small class="text-muted">Par {{$programme->user->name}}</small></p>
                    <ol class="list-group">
                        @foreach ($programme->sessions as $session)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold text-primary">{{ $session->nom }}</div>
                                    <strong>Clôture Insc. :
                                        {{ date_format(new DateTime($session->dateDemarrage), 'd/m/Y') }}</strong>
                                    <br>
                                    Démarrage : {{ date_format(new DateTime($session->dateDemarrage), 'd/m/Y') }}
                                </div>
                                @if (!$session->active)
                                    <span class="badge bg-primary rounded-pill">passée</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </a>
</div>
