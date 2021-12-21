@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <div style="margin-top: 90px;" class="d-none d-sm-block"></div>
    <section data-bs-version="5.1" class="header14 cid-sObVJU3AUD pt-5" id="header14-u">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="card mb-3 bg-white">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $programme->nom }}</h5>
                                    <p class="card-text"><strong class="text-muted">par {{ $programme->user->name }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 bg-white pt-2 mx-auto">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-module-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-modules" type="button" role="tab" aria-controls="pills-modules"
                                aria-selected="true">Modules</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-session-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-sessions" type="button" role="tab" aria-controls="pills-sessions"
                                aria-selected="false">Sessions</button>
                        </li>
                    </ul>
                    <div class="tab-content pb-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            {!! $programme->description !!}
                        </div>
                        <div class="tab-pane fade" id="pills-modules" role="tabpanel" aria-labelledby="pills-module-tab">
                            <ol class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold text-primary">Module 1</div>
                                        Base de Linux
                                    </div>
                                    <span class="badge bg-primary rounded-pill">2500 FCFA</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold text-primary">Module 2</div>
                                        Apache
                                    </div>
                                    <span class="badge bg-primary rounded-pill">5000 FCFA</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold text-primary">Module 3</div>
                                        MySQL/MariaDB
                                    </div>
                                    <span class="badge bg-primary rounded-pill">7500 FCFA</span>
                                </li>
                                @if ($programme->is_proprietaire)
                                    <li class="list-group-item d-flex justify-content-center align-items-center">
                                        <a class="btn btn-primary" style="width: 100%">Créer des modules</a>
                                    </li>
                                @endif
                            </ol>
                        </div>
                        <div class="tab-pane fade" id="pills-sessions" role="tabpanel" aria-labelledby="pills-session-tab">
                            <ol class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold text-primary">Session 1</div>
                                        à partir du 31/12/2021
                                    </div>
                                    <span class="badge bg-primary rounded-pill">passée</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold text-primary">Session 2</div>
                                        à partir du 15/02/2021
                                    </div>
                                    <span class="badge bg-primary rounded-pill">active</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold text-primary">Session 3</div>
                                        à partir du 01/04/2021
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
                                </li>
                                @if ($programme->is_proprietaire)
                                    <li class="list-group-item d-flex justify-content-center align-items-center">
                                        <a class="btn btn-primary" style="width: 100%">Créer des sessions</a>
                                    </li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="mt-5">
@endsection
