@extends("base")

@section('title', config('app.name'))

@section('description',
    "Plateforme d'inscription à des programmes importants tels que les formations, les séminaires,
    les conférences...")

@section('body')
    <section data-bs-version="5.1" class="header3 cid-sOaM0h03gs" id="header03-2">
        <div class="mbr-overlay" style="opacity: 0.5; background-color: #2ca9d7;"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong>Subs</strong></h1>

                    <p class="mbr-text mbr-fonts-style mb-4 display-7"><strong>Votre plateforme de souscription aux
                            programmes les plus importants (Formations, Séminaires, Conférences, ...)</strong><br></p>
                    <div class="mbr-section-btn mt-3">
                        @guest
                            <a class="btn btn-lg btn-primary display-4" href="{{ route('login') }}"><span
                                    class="mobi-mbri mobi-mbri-login mbr-iconfont mbr-iconfont-btn"></span>Se connecter</a>
                        @endguest
                        <a class="btn btn-lg btn-white display-4" href="{{ route('programme.create') }}"><span
                                class="icon54-v2-add-note mbr-iconfont mbr-iconfont-btn"></span>Publier un programme</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-separator />
    @if (count($programmeActives) < 1)
        <x-empty-message title="Pas encore de programme"
            message="Aucun programme n'est encore disponible pour le moment !" />

        <x-separator />
    @else
        @foreach ($programmeActives as $programmeActive)
            <x-programme-public-item :programme="$programmeActive" />
        @endforeach
    @endif

    <x-social-sharing />

@endsection
