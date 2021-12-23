@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('moreCss')
    <style>
        .list-group-item:hover {
            background-color: #BA265E;
            color: white !important;
        }

    </style>
@endsection

@section('body')
    <div style="margin-top: 70px;" class="d-none d-sm-block"></div>
    <div class="card" style="padding-top: 70px; background-color: #BA265E">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <h5 class="card-title display-7 text-primary"><b>{{ $programme->nom }}</b>
                                            </h5>
                                            <p class="card-text">Pour souscrire, veuillez choisir la session à la
                                                quelle vous souhaitez participer...</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ol class="list-group">
                                            @foreach ($programme->sessionActives as $session)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-start">
                                                    <a href="{{ route('souscription.new', ['programme'=>$session]) }}?step=module" style="display: block">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold text-primary">{{ $session->nom }}
                                                            </div>
                                                            <strong>Clôture Insc. :
                                                                {{ date_format(new DateTime($session->dateDemarrage), 'd/m/Y') }}</strong>
                                                            <br>
                                                            Démarrage :
                                                            {{ date_format(new DateTime($session->dateDemarrage), 'd/m/Y') }}
                                                        </div>
                                                        @if (!$session->active)
                                                            <span class="badge bg-primary rounded-pill">passée</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-separator />
    <hr class="mt-5">
@endsection
