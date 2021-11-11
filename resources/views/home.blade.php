@extends("base")

@section('title',config('app.name'))

@section('description',"Plateforme d'inscription à des programmes importants tels que les formations, les séminaires,
les conférences...")

@section("body")
<section data-bs-version="5.1" class="header3 cid-sOaM0h03gs" id="header03-2">
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(16, 49, 120);"></div>
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
@if(count($programmeActives)<1)
<section data-bs-version="5.1" class="header2 cid-sObQ3swuEE" id="header02-l">

    <div class="container">
        <div class="row">
            <div class="col-12">

            </div>
            <div class="col-12 col-md-12 col-lg-4 title-col">
                <h6 class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-1"><strong>
                        Vide</strong></h6>
            </div>
            <div class="col-12 col-md-12 text-col col-lg-7">
                <p class="mbr-text align-left mbr-fonts-style mb-0 display-5"><strong>Aucun programme n'est
                        disponible pour le moment !</strong><br></p>
            </div>
        </div>
    </div>
</section>

<x-separator />
@else
@foreach ($programmeActives as $programmeActive)
<x-programme-public-item :programme="$programmeActive" />
@endforeach
@endif


<section data-bs-version="5.1" class="social1 cid-sOaRt05zAf" id="share1-b">
    <div class="container">
        <div class="media-container-row">
            <div class="col-12">
                <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5">
                    <strong>Partager cette page sur&nbsp;</strong>
                </h3>
                <div>
                    <div class="mbr-social-likes align-center">
                        <span class="btn btn-social socicon-bg-facebook facebook m-2">
                            <i class="socicon socicon-facebook"></i>
                        </span>
                        <span class="btn btn-social twitter socicon-bg-twitter m-2">
                            <i class="socicon socicon-twitter"></i>
                        </span>
                        <span class="btn btn-social vkontakte socicon-bg-vkontakte m-2">
                            <i class="socicon socicon-vkontakte"></i>
                        </span>
                        <span class="btn btn-social odnoklassniki socicon-bg-odnoklassniki m-2">
                            <i class="socicon socicon-odnoklassniki"></i>
                        </span>
                        <span class="btn btn-social pinterest socicon-bg-pinterest m-2">
                            <i class="socicon socicon-pinterest"></i>
                        </span>
                        <span class="btn btn-social mailru socicon-bg-mail m-2">
                            <i class="socicon socicon-mail"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-separator />
@endsection