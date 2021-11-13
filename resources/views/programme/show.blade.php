@extends("base")

@section('title', $programme->nom)

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <section data-bs-version="5.1" class="header14 cid-sObVJU3AUD" id="header14-u">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-4 image-wrapper">
                    <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt=""
                        loading="lazy" class="lazyload"
                        data-src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                </div>
                <div class="col-12 col-md">
                    <div class="text-wrapper">
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                            <strong>{{ $programme->nom }}</strong>
                        </h1>
                        <p class="mbr-text mbr-fonts-style display-7"></p>
                        <p><strong>
                                {{ $programme->modeDeroulement }}&nbsp; &nbsp; -&nbsp; &nbsp; {{ $programme->duree }}
                                heures&nbsp;&nbsp;&nbsp;&nbsp; -
                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $programme->nombreSeance }} séances&nbsp;</strong></p>
                        <p></p>
                        <div class="mbr-section-btn mt-3">
                            @if (((auth()->user() && auth()->id()!=$programme->user_id) || !auth()->user()) &&
                            !$programme->current_user_souscription)
                            <a class="btn btn-success display-4"
                                href="{{ route('souscription.new', compact('programme')) }}">
                                <span class="mbrib-edit mbr-iconfont mbr-iconfont-btn"></span>Souscrire
                            </a>
                            @endif
                            @auth
                                @if (auth()->id() == $programme->user_id)
                                    <form method="post" action="{{ route('programme.destroy', compact('programme')) }}"
                                        class="btn">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-secondary display-4" href="#">
                                            <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                                            Supprimer
                                        </button>
                                    </form>
                                    <a class="btn btn-success display-4" href="#table01-x">
                                        <span class="mbrib-users mbr-iconfont mbr-iconfont-btn"></span>Participants</a>
                                    <a class="btn btn-warning display-4" href="#"><span
                                            class="mobi-mbri mobi-mbri-edit-2 mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                                @else
                                    @if ($programme->current_user_souscription && $programme->active)
                                        <a class="btn btn-danger display-4" href="">
                                            <span class="mobi-mbri mobi-mbri-close mbr-iconfont mbr-iconfont-btn"></span>Annuler
                                            ma
                                            souscription</a>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-responsable-programme :user="$programme->user" />

    <section data-bs-version="5.1" class="content5 cid-sObXMGv5hX" id="content5-v">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">

                    <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-5">
                        Description du programme</h4>
                    <p class="mbr-text mbr-fonts-style display-7">
                        {!! $programme->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
    @if (count($programme->souscriptions) < 1)
        <x-separator />
        <x-empty-message title="Vide" message="Il n'y a aucun participant pour le moment !" />
        <x-separator />
    @elseif(auth()->check() && $programme->user->id==auth()->id())
        <x-separator />
        <section data-bs-version="5.1" class="content11 cid-sOc1O66rsI" id="content11-z">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="mbr-section-btn align-center">
                            <a class="btn btn-primary display-4" href="">
                                <span class="mdi-communication-email mbr-iconfont mbr-iconfont-btn"></span>
                                Contacter
                            </a>
                            <a class="btn btn-info display-4" href="">
                                <span class="icon54-v3-export mbr-iconfont mbr-iconfont-btn"></span>
                                Exporter
                            </a>
                            <a class="btn btn-secondary display-4" href="">
                                <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                                Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-separator />

        <x-participant-list :souscriptions="$programme->souscriptions" />

        <x-separator />
    @endif

    <x-social-sharing />

    <x-separator />
@endsection
