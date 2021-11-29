@extends("base")

@section('title',
    config('app.name') .
    ' - Plateforme de souscription à des programmes de formations, conférences,
    séminaires...',)

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('assets/images/mbr-1076x1145-512x512.png') }}">
    <meta property="og:image" content="{{ asset('assets/images/mbr-1076x1145-512x512.png') }}">
@endsection

@section('description',
    "Plateforme d'inscription à des programmes importants tels que les formations, les séminaires,
    les conférences...",)

@section('body')
    <section data-bs-version="5.1" class="extHeader cid-sPMNZDPZTn mb-2" id="extHeader13-2f">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="mbr-white col-md-12 col-lg-6 py-lg-0 pt-4 order-2">
                    <div class="typed-text pb-3 align-left display-2">
                        <span class="mbr-section-subtitle mbr-fonts-style display-2">Avec <strong>{{ config('app.name') }}
                            </strong>c'est</span>
                        <span>
                            <span class="animated-element mbr-bold" data-word1="révolutionnaire." data-word2="simple."
                                data-word3="plus efficace." data-word4="Lorem" data-word5="Ipsum" data-speed="50"
                                data-words="3">
                            </span>
                        </span>
                    </div>
                    <p class="mbr-section-text mbr-fonts-style align-left display-5">
                        Collectez les souscriptions et les fonds pour tous vos programmes.</p>
                    <div class="pt-3 mbr-section-btn align-left">
                        @guest
                            <a class="btn btn-md btn-white display-4"
                                href="{{ route('login') }}?ret={{ request()->fullUrl() }}">
                                <span class="mobi-mbri mobi-mbri-login mbr-iconfont mbr-iconfont-btn"></span>
                                Se connecter
                            </a>
                        @endguest
                        <a class="btn btn-md btn-danger display-4" href="{{ route('programme.pre.publish') }}">
                            <span class="icon54-v2-add-note mbr-iconfont mbr-iconfont-btn"></span>
                            Démarrer un programme
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 py-lg-0 pb-2">
                    <div class="mbr-figure">
                        <img src="{{ asset('assets/images/mbr-1076x1145.png') }}" alt="{{ config('app.name') }}"
                            title="{{ config('app.name') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="info3 cid-sObQ7wD3QR" id="info3-n">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card col-12 col-lg-10">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <x-social-sharing />
    <x-separator />
    <x-project-contributor />

@endsection
