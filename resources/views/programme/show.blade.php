@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <div style="margin-top: 120px;" class="d-none d-sm-block"></div>
    <section data-bs-version="5.1" class="header14 cid-sObVJU3AUD pt-2" style="margin-top: 20px;" id="header14-u">
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
                        @if ($programme->isChild)
                            <h1 class="mbr-section-title mbr-fonts-style mb-3 display-3">
                                <strong>{{ $programme->parent->nom }}</strong>
                            </h1>
                        @endif
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                            @if ($programme->isChild) - &nbsp; @endif<strong>{{ $programme->nom }}</strong>
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
                            @if ($programme->suspendu)
                                <div class="alert alert-danger" role="alert">
                                    <strong>Ce programme est suspendu...</strong>
                                </div>
                            @elseif(!$programme->active)
                                <div class="alert alert-danger" role="alert">
                                    <strong>Ce programme est cloturé le
                                        {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong>
                                </div>
                            @elseif (!$programme->current_user_souscription)
                                <a class="btn btn-white display-4"
                                    href="{{ route('souscription.new', compact('programme')) }}">
                                    <span class="mbrib-edit mbr-iconfont mbr-iconfont-btn"></span>Participer
                                </a>
                            @endif
                            @auth
                                @if ($programme->is_proprietaire)
                                    @if (count($programme->souscriptions) < 1 && !$programme->suspendu)
                                        <form style="display: inline-block;" method="post"
                                            action="{{ route('programme.destroy', compact('programme')) }}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger display-4 d-inline" href="#">
                                                <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                                                Supprimer
                                            </button>
                                        </form>
                                    @endif
                                    <a class="btn btn-white display-4" href="#table01-x">
                                        <span class="mbrib-users mbr-iconfont mbr-iconfont-btn"></span>Participants</a>
                                    @if (!$programme->suspendu && !$programme->appelFond)
                                        <a class="btn btn-warning display-4"
                                            href="{{ route('programme.edit', compact('programme')) }}"><span
                                                class="mobi-mbri mobi-mbri-edit-2 mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                                    @endif
                                    @if (!$programme->active && $programme->gain_net > 0 && $programme->appelFond == null && $programme->typeProgramme->code != 'COTIR')
                                        <a class="btn btn-white display-4" href="#" data-toggle="modal" data-bs-toggle="modal"
                                            data-target="#mbr-popup-2y" data-bs-target="#mbr-popup-2y"><span
                                                class="icon54-v1-send-money mbr-iconfont mbr-iconfont-btn"></span>
                                            Faire un appel de fond
                                        </a>
                                    @endif
                                    @if ($programme->is_cotisation_recurrente && !$programme->suspendu)
                                        <a class="btn btn-warning display-4" data-toggle="modal" data-bs-toggle="modal"
                                            data-target="#mbr-popup-suspendre" data-bs-target="#mbr-popup-suspendre">
                                            <span class="mbri-lock mbr-iconfont mbr-iconfont-btn"></span>
                                            Suspendre le programme
                                        </a>
                                    @endif
                                    {{-- @else
                                    @if ($programme->current_user_souscription && $programme->active)
                                        <a class="btn btn-danger display-4" href="">
                                            <span class="mobi-mbri mobi-mbri-close mbr-iconfont mbr-iconfont-btn"></span>Annuler
                                            ma
                                            souscription</a>
                                    @endif --}}
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- statistique globale --}}
    @if ($programme->is_proprietaire || (($programme->is_tontine || $programme->is_cotisation) && $programme->current_user_souscription))
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
    @if (($programme->is_tontine || $programme->is_cotisation_recurrente) && ($programme->current_user_souscription || $programme->is_proprietaire))
        <section data-bs-version="5.1" class="extProgressBars cid-sQ5CwoL2FK" id="extProgressBars5-2x">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="suivi-tranche-tab" data-bs-toggle="tab"
                                    data-bs-target="#suivi-tranche" type="button" role="tab" aria-controls="suivi-tranche"
                                    aria-selected="true">Suivi Tranche</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tableau-paiement-tontine-tab" data-bs-toggle="tab"
                                    data-bs-target="#tableau-paiement-tontine" type="button" role="tab"
                                    aria-controls="tableau-paiement-tontine" aria-selected="false">Tableau des
                                    paiements</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="appel-fond-tontine-tab" data-bs-toggle="tab"
                                    data-bs-target="#appel-fond-tontine" type="button" role="tab"
                                    aria-controls="appel-fond-tontine" aria-selected="false">Les appels de fond</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="suivi-tranche" role="tabpanel"
                                aria-labelledby="suivi-tranche-tab">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-md-12">
                                        <h2 class="mbr-section-title pb-2 mbr-bold mbr-fonts-style align-left display-5">
                                            Evolution des
                                            paiements</h2>
                                        <div class="line-wrap">
                                            <div class="line"></div>
                                        </div>
                                        <h3
                                            class="mbr-section-sub-title pb-4 mbr-normal mbr-fonts-style align-left display-7">
                                            Suivez
                                            l'évolution des paiements pour chaque tranche ou période de paiement</h3>
                                        <div class="progress_elements">
                                            @foreach ($programme->children as $child)
                                                <div class="progress1 pb-5">
                                                    <div class="title-wrap">
                                                        <div class="progressbar-title mbr-fonts-style display-5">
                                                            <p>
                                                                <a
                                                                    href="{{ route('programme.show', ['programme' => $child]) }}">{{ $child->nom }}</a>
                                                            </p>
                                                        </div>
                                                        <div class="progress_value mbr-fonts-style display-7">
                                                            <span
                                                                class="nowrap">{{ $child->progression }}%</span>
                                                        </div>
                                                    </div>
                                                    <progress class="progress progress-primary mbr-bold" max="100"
                                                        value="{{ $child->progression }}">
                                                    </progress>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tableau-paiement-tontine" role="tabpanel"
                                aria-labelledby="tableau-paiement-tontine-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card bg-white">
                                            <div class="card-body">
                                                <h4 class="card-title text-primary">Liste des souscriptions</h4>
                                                @if (count($tabUsers) > 0)
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead class="bg-primary text-white">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nom</th>
                                                                    <th>Téléphone</th>
                                                                    <th>Email</th>
                                                                    @foreach ($programme->children as $child)
                                                                        <th class="nowrap">
                                                                            {{ Str::limit($child->nom, 12, '...') }} <br>
                                                                            <span
                                                                                class="badge bg-secondary">{{ $child->montant }}
                                                                                FCFA</span>
                                                                        </th>
                                                                    @endforeach
                                                                    <th>
                                                                        Montant
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($tabUsers as $tabUser)
                                                                    <tr>
                                                                        <td class="nowrap" scope="row">
                                                                            {{ $loop->index + 1 }}
                                                                        </td>
                                                                        <td class="nowrap">
                                                                            {{ $tabUser['user']->name }}
                                                                        </td>
                                                                        <td class="nowrap">
                                                                            <a
                                                                                href="tel:+{{ $tabUser['user']->telephone }}">{{ $tabUser['user']->telephone }}</a>
                                                                        </td>
                                                                        <td class="nowrap">
                                                                            <a
                                                                                href="mailto:{{ $tabUser['user']->email }}">{{ $tabUser['user']->email }}</a>
                                                                        </td>
                                                                        @foreach ($tabUser['states'] as $state)
                                                                            <td class="nowrap">
                                                                                @if ($state)
                                                                                    <span class="mbri-success"></span>
                                                                                @else
                                                                                    <span class="mbri-close"></span>
                                                                                @endif
                                                                            </td>
                                                                        @endforeach
                                                                        <td class="nowrap">
                                                                            {{ $tabUser['montantUser'] }} FCFA
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <x-empty-message title="Vide"
                                                        message="Il n'y a aucune souscription pour cette session" />
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="appel-fond-tontine" role="tabpanel"
                                aria-labelledby="appel-fond-tontine-tab">
                                <section data-bs-version="5.1"
                                    class="table01 photom4_table01 section-table cid-sObY9vjAPL " id="table01-x">
                                    <div class="row align-center">
                                        <div class="col-12 col-md-12">
                                            <h2 class="mbr-section-title mbr-fonts-style mbr-black display-2">
                                                Liste des appels de fonds</h2>
                                            <div class="table-wrapper pt-5" style="width: 95%;">
                                                <div class="container-fluid">
                                                    <div class="row search">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-6">
                                                            <div class="dataTables_filter">
                                                                <label
                                                                    class="searchInfo mbr-fonts-style display-7">Chercher:</label>
                                                                <input class="form-control input-sm" disabled="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped isSearch table-responsive-stack"
                                                        cellspacing="0" data-empty="Aucun enregistrement trouvé">
                                                        <thead>
                                                            <tr class="table-heads">
                                                                <th class="head-item mbr-fonts-style display-4">#</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">
                                                                    Programme</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">User
                                                                </th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">
                                                                    Méthode de paiement</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">
                                                                    Mobile Paiement</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">
                                                                    Montant</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">
                                                                    Frais d'envoi</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">Date
                                                                    demande</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">
                                                                    Traité</th>
                                                                <th class="head-item mbr-fonts-style display-4 nowrap">
                                                                    Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($programme->appelFonds as $appelFond)
                                                                <tr>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        {{ $loop->index + 1 }}
                                                                    </td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        <a
                                                                            href="{{ route('programme.show', ['programme' => $appelFond->programme]) }}">{{ $appelFond->programme->nom }}</a>
                                                                    </td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        {{ $appelFond->user->name ?? 'Non précisé' }}
                                                                    </td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        {{ $appelFond->methodePaiement }}</td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        <a
                                                                            href="tel:{{ $appelFond->mobilePaiement }}">{{ $appelFond->mobilePaiement }}</a>
                                                                    </td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        {{ $appelFond->montant }} FCFA</td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        {{ $appelFond->frais }} FCFA</td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        {{ date_format($appelFond->created_at, 'd/m/Y H:i:s') }}
                                                                    </td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        <strong>{{ $appelFond->etat }}</strong>
                                                                    </td>
                                                                    <td class="body-item mbr-fonts-style display-7 nowrap">
                                                                        <a ng-click="select({{ $appelFond }})"
                                                                            class="btn btn-secondary nowrap" href="#"
                                                                            data-toggle="modal" data-bs-toggle="modal"
                                                                            data-target="#mbr-popup-2w"
                                                                            data-bs-target="#mbr-popup-2w"><span
                                                                                class="mbri-setting"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="container-fluid table-info-container">
                                                    <div class="row info mbr-fonts-style display-7">
                                                        <div class="dataTables_info">
                                                            <span class="infoBefore">Vous voyez</span>
                                                            <span
                                                                class="inactive infoRows">{{ count($programme->appelFonds) }}</span>
                                                            <span class="infoAfter">entrée(s)</span>
                                                            <span class="infoFilteredBefore">(filtré sur
                                                                {{ count($programme->appelFonds) }} entrée(s</span><span
                                                                class="infoFilteredAfter">)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
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
                        <li class="nav-item first mbr-fonts-style"><a
                                class="nav-link mbr-fonts-style show active display-7" role="tab" data-toggle="tab"
                                data-bs-toggle="tab" href="#list1-1r_tab0" aria-selected="true">Description</a></li>
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
                                {{-- @isset($programme->image)
                                    <div class="col-md-3 logo-container d-flex justify-content-center align-items-center">
                                        <div class="d-flex flex-wrap">
                                            <div class="mb-md-0 mb-3">
                                                <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                                            </div>
                                        </div>
                                    </div>
                                @endisset --}}
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
    @if ($programme->is_proprietaire || !$programme->is_collecte_fond)
        <x-responsable-programme :user="$programme->user" />
    @endif
    <x-separator />

    <x-social-sharing />

    <x-separator />

    <x-appel-fond-new :programme="$programme" />

    {{-- suspendre programme de cotisation récurrente --}}
    <div class="modal mbr-popup cid-sQ9ib2xyNF fade" tabindex="-1" role="dialog" data-overlay-color="#efefef"
        data-overlay-opacity="0.8" id="mbr-popup-suspendre" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container position-static margin-center-pos">
                    <div class="modal-header pb-0">
                        <h5 class="modal-title mbr-fonts-style display-5">Suspendre programme</h5>
                        <button type="button" class="close d-flex" data-dismiss="modal" data-bs-dismiss="modal"
                            aria-label="Close">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="currentColor">
                                <path
                                    d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <hr>
                        <p class="mbr-text mbr-fonts-style display-7">
                            Si vous suspendez le programme, nos robots ne vont plus continuer à gérer les cotisations, cela
                            signifie que vous mettez en pause les paiements de même que le programme. <br>
                            Êtes-vous sûr de vouloir suspendre le programme ?
                        </p>
                        <hr style="background-color: white; height: 10px;">
                        <form action="{{ route('programme.suspendre', compact('programme')) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="col-auto input-group-btn">
                                <button type="submit" class="btn btn-danger display-4 d-inline"
                                    style="display: inline-block">Oui, suspendre</button>
                                <button type="button" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"
                                    class="btn btn-white display-4 d-inline" style="display: inline-block">Non</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
