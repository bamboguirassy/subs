<section data-bs-version="5.1" class="header1 cid-sOaP0lyp09" id="header01-5">
    <div class="container">
        <div class="row align-left justify-content-center align-items-center">
            <div class="col-12 col-md-12 col-lg-6 image-wrapper">
                <div class="price-wrapper">
                    @foreach ($programme->profilConcernes as $profilConcerne)
                        <h5 class="price-title mbr-fonts-style m-0 display-8">
                            <strong>{{ $profilConcerne->profil->nom }}</strong>
                        </h5>
                        <h6 class="price mbr-fonts-style display-8">
                            <strong>{{ $profilConcerne->montant > 0 ? $profilConcerne->montant . ' CFA' : 'Gratuit' }}</strong>
                        </h6>
                    @endforeach
                </div>
                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt=""
                    loading="lazy" class="lazyload"
                    data-src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="text-wrapper">
                    <h1 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                        <strong>{{ $programme->nom }}</strong>
                    </h1>
                    <p class="mbr-text mbr-fonts-style mb-4 display-7">Nombre participants attendus :
                        {{ $programme->nombreParticipants == 0 ? 'Illimité' : $programme->nombreParticipants }}
                        <br>
                        Clôture inscription: {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}
                        <br>Démarrage: {{ date_format(new DateTime($programme->dateDemarrage), 'd/m/Y') }}
                    </p>
                    <div class="cards mb-4">
                        <div class="card-wrapper">
                            <span class="mbr-iconfont card-icon m-auto mobi-mbri-protect mobi-mbri"></span>
                            <div class="card-box">
                                <h4 class="card-title mbr-fonts-style display-4"><strong>Par
                                        {{ $programme->user->name }}</strong>
                                </h4>
                            </div>
                        </div>
                        <div class="card-wrapper">
                            <span class="mbr-iconfont card-icon m-auto mobi-mbri-globe mobi-mbri"></span>
                            <div class="card-box">
                                <h4 class="card-title mbr-fonts-style display-4">
                                    <strong>{{ $programme->modeDeroulement }}</strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="mbr-section-btn mt-3">
                        <a class="btn btn-lg btn-warning display-4"
                            href="{{ route('souscription.new', compact('programme')) }}">
                            <span class="mbri-edit mbr-iconfont mbr-iconfont-btn"></span>Souscrire</a>
                        <a class="btn btn-lg btn-primary display-4"
                            href="{{ route('programme.show', compact('programme')) }}">
                            <span
                                class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont mbr-iconfont-btn"></span>Détails</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-separator />
