@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <div style="margin-top: 70px;" class="d-none d-sm-block"></div>
    <div class="card" style="padding-top: 70px; background-color: #BA265E">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card mb-3 bg-white">
                                <div class="row g-0">
                                    <div class="col-md-12">
                                        <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}"
                                            class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary display-7"><b>{{ $programme->nom }}</b>
                                            </h5>
                                            <p class="card-text"><strong class="text-muted">par
                                                    {{ $programme->user->name }}</strong>
                                            </p>
                                            <p>
                                                {!! $programme->description !!}
                                            </p>
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-center">
                                                    @if ($programme->is_proprietaire)
                                                        <a href="{{ route('programme.edit', compact('programme')) }}"
                                                            class="btn btn-warning w-100">Modifier &nbsp;
                                                            <span class="mbri-edit"></span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-white d-flex py-2 justify-content-center mx-auto">
                                <a href="{{ route('souscription.new', compact('programme')) }}?step=session"
                                    class="btn btn-primary">Participer &nbsp;
                                    <span class="mbri-arrow-next"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 bg-white pt-2 mx-auto">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-module-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-modules" type="button" role="tab" aria-controls="pills-modules"
                                aria-selected="true">Modules</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-session-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-sessions" type="button" role="tab" aria-controls="pills-sessions"
                                aria-selected="false">Sessions</button>
                        </li>
                    </ul>
                    <div class="tab-content pb-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-modules" role="tabpanel"
                            aria-labelledby="pills-module-tab">
                            {{-- start modules section --}}
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="card bg-white">
                                        <div class="row">
                                            <div class="col-12 col-lg-10 mx-auto">
                                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                                    @foreach ($programme->modules as $module)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="panelsStayOpen-heading{{ $module->id }}">
                                                                <button
                                                                    class="accordion-button text-primary @if (!$loop->first) collapsed @endif"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#panelsStayOpen-collapse{{ $module->id }}"
                                                                    aria-expanded="@if ($loop->first) true @else false @endif"
                                                                    aria-controls="panelsStayOpen-collapse{{ $module->id }}">
                                                                    Module {{ $loop->index + 1 }} > {{ $module->nom }}
                                                                </button>
                                                            </h2>
                                                            <div id="panelsStayOpen-collapse{{ $module->id }}"
                                                                class="accordion-collapse collapse @if ($loop->first) show @endif"
                                                                aria-labelledby="panelsStayOpen-heading{{ $module->id }}">
                                                                <div class="accordion-body">
                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <th>Prix</th>
                                                                            <td>{{ $module->montant ?? 'gratuit' }}
                                                                                @if ($module->montant)F @endif</td>
                                                                            <th>Durée</th>
                                                                            <td>{{ $module->duree ?? 'Non précisée' }}
                                                                                @if ($module->duree)h @endif</td>
                                                                        </tr>
                                                                    </table>
                                                                    {!! $module->description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- Button trigger modal -->
                                                @if ($programme->is_proprietaire)
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#newModuleModal">
                                                        Ajouter un module
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end modules section --}}
                        </div>
                        <div class="tab-pane fade" id="pills-sessions" role="tabpanel" aria-labelledby="pills-session-tab">
                            <ol class="list-group">
                                @foreach ($programme->sessions as $session)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <a href="{{ route('programme.show', ['programme' => $session]) }}"
                                            style="display: contents;">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold text-primary">{{ $session->nom }}</div>
                                                <strong>Clôture Insc. :
                                                    {{ date_format(new DateTime($session->dateDemarrage), 'd/m/Y') }}</strong>
                                                <br>
                                                Démarrage :
                                                {{ date_format(new DateTime($session->dateDemarrage), 'd/m/Y') }}
                                            </div>
                                            @if (!$session->active)
                                                <span class="badge bg-primary rounded-pill">passée</span>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                                @if ($programme->is_proprietaire)
                                    <li class="list-group-item d-flex justify-content-center align-items-center">
                                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newSessionModal"
                                            style="width: 100%">Créer une session</a>
                                    </li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-separator />
    <hr class="mt-5">

    <!-- Modal module add -->
    <div class="modal fade" id="newModuleModal" tabindex="-1" aria-labelledby="newModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="overflow: auto; height: auto;">
                <form action="{{ route('programme.store') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="newModuleModalLabel">Nouveau Module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- debut contenu formulaire --}}
                        <x-form-errors :errors="$errors->all()" />
                        <input type="text" name="categorie" id="categorie" value="module" hidden>
                        <input type="number" name="type_programme_id" id="type_programme_id"
                            value="{{ $programme->type_programme_id }}" hidden>
                        <input type="number" name="programme_id" id="programme_id" value="{{ $programme->id }}" hidden>
                        <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nom-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Nom du
                                module
                                <x-required />
                            </label>
                            <input type="text" name="nom" placeholder="Libellé du programme" data-form-field="nom"
                                class="form-control display-7" required="required" value="{{ old('nom') }}"
                                id="nom-formbuilder-13">
                        </div>
                        <div class="mb-3">
                            <label for="montant" class="form-label">Prix en FCFA
                                <x-required />
                            </label>
                            <input required="required" type="number" min="0" class="form-control" name="montant"
                                id="montant" placeholder="Montant que chacun doit payer" value="{{ old('montant') }}">
                        </div>
                        <div data-for="duree" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="duree-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Durée du
                                module (optionnelle)</label>
                            <input type="number" name="duree" placeholder="Durée programme" step="1" min="0"
                                data-form-field="duree" class="form-control display-7" value="{{ old('duree') }}"
                                id="duree-formbuilder-13">
                        </div>
                        <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="description-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Description du module
                                <x-required />
                            </label>
                            <textarea id="wysiwyg" name="description" data-form-field="description" required="required"
                                class="form-control display-7"
                                id="description-formbuilder-13">{{ old('description') }}</textarea>
                        </div>
                        <div data-for="image" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="image-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                Chosir une image de couverture <span class="text-primary">(optionnelle)</span> </label>
                            <input type="file" accept="image/*" name="image" max="100" min="0" step="1"
                                data-form-field="image" class="form-control display-7" value="" id="image-formbuilder-13">
                        </div>
                    </div>
                    {{-- fin  contenu formulaire --}}
                    <div class="modal-footer d-flex justify-content-between bg-primary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-white">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal session add -->
    <div class="modal fade" id="newSessionModal" tabindex="-1" aria-labelledby="newSessionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="overflow: auto; height: auto;">
                <form action="{{ route('programme.store') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="newSessionModalLabel">Nouvelle Session</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- debut contenu formulaire --}}
                        <x-form-errors :errors="$errors->all()" />
                        <input type="text" name="categorie" id="categorie" value="session" hidden>
                        <input type="number" name="type_programme_id" id="type_programme_id"
                            value="{{ $programme->type_programme_id }}" hidden>
                        <input type="number" name="programme_id" id="programme_id" value="{{ $programme->id }}" hidden>
                        <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nom-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Intitulé
                                <x-required />
                            </label>
                            <input type="text" name="nom" placeholder="Libellé session" data-form-field="nom"
                                class="form-control display-7" required="required" value="{{ old('nom') }}"
                                id="nom-formbuilder-13">
                        </div>
                        <div data-for="modeDeroulement" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div class="form-control-label">
                                <label for="modeDeroulement-formbuilder-13" class="mbr-fonts-style display-7">Mode
                                    de
                                    déroulement</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="modeDeroulement" data-form-field="modeDeroulementOnline"
                                    class="form-check-input display-7" value="En ligne" checked="checked"
                                    id="modeDeroulementOnline-formbuilder-13">
                                <label class="form-check-label display-7">En ligne</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="modeDeroulement" data-form-field="modeDeroulementPresentiel"
                                    class="form-check-input display-7" value="En présentiel"
                                    id="modeDeroulementPresentiel-formbuilder-13">
                                <label class="form-check-label display-7">En présentiel</label>
                            </div>
                        </div>
                        <div data-for="dateCloture" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateCloture-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                Date de clôture des inscriptions
                                <x-required />
                            </label>
                            <input type="date" name="dateCloture" data-form-field="dateCloture" required="required"
                                class="form-control display-7" value="{{ old('dateCloture') }}"
                                id="dateCloture-formbuilder-13">
                        </div>
                        <div data-for="dateDemarrage" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateDemarrage-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Date Démarrage session
                                <x-required />
                            </label>
                            <input type="date" name="dateDemarrage" data-form-field="dateDemarrage" required="required"
                                class="form-control display-7" value="{{ old('dateDemarrage') }}"
                                id="dateDemarrage-formbuilder-13">
                        </div>
                        <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="description-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Description
                            </label>
                            <textarea id="editor" name="description" data-form-field="description"
                                class="form-control display-7"
                                id="description-formbuilder-13">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    {{-- fin  contenu formulaire --}}
                    <div class="modal-footer d-flex justify-content-between bg-primary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-white">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
