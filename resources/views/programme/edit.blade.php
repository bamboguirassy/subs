@extends("base")

@section('title', 'Modifier un programme')

@section('body')
    <section data-bs-version="5.1" class="content2 cid-sOc3YTgSUN" id="content2-12">
        <div class="container">
            <div class="row content-row align-items-center">
                <div class="col-md-12 col-lg-12">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 mbr-bold display-5">
                        Modification - {{ $programme->typeProgramme->nom }}<br></h1>
                    <p class="mbr-text mbr-black mbr-regular mbr-light mbr-fonts-style display-7">
                        Mettez à jour les informations du programme...
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="form cid-sOc41298IC" id="formbuilder-13">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <form enctype="multipart/form-data" action="{{ route('programme.update', compact('programme')) }}"
                        method="POST" class="mbr-form form-with-styler" data-form-title="programeNewForm">
                        @method('put')
                        @csrf
                        <x-form-errors :errors="$errors->all()" />
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">{{ $programme->typeProgramme->nom }} - Mis à jour
                                </h4>
                                <p class="mbr-text mbr-black mbr-regular mbr-light mbr-fonts-style display-7">
                                    {{ $programme->typeProgramme->description }}</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div hidden="hidden" data-for="type_programme_id"
                                class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input name="type_programme_id" id="type_programme_id" type="number"
                                    value="{{ $programme->typeProgramme->id }}">
                            </div>
                            <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="nom-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">Intitulé du programme <x-required /></label>
                                <input type="text" name="nom" placeholder="Libellé du programme" data-form-field="nom"
                                    class="form-control display-7" required="required"
                                    value="{{ old('nom') ?? $programme->nom }}" id="nom-formbuilder-13">
                            </div>
                            @if ($programme->typeProgramme->code == 'PROG')
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="form-control-label">
                                        <label for="Autre-formbuilder-13" class="mbr-fonts-style display-7">Profils
                                            ciblés</label>
                                    </div>
                                </div>
                                @foreach ($programme->profilConcernes as $profilConcerne)
                                    <div data-for="coutPour{{ $profilConcerne->id }}"
                                        class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="coutPour{{ $profilConcerne->id }}-formbuilder-13"
                                            class="form-control-label mbr-fonts-style display-7">Coût pour
                                            {{ $profilConcerne->profil->nom }}</label>
                                        <input type="number" name="cout[{{ $profilConcerne->id }}]"
                                            placeholder="Prix du ticket pour les {{ $profilConcerne->profil->nom }}s"
                                            min="0" step="1" value="{{ $profilConcerne->montant }}"
                                            data-form-field="coutPour{{ $profilConcerne->profil->nom }}"
                                            required="required" class="form-control display-7"
                                            id="coutPour{{ $profilConcerne->id }}-formbuilder-13">
                                    </div>
                                @endforeach
                            @endif
                            @if ($programme->is_tontine || $programme->typeProgramme->code == 'COTI' || $programme->typeProgramme->code == 'COTIR')
                                <div class="mb-3">
                                    <label for="montant" class="form-label">Montant à payer <x-required /></label>
                                    <input required="required" type="number" class="form-control" name="montant"
                                        id="montant" placeholder="Montant que chacun doit payer"
                                        value="{{ old('montant') ?? $programme->montant }}">
                                </div>
                                @if ($programme->is_tontine || $programme->typeProgramme->code == 'COTIR')
                                    <div class="mb-3">
                                        <label for="frequence" class="form-label">Frequence de cotisation <x-required /></label>
                                        <select required="required" class="form-control" name="frequence" id="frequence">
                                            <option @if ($programme->frequence == 'mensuelle') selected @endif>mensuelle</option>
                                            <option @if ($programme->frequence == 'par 10 jours') selected @endif>par 10 jours</option>
                                            <option @if ($programme->frequence == 'hebdomadaire') selected @endif>hebdomadaire</option>
                                        </select>
                                    </div>
                                @endif
                                @if ($programme->is_tontine)
                                    @if (count($programme->children) < 1)
                                        <div class="mb-3">
                                            <label for="nombreMainMaxPersonne" class="form-label">Nombre de mains
                                                maximum par personne <x-required /></label>
                                            <select required="required" class="form-control" name="nombreMainMaxPersonne"
                                                id="nombreMainMaxPersonne">
                                                <option @if (old('nombreMainMaxPersonne') == 1 || $programme->nombreMainMaxPersonne == 1) selected @endif>1</option>
                                                <option @if (old('nombreMainMaxPersonne') == 2 || $programme->nombreMainMaxPersonne == 2) selected @endif>2</option>
                                                <option @if (old('nombreMainMaxPersonne') == 3 || $programme->nombreMainMaxPersonne == 3) selected @endif>3</option>
                                                <option @if (old('nombreMainMaxPersonne') == 4 || $programme->nombreMainMaxPersonne == 4) selected @endif>4</option>
                                                <option @if (old('nombreMainMaxPersonne') == 5 || $programme->nombreMainMaxPersonne == 5) selected @endif>5</option>
                                            </select>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            <div data-for="dateCloture" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="dateCloture-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">
                                    Date de clôture des inscriptions (souscriptions) <x-required />
                                </label>
                                <input type="date" name="dateCloture" data-form-field="dateCloture" required="required"
                                    class="form-control display-7"
                                    value="{{ old('dateCloture') ?? $programme->dateCloture }}"
                                    id="dateCloture-formbuilder-13">
                            </div>
                            @if ($programme->typeProgramme->code == 'PROG' || $programme->typeProgramme->code == 'TONTINE' || $programme->typeProgramme->code == 'COTIR')
                                <div data-for="dateDemarrage" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="dateDemarrage-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Date Démarrage <x-required /></label>
                                    <input type="date" name="dateDemarrage" data-form-field="dateDemarrage"
                                        required="required" class="form-control display-7"
                                        value="{{ old('dateDemarrage') ?? $programme->dateDemarrage }}"
                                        id="dateDemarrage-formbuilder-13">
                                </div>
                            @endif
                            @if ($programme->typeProgramme->code == 'PROG')
                                <div data-for="duree" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="duree-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Durée
                                        (en heures)
                                        du programme</label>
                                    <input type="number" name="duree" placeholder="Durée programme" max="" min="0" step="1"
                                        data-form-field="duree" class="form-control display-7"
                                        value="{{ old('duree') ?? $programme->duree }}" id="duree-formbuilder-13">
                                </div>
                                <div data-for="nombreSeance" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="nombreSeance-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Nombre de séances</label>
                                    <input type="number" name="nombreSeance" placeholder="Nombre de séances" max="" min="0"
                                        step="1" data-form-field="nombreSeance" class="form-control display-7"
                                        value="{{ old('nombreSeance') ?? $programme->nombreSeance }}"
                                        id="nombreSeance-formbuilder-13">
                                </div>
                            @endif
                            @if ($programme->typeProgramme->code == 'PROG' || $programme->typeProgramme->code == 'TONTINE')
                                <div data-for="nombreParticipants" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="nombreParticipants-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Nombre Max Participants (Mettre
                                        0
                                        pour illimité) <x-required /></label>
                                    <input type="number" name="nombreParticipants"
                                        placeholder="Nombre maximum de participants" max="" min="0" step="1"
                                        data-form-field="nombreParticipants" required="required"
                                        class="form-control display-7"
                                        value="{{ old('nombreParticipants') ?? $programme->nombreParticipants }}"
                                        id="nombreParticipants-formbuilder-13">
                                </div>
                            @endif
                            <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="description-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">Description du programme <x-required /></label>
                                <textarea id="wysiwyg" name="description" data-form-field="description" required="required"
                                    class="form-control display-7"
                                    id="description-formbuilder-13">{{ old('description') ?? $programme->description }}</textarea>
                            </div>
                            @if ($programme->typeProgramme->code == 'PROG')
                                <div data-for="modeDeroulement" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="form-control-label">
                                        <label for="modeDeroulement-formbuilder-13" class="mbr-fonts-style display-7">Mode
                                            de
                                            déroulement</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="modeDeroulement" data-form-field="modeDeroulementOnline"
                                            class="form-check-input display-7" value="En ligne" @if ($programme->modeDeroulement == 'En ligne') checked="checked" @endif
                                            id="modeDeroulementOnline-formbuilder-13">
                                        <label class="form-check-label display-7">En ligne</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="modeDeroulement" @if ($programme->modeDeroulement == 'En présentiel') checked="checked" @endif
                                            data-form-field="modeDeroulementPresentiel" class="form-check-input display-7"
                                            value="En présentiel" id="modeDeroulementPresentiel-formbuilder-13">
                                        <label class="form-check-label display-7">En présentiel</label>
                                    </div>
                                </div>
                            @endif
                            <div data-for="image" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="image-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                    Chosir une image de couverture @if ($programme->typeProgramme->code != 'PROG') <span class="text-primary">(optionnelle)</span> @endif</label>
                                <input type="file" accept="image/*" name="image" max="100" min="0" step="1"
                                    data-form-field="image" class="form-control display-7" value=""
                                    id="image-formbuilder-13">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-warning display-7">Modifier</button>
                            </div>
                        </div>
                    </form>
                    <!--Formbuilder Form-->
                </div>
            </div>
        </div>
    </section>
    <x-separator />
@endsection
