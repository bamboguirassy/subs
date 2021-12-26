@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->parent->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->parent->image) }}">
@endsection

@section('description', $programme->parent->description)

@section('body')
    <div style="margin-top: 70px;" class="d-none d-sm-block"></div>
    <div class="card" style="padding-top: 70px; background-color: #BA265E">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card mb-3 bg-white">
                        <div class="row g-0">
                            <div class="col-lg-3">
                                <img src="{{ asset('uploads/programmes/images/' . $programme->parent->image) }}"
                                    class="img-fluid rounded-start" alt="...">
                                <div class="card bg-white d-flex py-2 justify-content-center mx-auto">
                                    <a href="{{ route('souscription.new', compact('programme')) }}?step=module"
                                        class="btn btn-primary">Participer &nbsp;
                                        <span class="mbri-arrow-next"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card-body">
                                    <h5 class="card-title text-primary display-7"><b>{{ $programme->nom }}</b> >
                                        {{ $programme->parent->nom }}
                                    </h5>
                                    <p class="card-text"><strong class="text-muted">par
                                            {{ $programme->user->name }}</strong>
                                    </p>
                                    <p>
                                        {!! $programme->description !!}
                                    </p>
                                    @if ($programme->suspendu)
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Cette session est suspendue...</strong>
                                        </div>
                                    @elseif(!$programme->active)
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Cette session est clôturée le
                                                {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong>
                                        </div>
                                    @endif
                                    @if ($programme->is_proprietaire)
                                        @if (count($tabUsers) < 1 && !$programme->suspendu)
                                            <form style="display: inline-block;" method="post"
                                                action="{{ route('programme.destroy', compact('programme')) }}">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger display-4 d-inline" href="#">
                                                    <span
                                                        class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                                                    Supprimer
                                                </button>
                                            </form>
                                        @endif
                                        @if (!$programme->suspendu)
                                            <a class="btn btn-warning display-4"
                                                href="{{ route('programme.edit', compact('programme')) }}"><span
                                                    class="mobi-mbri mobi-mbri-edit-2 mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                                        @endif
                                        @if (!$programme->active && $programme->gain_net > 0 && $programme->appelFond == null && $programme->typeProgramme->code != 'COTIR')
                                            <a class="btn btn-white display-4" href="#" data-toggle="modal"
                                                data-bs-toggle="modal" data-target="#mbr-popup-2y"
                                                data-bs-target="#mbr-popup-2y"><span
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- statistique globale --}}
                @if ($programme->is_proprietaire)
                    <div class="col-12 text-primary">
                        <div class="row bg-white">
                            <div class="card justify-content-center align-items-center md-pb col-12 col-md-6 col-lg-3">
                                <div class="card-wrapper">
                                    <div class="icon-wrapper">
                                        <span class="mbr-iconfont m-auto mobi-mbri-users mobi-mbri"></span>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mbr-fonts-style mb-1 display-5">
                                            <strong>{{ count($tabUsers) }}</strong>
                                        </h4>
                                        <h5 class="card-text mbr-fonts-style display-7"><strong>Participant(s)</strong>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card justify-content-center align-items-center md-pb col-12 col-md-6 col-lg-3">
                                <div class="card-wrapper">
                                    <div class="icon-wrapper">
                                        <span class="mbr-iconfont m-auto icon54-v1-send-money"></span>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mbr-fonts-style mb-1 display-5">
                                            <strong>{{ $montantSession }}
                                                FCFA</strong>
                                        </h4>
                                        <h5 class="card-text mbr-fonts-style display-7"><strong>Gain</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card justify-content-center align-items-center md-pb col-12 col-md-6 col-lg-3">
                                <div class="card-wrapper">
                                    <div class="icon-wrapper">
                                        <span class="mbr-iconfont m-auto icon54-v1-send-money"></span>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mbr-fonts-style mb-1 display-5">
                                            <strong>{{ $gainNet }}
                                                FCFA</strong>
                                        </h4>
                                        <h5 class="card-text mbr-fonts-style display-7"><strong>Gain Net
                                                (-{{ $programme->tauxPrelevement }}%)</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card justify-content-center align-items-center md-pb col-12 col-md-6 col-lg-3">
                                <div class="card-wrapper">
                                    <div class="icon-wrapper">
                                        <span class="mbr-iconfont m-auto icon54-v1-video-message"></span>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mbr-fonts-style mb-1 display-5">
                                            <strong>{{ Auth::user()->nombreSms }}</strong>
                                        </h4>
                                        <h5 class="card-text mbr-fonts-style display-7"><strong>SMS
                                                disponible(s)</strong></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-separator />
                @endif
                {{-- section liste des souscriptions --}}
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
                                                @foreach ($programme->parent->modules as $module)
                                                    <th class="nowrap">{{ $module->nom }}</th>
                                                @endforeach
                                                <th>
                                                    Montant
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tabUsers as $tabUser)
                                                <tr>
                                                    <td class="nowrap" scope="row">{{ $loop->index + 1 }}</td>
                                                    <td class="nowrap">{{ $tabUser['user']->name }}</td>
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
                                                    <td>
                                                        {{ $tabUser['montantUser'] }} FCFA
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <x-empty-message title="Vide" message="Il n'y a aucune souscription pour cette session" />
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-separator />
    <hr class="mt-5">
@endsection
