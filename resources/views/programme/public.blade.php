@extends("base")

@section('title', config('app.name') . ' - Programmes en cours')

@section('body')
    <section data-bs-version="5.1" class="header2 cid-sOct20N5Ut" id="header02-1n">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 title-col">
                    <h6 class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-2">
                        <strong>Liste des programmes</strong>
                    </h6>
                </div>
                <div class="col-12 col-md-12 text-col col-lg-12">
                    <a class="btn btn-md btn-danger display-4" href="{{ route('programme.pre.publish') }}">
                        <span class="icon54-v2-add-note mbr-iconfont mbr-iconfont-btn"></span>
                        Lancer un programme
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="shop1 cid-sOcsUFykIr mb-5" id="shop01-1m">
        <div class="container">
            <div class="row align-left justify-content-center mt-4">
                @if (count($programmeActives) < 1)
                    <x-empty-message title="Pas encore de programme"
                        message="Aucun programme n'est encore disponible pour le moment !" />
                    <x-separator />
                @else
                    <x-separator />
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
