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
    <section data-bs-version="5.1" class="extHeader cid-sPMNZDPZTn mb-2" style="margin-top: 20px;" id="extHeader13-2f">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="mbr-white col-md-12 col-lg-8 py-lg-0 pt-1 order-2">
                    <div class="typed-text pb-3 align-left display-2">
                        <span class="mbr-section-subtitle mbr-fonts-style display-2">Suivez vos programmes de manière </span>
                        <span>
                            <span class="animated-element mbr-bold" data-word1="révolutionnaire." data-word2="sécurisée."
                                data-word3="transparente." data-word4="Lorem" data-word5="Ipsum" data-speed="50"
                                data-words="3">
                            </span>
                        </span>
                    </div>
                    <p class="mbr-section-text mbr-fonts-style align-left display-5">
                        {{-- Collectez les fonds et les inscriptions pour tous vos programmes de manière transparente, sécurisée
                        et automatisée... --}}
                        Grace à nos robots qui s'occupent de tout à votre place...
                    </p>
                    <div class="pt-3 mbr-section-btn align-left">
                        <a class="btn btn-md btn-white display-4" href="{{ route('programme.pre.publish') }}">
                            <span class="icon54-v2-add-note mbr-iconfont mbr-iconfont-btn"></span>
                            Créer un programme
                        </a>
                        {{-- <a class="btn btn-md btn-white display-4" href="{{ route('programme.public.list') }}">
                            <span class="icon54-v2-note-list mbr-iconfont mbr-iconfont-btn"></span>
                            Découvrir d'autres programmes
                        </a> --}}
                    </div>
                </div>
                <div class="col-lg-4 py-lg-0 pb-2">
                    <div class="mbr-figure">
                        <img src="{{ asset('assets/images/fulllogo_nobuffer.png') }}" alt="{{ config('app.name') }}"
                            title="{{ config('app.name') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-programme-type-choice />
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
@endsection
