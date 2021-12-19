<div class="list-group mb-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mbr-section-title mb-1 mbr-fonts-style display-4 text-primary">
                Selectionner le type de programme que vous souhaitez publier...
            </h3>
        </div>
        @forelse ($typeProgrammes as $typeProgramme)
            <div class="col-12 mt-2">
                <a title="{{$typeProgramme->description}}" href="{{ route('programme.create') }}?type={{ $typeProgramme->code }}"
                    class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center justify-content-center">
                            <div class="iconfont-wrapper col-auto">
                                <span style="font-size: 50px;" class="{{ $typeProgramme->icon }} text-primary"></span>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="justify-content-between">
                                <h5 class="mb-1 mbr-fonts-style text-primary">{{ $typeProgramme->nom }}</h5>
                                <p class="card-text mbr-fonts-style display-7">{!! Str::limit($typeProgramme->description, 60, '...') !!}</p>
                                <strong class="text-primary">
                                    Continuer
                                    avec&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="34px" height="16px" viewBox="0 0 34.53 16" xml:space="preserve">
                                        <rect class="qodef-button-line" y="7.6" width="34" height=".4"></rect>
                                        <path class="qodef-button-cap qodef-button-cap-fake"
                                            d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z"></path>
                                    </svg>
                                </strong>
                            </div>
                            {{-- <p class="mb-1">
                                {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</p>
                            <small>{{ $programme->modeDeroulement }} - </small>
                            <small>{{ $programme->typeProgramme->nom }}</small> --}}
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <x-empty-message title="Programme vide" message="Cette section ne contient encore aucune donnée." />
        @endforelse
    </div>
</div>


{{-- <section data-bs-version="5.1" class="features13 cid-sPS4hUhULW" id="features13-2q">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5 text-primary">
                    Selectionner le type de programme que vous souhaitez publier...
                </h3>
            </div>
            @foreach ($typeProgrammes as $typeProgramme)
                <div class="pile pile1 col-12 col-md-6 b">
                    <div class="text row padd-r">
                        <div class="iconfont-wrapper col-auto">
                            <span class="{{ $typeProgramme->icon }}"></span>
                        </div>
                        <div class="col">
                            <h5 class="card-title mbr-fonts-style display-4">
                                <strong>{{ $typeProgramme->nom }}</strong>
                            </h5>
                            <p class="card-text mbr-fonts-style display-7 pb-0">{{ $typeProgramme->description }}</p>
                            <h5 class="link mbr-fonts-style display-4">
                                <a href="{{ route('programme.create') }}?type={{$typeProgramme->code}}" class="btn btn-primary mbr-fonts-style display-6">Continuer
                                    avec&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="34px" height="16px" viewBox="0 0 34.53 16" xml:space="preserve">
                                        <rect class="qodef-button-line" y="7.6" width="34" height=".4"></rect>
                                        <path class="qodef-button-cap qodef-button-cap-fake"
                                            d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z"></path>
                                    </svg>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</section> --}}
