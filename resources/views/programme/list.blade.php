@extends("base")

@section('title', Str::upper($title))

@section('body')
    <section data-bs-version="5.1" class="header2 cid-sOct20N5Ut" id="header02-1n">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 title-col">
                    <h6 class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-2">
                        <strong>{{ Str::upper($title) }}</strong>
                    </h6>
                </div>
                <div class="col-12 col-md-12 text-col col-lg-7">
                    <p class="mbr-text align-left mbr-fonts-style mb-0 display-5"><strong>La liste de
                            {{ $title }}</strong><br></p>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="shop1 cid-sOcsUFykIr" id="shop01-1m">
        <div class="container">
            <div class="row align-left justify-content-center mt-4">
                @forelse ($programmes as $programme)
                    <div class="item features-image сol-12 col-md-6 col-lg-3">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <a href="{{ route('programme.show', compact('programme')) }}">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                        loading="lazy" class="lazyload"
                                        data-src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                                </a>
                            </div>
                            <div class="item-content">
                                <h5 class="item-title mbr-fonts-style display-4">
                                    <a
                                        href="{{ route('programme.show', compact('programme')) }}">{{ $programme->nom }}</a>
                                </h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7">
                                    <strong>{{ $programme->modeDeroulement }}</strong>
                                </h6>
                            </div>

                        </div>
                    </div>
                @empty
                    <x-empty-message title="Programme vide" message="Cette section ne contient encore aucune donnée." />
                @endforelse
            </div>
        </div>
    </section>
@endsection
