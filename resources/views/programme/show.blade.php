@extends("base")

@section('title', '')

@section('description', '')

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
                                    <a class="btn btn-secondary display-4" href="#"><span
                                            class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>Supprimer</a>
                                    <a class="btn btn-success display-4" href="#table01-x">
                                        <span class="mbrib-users mbr-iconfont mbr-iconfont-btn"></span>Participants</a>
                                    <a class="btn btn-warning display-4" href="#"><span
                                            class="mobi-mbri mobi-mbri-edit-2 mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                                @else
                                    @if ($programme->current_user_souscription)
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

    <section data-bs-version="5.1" class="people1 cid-sOcl1Sl4ki" id="people1-1e">
        <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(16, 49, 120);">
        </div>
        <div class="container">
            <h3 class="mbr-fonts-style heading display-2"><strong>Responsable du programme</strong></h3>
            <div class="user-card">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="user_image ">
                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                alt="photo {{ $programme->user->name }}" loading="lazy" class="lazyload"
                                data-src="{{ asset('uploads/users/photos/' . $programme->user->photo) }}">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-9">
                        <div class="description">
                            <div class="user_text">
                                <p class="mbr-fonts-style small display-4">
                                    {!! $programme->user->presentation !!}
                                </p>
                            </div>
                            <div class="user_name mbr-fonts-style display-7">
                                <strong>{{ $programme->user->name }}</strong>
                            </div>
                            <div class="user_desk mbr-fonts-style display-4">
                                <span>{{ $programme->user->profession }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        <section data-bs-version="5.1" class="header2 cid-sObZq97BzO" id="header02-y">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 title-col">
                        <h6 class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-1"><strong>
                                Vide</strong></h6>
                    </div>
                    <div class="col-12 col-md-12 text-col col-lg-7">
                        <p class="mbr-text align-left mbr-fonts-style mb-0 display-5"><strong>Aucun participant pour le
                                moment</strong><br></p>
                    </div>
                </div>
            </div>
        </section>
    @elseif(auth()->check() && $programme->user->id==auth()->id())
        <x-separator />
        <section data-bs-version="5.1" class="content11 cid-sOc1O66rsI" id="content11-z">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="mbr-section-btn align-center"><a class="btn btn-primary display-4" href=""><span
                                    class="mdi-communication-email mbr-iconfont mbr-iconfont-btn"></span>Contacter</a> <a
                                class="btn btn-info display-4" href=""><span
                                    class="icon54-v3-export mbr-iconfont mbr-iconfont-btn"></span>Exporter</a> <a
                                class="btn btn-secondary display-4" href=""><span
                                    class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-separator />

        <section data-bs-version="5.1" class="table01 photom4_table01 section-table cid-sObY9vjAPL" id="table01-x">
            <div class="container-fluid">
                <div class="row align-center">
                    <div class="col-12 col-md-12">
                        <h2 class="mbr-section-title mbr-fonts-style mbr-black display-2">
                            Liste des participants</h2>
                        <div class="table-wrapper pt-5" style="width: 95%;">
                            <div class="container-fluid">
                                <div class="row search">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="dataTables_filter">
                                            <label class="searchInfo mbr-fonts-style display-7">Chercher:</label>
                                            <input class="form-control input-sm" disabled="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid scroll">
                                <table class="table table-striped isSearch" cellspacing="0"
                                    data-empty="No matching records found">
                                    <thead>
                                        <tr class="table-heads">
                                            <th class="head-item mbr-fonts-style display-4">#</th>
                                            <th class="head-item mbr-fonts-style display-4 nowrap">Nom complet</th>
                                            <th class="head-item mbr-fonts-style display-4 nowrap">Profil</th>
                                            <th class="head-item mbr-fonts-style display-4 nowrap">Email</th>
                                            <th class="head-item mbr-fonts-style display-4 nowrap">Téléphone</th>
                                            <th class="head-item mbr-fonts-style display-4 nowrap">DATE</th>
                                            <th class="head-item mbr-fonts-style display-4 nowrap">Profession</th>
                                            <th class="head-item mbr-fonts-style display-4 nowrap">ACTION</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($programme->souscriptions as $souscription)
                                            <tr>
                                                <td class="body-item mbr-fonts-style display-7 nowrap">{{$loop->index+1}}</td>
                                                <td class="body-item mbr-fonts-style display-7 nowrap">{{ $souscription->user->name }}</td>
                                                <td class="body-item mbr-fonts-style display-7 nowrap">{{ $souscription->profilConcerne->profil->nom }}</td>
                                                <td class="body-item mbr-fonts-style display-7 nowrap"><a href="mailto:{{ $souscription->user->email }}">{{ $souscription->user->email }}</a></td>
                                                <td class="body-item mbr-fonts-style display-7 nowrap"><a href="tel:{{ $souscription->user->telephone }}">{{ $souscription->user->telephone }}</a></td>
                                                <td class="body-item mbr-fonts-style display-7 nowrap">{{ date_format($souscription->created_at,'d/m/Y H:i:s') }}</td>
                                                <td class="body-item mbr-fonts-style display-7 nowrap">{{ $souscription->user->profession }}</td>
                                                <td class="body-item mbr-fonts-style display-7 nowrap">button</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="container-fluid table-info-container">
                                <div class="row info mbr-fonts-style display-7">
                                    <div class="dataTables_info">
                                        <span class="infoBefore">Vous voyez</span>
                                        <span class="inactive infoRows">{{ count($programme->souscriptions) }}</span>
                                        <span class="infoAfter">entrée(s)</span>
                                        <span class="infoFilteredBefore">(filtré sur {{ count($programme->souscriptions) }} entrée(s</span><span
                                            class="infoFilteredAfter">)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-separator />
    @endif

    <section data-bs-version="5.1" class="social1 cid-sOckozvEUn" id="share1-1a">
        <div class="container">
            <div class="media-container-row">
                <div class="col-12">
                    <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5">
                        <strong>Partager sur&nbsp;</strong>
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
