@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <section data-bs-version="5.1" class="header14 cid-sObVJU3AUD" id="header14-u">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                @isset($programme->image)
                    <div class="col-12 col-md-4 image-wrapper">
                        <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                    </div>
                @endisset
                <div class="col-12 col-md">
                    <div class="text-wrapper">
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-4">
                            <strong>{{ $programme->typeProgramme->nom }}</strong>
                        </h1>
                        @if($programme->isChild)
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-3">
                            <strong>{{ $programme->parent->nom }}</strong>
                        </h1>
                        @endif
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                            @if($programme->isChild) - &nbsp; @endif<strong>{{ $programme->nom }}</strong>
                        </h1>
                        <p class="mbr-text mbr-fonts-style display-7"></p>
                        @if ($programme->is_programme)
                            <p>
                                <strong>
                                    {{ $programme->modeDeroulement }}&nbsp; &nbsp; -&nbsp; &nbsp;
                                    {{ $programme->duree }}
                                    heures&nbsp;&nbsp;&nbsp;&nbsp; -
                                    &nbsp;&nbsp;&nbsp;&nbsp;{{ $programme->nombreSeance }} séances&nbsp;</strong>
                            </p>
                        @endif
                        <table class="table text-white">
                            @foreach ($programme->profilConcernes as $profilConcerne)
                                <tr>
                                    <th>{{ $profilConcerne->profil->nom }}</th>
                                    <td>{{ $profilConcerne->montant > 0 ? $profilConcerne->montant . ' FCFA' : 'gratuit' }}
                                    </td>
                                </tr>
                            @endforeach
                            @isset($programme->dateCloture)
                                <tr>
                                    <td>Clôture programme:</td>
                                    <th>{{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</th>
                                </tr>
                            @endisset
                            @isset($programme->montant)
                                <tr>
                                    <td>Montant:</td>
                                    <th>{{ $programme->montant }} FCFA</th>
                                </tr>
                            @endisset
                            @if ($programme->is_programme || $programme->typeProgramme->code == 'TONTINE')
                                <tr>
                                    <td>Démarrage Programme:</td>
                                    <th>{{ date_format(new DateTime($programme->dateDemarrage), 'd/m/Y') }}</th>
                                </tr>
                                <tr>
                                    <td>
                                        @if ($programme->is_programme)
                                            Nombre places :
                                        @elseif ($programme->typeProgramme->code=='TONTINE')
                                            Nombre de mains
                                        @endif
                                    </td>
                                    <th>{{ $programme->nombreParticipants == 0 ? 'Illimité' : $programme->nombreParticipants }}
                                    </th>
                                </tr>
                            @endif
                        </table>
                        <div class="mbr-section-btn mt-3">
                            @if (!$programme->active)
                                <div class="alert alert-danger" role="alert">
                                    <strong>Ce programme est cloturé le
                                        {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong>
                                </div>

                            @elseif (!$programme->current_user_souscription)
                                <a class="btn btn-white display-4"
                                    href="{{ route('souscription.new', compact('programme')) }}">
                                    <span class="mbrib-edit mbr-iconfont mbr-iconfont-btn"></span>Souscrire
                                </a>
                            @endif
                            @auth
                                @if ($programme->is_proprietaire)
                                    <form method="post" action="{{ route('programme.destroy', compact('programme')) }}"
                                        class="btn">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger display-4" href="#">
                                            <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                                            Supprimer
                                        </button>
                                    </form>
                                    <a class="btn btn-white display-4" href="#table01-x">
                                        <span class="mbrib-users mbr-iconfont mbr-iconfont-btn"></span>Participants</a>
                                    <a class="btn btn-warning display-4"
                                        href="{{ route('programme.edit', compact('programme')) }}"><span
                                            class="mobi-mbri mobi-mbri-edit-2 mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                                    @if (!$programme->active && $programme->gain_net > 0 && $programme->appelFond == null)
                                        <a class="btn btn-white display-4" href="#" data-toggle="modal" data-bs-toggle="modal"
                                            data-target="#mbr-popup-2y" data-bs-target="#mbr-popup-2y"><span
                                                class="icon54-v1-send-money mbr-iconfont mbr-iconfont-btn"></span>
                                            Faire un appel de fond
                                        </a>
                                    @endif
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
    {{-- statistique globale --}}
    @if ($programme->is_proprietaire || $programme->is_collecte_fond || (($programme->is_tontine || $programme->is_cotisation) && $programme->current_user_souscription))
        <section data-bs-version="5.1" class="numbers02 cid-sQ5yFl7EbG" id="numbers02-2v">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card md-pb col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="icon-wrapper">
                                <span class="mbr-iconfont m-auto mobi-mbri-users mobi-mbri"></span>
                            </div>
                            <div class="card-box">
                                <h4 class="card-title mbr-fonts-style mb-1 display-5">
                                    <strong>{{ count($programme->souscriptions) }}</strong>
                                </h4>
                                <h5 class="card-text mbr-fonts-style display-7"><strong>Participant(s)</strong></h5>
                            </div>
                        </div>
                    </div>
                    @if (!$programme->is_tontine)
                        <div class="card md-pb col-12 col-md-6 col-lg-3">
                            <div class="card-wrapper">
                                <div class="icon-wrapper">
                                    <span class="mbr-iconfont m-auto icon54-v1-send-money"></span>
                                </div>
                                <div class="card-box">
                                    <h4 class="card-title mbr-fonts-style mb-1 display-5"><strong>{{ $programme->gain }}
                                            FCFA</strong></h4>
                                    <h5 class="card-text mbr-fonts-style display-7"><strong>Gain</strong></h5>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!$programme->is_tontine && $programme->is_proprietaire)
                        <div class="card md-pb col-12 col-md-6 col-lg-3">
                            <div class="card-wrapper">
                                <div class="icon-wrapper">
                                    <span class="mbr-iconfont m-auto icon54-v1-send-money"></span>
                                </div>
                                <div class="card-box">
                                    <h4 class="card-title mbr-fonts-style mb-1 display-5">
                                        <strong>{{ $programme->gain_net }}
                                            FCFA</strong>
                                    </h4>
                                    <h5 class="card-text mbr-fonts-style display-7"><strong>Gain Net
                                            (-{{ $programme->tauxPrelevement }}%)</strong></h5>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($programme->is_proprietaire)
                        <div class="card md-pb col-12 col-md-6 col-lg-3">
                            <div class="card-wrapper">
                                <div class="icon-wrapper">
                                    <span class="mbr-iconfont m-auto icon54-v1-video-message"></span>
                                </div>
                                <div class="card-box">
                                    <h4 class="card-title mbr-fonts-style mb-1 display-5">
                                        <strong>{{ Auth::user()->nombreSms }}</strong>
                                    </h4>
                                    <h5 class="card-text mbr-fonts-style display-7"><strong>SMS disponible(s)</strong></h5>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <x-separator />
    @endif
    {{-- statistique des tontines --}}
    @if ($programme->is_tontine && ($programme->current_user_souscription || $programme->is_proprietaire))
        <section data-bs-version="5.1" class="extProgressBars cid-sQ5CwoL2FK" id="extProgressBars5-2x">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <h2 class="mbr-section-title pb-2 mbr-bold mbr-fonts-style align-left display-5">Evolution des
                            paiements
                            de la tontine</h2>
                        <div class="line-wrap">
                            <div class="line"></div>
                        </div>
                        <h3 class="mbr-section-sub-title pb-4 mbr-normal mbr-fonts-style align-left display-7">Suivez
                            l'évolution des paiements pour chaque tranche de la tontine...</h3>
                        <div class="progress_elements">
                            @foreach ($programme->children as $child)
                            <div class="progress1 pb-5">
                                <div class="title-wrap">
                                    <div class="progressbar-title mbr-fonts-style display-5">
                                        <p>
                                            <a href="{{ route('programme.show',['programme'=>$child]) }}">{{ $child->nom }}</a>
                                        </p>
                                    </div>
                                    <div class="progress_value mbr-fonts-style display-7">
                                        <span>{{$child->progression}}%</span>
                                    </div>
                                </div>
                                <progress class="progress progress-primary mbr-bold" max="100" value="{{$child->progression}}">
                                </progress>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <x-separator />
    @endif
    {{-- tab section --}}
    <section data-bs-version="5.1" class="tabs list1 cid-sODO1Mi024" id="list1-1r">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item first mbr-fonts-style"><a class="nav-link mbr-fonts-style show active display-7"
                                role="tab" data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab0"
                                aria-selected="true">Description</a></li>
                        @auth
                            @if ($programme->is_proprietaire)
                                <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab1"
                                        aria-selected="true">Participants</a></li>
                                {{-- <li class="nav-item"><a class="nav-link mbr-fonts-style display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab3"
                                        aria-selected="false">Séances</a></li>
                                <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab4"
                                        aria-selected="true">Certification</a></li> --}}
                            @elseif($programme->current_user_souscription)
                                <li class="nav-item"><a class="nav-link mbr-fonts-style display-7" role="tab"
                                        data-toggle="tab" data-bs-toggle="tab" href="#list1-1r_tab2" aria-selected="false">Ma
                                        souscription</a></li>
                            @endif
                        @endauth
                    </ul>
                    <div class="tab-content p-5">
                        <div id="tab1" class="tab-pane in active" role="tabpanel">
                            <div class="row">
                                @isset($programme->image)
                                    <div class="col-md-3 logo-container d-flex justify-content-center align-items-center">
                                        <div class="d-flex flex-wrap">
                                            <div class="mb-md-0 mb-3">
                                                <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                <div class="col-md">
                                    <x-programme-description :programme="$programme" />
                                </div>
                            </div>
                        </div>
                        @auth
                            @if ($programme->is_proprietaire)
                                <div id="tab2" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-participant-list :souscriptions="$programme->souscriptions" />
                                        </div>
                                    </div>
                                </div>
                            @elseif($programme->current_user_souscription)
                                <div id="tab5" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-souscription-details :souscription="$programme->current_user_souscription" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end tab section --}}
    <x-responsable-programme :user="$programme->user" />

    <x-separator />

    <x-social-sharing />

    <x-separator />

    <x-appel-fond-new :programme="$programme" />

@endsection
