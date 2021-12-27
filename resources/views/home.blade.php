@extends("base")

@section('title',
    config('app.name') .
    ' - Plateforme de collecte pour les formations, tontines, cotisation et levée de
    fond pour tous...',)

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('assets/images/fulllogo_nobuffer.png') }}">
    <meta property="og:image" content="{{ asset('assets/images/fulllogo_nobuffer.png') }}">
@endsection

@section('description',
    "Plateforme d'inscription à des programmes importants tels que les formations, les séminaires,
    les conférences...",)

@section('body')
    <div class="d-none d-sm-block" style="margin-top: 70px;"></div>
    <section data-bs-version="5.1" class="extHeader cid-sPMNZDPZTn pt-5" id="extHeader13-2f">
        <div class="container">
            <div class="row justify-content-center align-items-center justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="searchInput" class="form-label"></label>
                                <input type="text" class="form-control form-control-sm" name="searchInput" id="searchInput"
                                    placeholder="Rechercher un programme">
                            </div>
                        </div>
                        <div class="col-12">
                            <ol class="list-group">
                                @auth
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        data-bs-toggle="offcanvas" data-bs-target="#userProgrammeList"
                                        aria-controls="userProgrammeList">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold text-primary">Programmes publiés</div>
                                            Programmes que vous avez créé
                                        </div>
                                        <span
                                            class="badge bg-primary rounded-pill">{{ count(auth()->user()->programmes) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        data-bs-toggle="offcanvas" data-bs-target="#userSouscriptionList"
                                        aria-controls="userSouscriptionList">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold text-primary">Souscriptions</div>
                                            Programmes souscrits
                                        </div>
                                        <span
                                            class="badge bg-primary rounded-pill">{{ count(auth()->user()->main_subscribed_programs) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        data-bs-toggle="offcanvas" data-bs-target="#hisroriqueAchatSms"
                                        aria-controls="hisroriqueAchatSms">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold text-primary">Solde SMS</div>
                                            SMS pour gérer les rappels
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{ auth()->user()->nombreSms }}</span>
                                    </li>
                                @endauth
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <a href="{{ route('achatsms.create') }}" class="btn btn-primary w-100"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                                        aria-controls="offcanvasExample">Créer un programme &nbsp;
                                        <span class="mbri-plus"></span>
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 col-lg-4 py-4 bg-white mx-auto">
                    {{ $qrcode }}
                </div> --}}
                <div class="mbr-white col-md-12 col-lg-8 py-lg-0 pt-1 order-2">
                    {{-- <div class="typed-text pb-3 align-left display-2">
                        <span class="mbr-section-subtitle mbr-fonts-style display-5">Grace à nos robots et nos algorithmes
                            intelligents qui s'occupent de tout à votre place... Suivez vos programmes de manière </span>
                        <span>
                            <span class="animated-element mbr-bold" data-word1="révolutionnaire." data-word2="sécurisée."
                                data-word3="transparente." data-word4="Lorem" data-word5="Ipsum" data-speed="50"
                                data-words="3">
                            </span>
                        </span>
                    </div> --}}
                </div>
                {{-- <div class="col-lg-6 py-lg-0 pb-2">
                    <div class="mbr-figure">
                        <img src="{{ asset('assets/images/fulllogo_nobuffer.png') }}" alt="{{ config('app.name') }}"
                            title="{{ config('app.name') }}">
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="shop1 cid-sOcsUFykIr mb-5" id="shop01-1m">
        <div class="container">
            <p class="lead">
                Découvrez d'autres programmes auxquels vous pourrez participer...
            </p>
            <div class="row align-left justify-content-center m-1">
                @if (count($programmeActives) < 1)
                    <x-empty-message title="Pas encore de programme"
                        message="Aucun programme n'est encore disponible pour le moment !" />
                    <x-separator />
                @else
                    @foreach ($programmeActives as $programmeActive)
                        @if ($programmeActive->is_collecte_fond)
                            <x-collecte-fond-public-item :programme="$programmeActive" />
                        @elseif($programmeActive->is_formation_modulaire)
                            <x-formation-modulaire-item :programme="$programmeActive" />
                        @else
                            <x-programme-public-item :programme="$programmeActive" />
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <x-social-sharing />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <hr style="padding-top: 10px; background: white;">
            </div>
        </div>
    </div>
@endsection
