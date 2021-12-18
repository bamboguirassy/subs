<section data-bs-version="5.1" class="features13 cid-sPS4hUhULW" id="features13-2q">
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
</section>
