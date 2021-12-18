@extends("base")

@section('title', Str::upper($title))

@section('body')
    <section data-bs-version="5.1" class="header2 cid-sOct20N5Ut" id="header02-1n">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 title-col">
                    <h6 class="mbr-section-subtitle align-left mbr-fonts-style mt-3 mb-0 display-2">
                        <strong>{{ Str::upper($title) }}</strong>
                    </h6>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="shop1 cid-sOcsUFykIr" id="shop01-1m">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="list-group mb-3">
                        <div class="row">
                            @forelse ($programmes as $programme)
                                <div class="col-12 col-lg-6 mt-2">
                                    <a href="{{ route('programme.show', compact('programme')) }}"
                                        class="list-group-item list-group-item-action flex-column align-items-start @if (!($programme->suspendu || $programme->active)) active @endif">
                                        <div class="row">
                                            <div class="col-4">
                                                <img style="height: 85px"
                                                    src="{{ isset($programme->image) ? asset('uploads/programmes/images/' . $programme->image) : 'https://via.placeholder.com/100' }}">
                                            </div>
                                            <div class="col-8">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">{{ $programme->nom }}</h6>
                                                    <small class="nowrap">{{ count($programme->souscriptions) }}</small>
                                                </div>
                                                <p class="mb-1">
                                                    {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</p>
                                                <small>{{ $programme->modeDeroulement }} - </small>
                                                <small>{{ $programme->typeProgramme->nom }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <x-empty-message title="Programme vide"
                                    message="Cette section ne contient encore aucune donnée." />
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
