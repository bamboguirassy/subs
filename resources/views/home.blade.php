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
    <section data-bs-version="5.1" class="extHeader cid-sPMNZDPZTn" id="extHeader13-2f">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="mbr-white col-md-12 col-lg-8 py-lg-0 pt-1 order-2">
                    <div class="typed-text pb-3 align-left display-2">
                        <span class="mbr-section-subtitle mbr-fonts-style display-5">Grace à nos robots et nos algorithmes intelligents qui s'occupent de tout à votre place... Suivez vos programmes de manière </span>
                        <span>
                            <span class="animated-element mbr-bold" data-word1="révolutionnaire." data-word2="sécurisée."
                                data-word3="transparente." data-word4="Lorem" data-word5="Ipsum" data-speed="50"
                                data-words="3">
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-lg-6 py-lg-0 pb-2">
                    <div class="mbr-figure">
                        <img src="{{ asset('assets/images/fulllogo_nobuffer.png') }}" alt="{{ config('app.name') }}"
                            title="{{ config('app.name') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="shop1 cid-sOcsUFykIr mb-5" id="shop01-1m">
        <div class="container">
            <p class="lead">
                Découvrez d'autres programmes auxquels vous pourrez participer...
            </p>
            <div class="row align-left justify-content-center">
                @if (count($programmeActives) < 1)
                    <x-empty-message title="Pas encore de programme"
                        message="Aucun programme n'est encore disponible pour le moment !" />
                    <x-separator />
                @else
                    @foreach ($programmeActives as $programmeActive)
                        @if ($programmeActive->is_collecte_fond)
                            <x-collecte-fond-public-item :programme="$programmeActive" />
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
