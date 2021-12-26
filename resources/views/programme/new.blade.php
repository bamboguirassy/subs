@extends("base")

@section('title', 'Publier un nouveau programme '.$typeProgramme->nom)

@section('description',
    'Publier un nouveau programme et permettez aux interessés de souscrire pour prendre part au
    programme.',)

@section('body')
    <section data-bs-version="5.1" class="content2 cid-sOc3YTgSUN" style="padding-top: 70px;" id="content2-12">
        <div class="container">
            <div class="row content-row align-items-center pb-2">
                <div class="col-md-12 col-lg-12">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 mbr-bold display-5">
                        Publication - {{ $typeProgramme->nom }}<br>
                    </h1>
                    <p class="mbr-text mbr-white mbr-regular mbr-light mbr-fonts-style display-7">
                        Merci de remplir le formulaire ci-dessous pour lancer votre programme...
                        @guest
                            <br>
                            Si vous avez déja un compte, merci de vous <a style="font-weight: bolder; color: white;"
                                href="{{ route('login') }} }}">connecter en cliquant ici</a> avant de
                            publier le programme.
                        @endguest
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="form cid-sOc41298IC" id="formbuilder-13">
        <div class="container" ng-controller="ProgrammeNewController">
            <div class="row" ng-init="initVals({{ $profils }})">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <form enctype="multipart/form-data" action="{{ route('programme.store') }}" method="POST"
                        class="mbr-form form-with-styler" data-form-title="programeNewForm">
                        @method('post')
                        @csrf
                        <x-form-errors :errors="$errors->all()" />
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">Programme Nouveau</h4>
                                <p class="mbr-text mbr-black mbr-regular mbr-light mbr-fonts-style display-7">
                                    {{ $typeProgramme->description }}</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div hidden="hidden" data-for="type_programme_id"
                                class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input name="type_programme_id" id="type_programme_id" type="number"
                                    value="{{ $typeProgramme->id }}">
                            </div>
                            <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="nom-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">Intitulé du programme
                                    <x-required />
                                </label>
                                <input type="text" name="nom" placeholder="Libellé du programme" data-form-field="nom"
                                    class="form-control display-7" required="required" value="{{ old('nom') }}"
                                    id="nom-formbuilder-13">
                            </div>
                            @if ($typeProgramme->code == 'PROG')
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="form-control-label">
                                        <label for="Autre-formbuilder-13" class="mbr-fonts-style display-7">Profils
                                            ciblés
                                            <x-required />
                                        </label>
                                    </div>
                                    <div ng-repeat="profil in profils" data-for="@{{ profil . nom }}"
                                        class="form-check form-check-inline">
                                        <input ng-change="selectProfil(profil)" ng-model="programme.profils[profil.id]"
                                            type="checkbox" value="@{{ profil . id }}" name="profils[]"
                                            data-form-field="@{{ profil . nom }}" class="form-check-input display-7"
                                            id="@{{ profil . nom }}-formbuilder-13">
                                        <label for="@{{ profil . nom }}-formbuilder-13"
                                            class="form-check-label display-7" ng-bind="profil.nom">Professionnel</label>
                                    </div>
                                </div>
                                <ng-container ng-repeat="profil in profils">
                                    <div ng-if="profil.selected" data-for="coutPour@{{ profil . id }}"
                                        class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="coutPour@{{ profil . id }}-formbuilder-13"
                                            class="form-control-label mbr-fonts-style display-7">Coût pour
                                            @{{ profil . nom }}</label>
                                        <input type="number" name="cout[@{{ profil . id }}]"
                                            placeholder="Prix du ticket pour les @{{ profil . nom }}s" min="0" step="1"
                                            data-form-field="coutPour@{{ profil . nom }}" required="required"
                                            class="form-control display-7" value=""
                                            id="coutPour@{{ profil . id }}-formbuilder-13">
                                    </div>
                                </ng-container>
                            @endif
                            @if ($typeProgramme->code == 'CFON')
                                <div class="mb-3">
                                    <label for="montantObjectif" class="form-label">Montant objectif collecte
                                        <x-required />
                                    </label>
                                    <input required="required" type="number" min="1000" class="form-control"
                                        name="montantObjectif" id="montantObjectif"
                                        placeholder="Quel montant souhaitez vous collecter ?"
                                        value="{{ old('montantObjectif') }}">
                                </div>
                            @endif
                            @if ($typeProgramme->code == 'TONTINE' || $typeProgramme->code == 'COTI' || $typeProgramme->code == 'COTIR')
                                <div class="mb-3">
                                    <label for="montant" class="form-label">Montant à payer
                                        <x-required />
                                    </label>
                                    <input required="required" type="number" class="form-control" name="montant"
                                        id="montant" placeholder="Montant que chacun doit payer"
                                        value="{{ old('montant') }}">
                                </div>
                            @endif
                            @if ($typeProgramme->code == 'TONTINE' || $typeProgramme->code == 'COTIR')
                                <div class="mb-3">
                                    <label for="frequence" class="form-label">Frequence de cotisation
                                        <x-required />
                                    </label>
                                    <select required="required" class="form-control" name="frequence" id="frequence">
                                        <option @if (old('frequence') == 'mensuelle') selected @endif>mensuelle</option>
                                        <option @if (old('frequence') == 'par 10 jours') selected @endif>par 10 jours</option>
                                        <option @if (old('frequence') == 'hebdomadaire') selected @endif>hebdomadaire</option>
                                    </select>
                                </div>
                            @endif
                            @if ($typeProgramme->code == 'TONTINE')
                                <div class="mb-3">
                                    <label for="nombreMainMaxPersonne" class="form-label">Nombre de mains maximum
                                        par personne
                                        <x-required />
                                    </label>
                                    <select required="required" class="form-control" name="nombreMainMaxPersonne"
                                        id="nombreMainMaxPersonne">
                                        <option @if (old('nombreMainMaxPersonne') == 1) selected @endif>1</option>
                                        <option @if (old('nombreMainMaxPersonne') == 2) selected @endif>2</option>
                                        <option @if (old('nombreMainMaxPersonne') == 3) selected @endif>3</option>
                                        <option @if (old('nombreMainMaxPersonne') == 4) selected @endif>4</option>
                                        <option @if (old('nombreMainMaxPersonne') == 5) selected @endif>5</option>
                                    </select>
                                </div>
                            @endif
                            @if ($typeProgramme->code != 'FORMOD')
                                <div data-for="dateCloture" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="dateCloture-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">
                                        Date de clôture des inscriptions (souscriptions)
                                        <x-required />
                                    </label>
                                    <input type="date" name="dateCloture" data-form-field="dateCloture" required="required"
                                        class="form-control display-7" value="{{ old('dateCloture') }}"
                                        id="dateCloture-formbuilder-13">
                                </div>
                            @endif
                            @if ($typeProgramme->code == 'PROG' || $typeProgramme->code == 'TONTINE' || $typeProgramme->code == 'COTIR')
                                <div data-for="dateDemarrage" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="dateDemarrage-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Date Démarrage
                                        @if ($typeProgramme->code == 'COTIR') des cotisations @endif
                                        <x-required />
                                    </label>
                                    <input type="date" name="dateDemarrage" data-form-field="dateDemarrage"
                                        required="required" class="form-control display-7"
                                        value="{{ old('dateDemarrage') }}" id="dateDemarrage-formbuilder-13">
                                </div>
                            @endif
                            @if ($typeProgramme->code == 'PROG')
                                <div data-for="duree" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="duree-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Durée
                                        (en heures)
                                        du programme
                                        <x-required />
                                    </label>
                                    <input type="number" name="duree" placeholder="Durée programme" max="" min="0" step="1"
                                        data-form-field="duree" class="form-control display-7" value="{{ old('duree') }}"
                                        id="duree-formbuilder-13">
                                </div>
                                <div data-for="nombreSeance" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="nombreSeance-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Nombre de séances</label>
                                    <input type="number" name="nombreSeance" placeholder="Nombre de séances" max="" min="0"
                                        step="1" data-form-field="nombreSeance" class="form-control display-7"
                                        value="{{ old('nombreSeance') }}" id="nombreSeance-formbuilder-13">
                                </div>
                            @endif
                            @if ($typeProgramme->code == 'PROG' || $typeProgramme->code == 'TONTINE')
                                <div data-for="nombreParticipants" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="nombreParticipants-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Nombre Max Participants (Mettre
                                        0
                                        pour illimité)
                                        <x-required />
                                    </label>
                                    <input type="number" name="nombreParticipants"
                                        placeholder="Nombre maximum de participants" max="" min="0" step="1"
                                        data-form-field="nombreParticipants" required="required"
                                        class="form-control display-7" value="{{ old('nombreParticipants') }}"
                                        id="nombreParticipants-formbuilder-13">
                                </div>
                            @endif
                            @if ($typeProgramme->code == 'FORMOD')
                                <div class="col-12 mbr-fonts-style display-7 mb-2">
                                    <strong>Donnez juste une description globale du programme de formation, à la prochaine étape, vous pourrez ajouter les différents modules...</strong>
                                </div>
                            @endif
                            <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="description-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">Description du programme
                                    <x-required />
                                </label>
                                <textarea id="wysiwyg" name="description" data-form-field="description" required="required"
                                    class="form-control display-7"
                                    id="description-formbuilder-13">{{ old('description') }}</textarea>
                            </div>
                            @if ($typeProgramme->code == 'PROG')
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
                                        <input type="radio" name="modeDeroulement"
                                            data-form-field="modeDeroulementPresentiel" class="form-check-input display-7"
                                            value="En présentiel" id="modeDeroulementPresentiel-formbuilder-13">
                                        <label class="form-check-label display-7">En présentiel</label>
                                    </div>
                                </div>
                            @endif
                            <div data-for="image" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="image-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                    Chosir une image de couverture @if ($typeProgramme->code != 'PROG' && $typeProgramme->code!='FORMOD') <span class="text-primary">(optionnelle)</span> @else <x-required /> @endif</label>
                                <input type="file" accept="image/*" name="image" max="100" min="0" step="1"
                                    data-form-field="image" @if ($typeProgramme->code == 'PROG' || $typeProgramme->code=='FORMOD') required="required" @endif class="form-control display-7"
                                    value="" id="image-formbuilder-13">
                            </div>
                            @guest
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h5 class="mbr-fonts-style display-5">Informations compte</h5>
                                </div>
                                <div data-for="name" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="name-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Nom
                                        complet
                                        <x-required />
                                    </label>
                                    <input type="text" name="name" placeholder="Nom complet" data-form-field="name"
                                        required="required" class="form-control display-7" value="{{ old('name') }}"
                                        id="name-formbuilder-13">
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="country_cca2" class="form-label">Pays</label>
                                        <select ng-change="selectCountry()" ng-model="country_cca2" class="form-control"
                                            name="country_cca2" id="country_cca2">
                                            <option value="{{ $senegal['cca2'] }}">{{ $senegal['admin'] }}</option>
                                            <option ng-repeat="country in countries" ng-value="country.cca2">
                                                @{{ country . admin }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div data-for="telephone" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="telephone-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                        Téléphone
                                        <x-required />
                                    </label>
                                    <input type="tel" name="telephone" placeholder="Téléphone" data-form-field="telephone"
                                        required="required" class="form-control display-7"
                                        ng-value="selectedCountry.calling_codes[0]" id="telephone-formbuilder-13">
                                </div>
                                <div data-for="profession" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="profession-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Profession
                                        <x-required />
                                    </label>
                                    <input type="text" name="profession" placeholder="Profession" data-form-field="profession"
                                        required="required" class="form-control display-7" value="{{ old('profession') }}"
                                        id="profession-formbuilder-13">
                                </div>
                                <div data-for="presentation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="editor"
                                        class="form-control-label mbr-fonts-style display-7">Présentation</label>
                                    <textarea name="presentation" data-form-field="presentation" class="form-control display-7"
                                        id="editor">{{ old('presentation') }}</textarea>
                                </div>
                                <div data-for="photo" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="photo-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                        Chosir une photo de profil</label>
                                    <input type="file" accept="image/*" name="photo" max="100" min="0" step="1"
                                        data-form-field="photo" required="required" class="form-control display-7" value=""
                                        id="photo-formbuilder-13">
                                </div>
                                <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="email-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Email
                                        <x-required />
                                    </label>
                                    <input type="email" name="email" placeholder="test@email.com" data-form-field="email"
                                        required="required" class="form-control display-7" value="{{ old('email') }}"
                                        id="email-formbuilder-13">
                                </div>
                                <div data-for="password" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="password-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Mot de passe
                                        <x-required />
                                    </label>
                                    <input type="password" name="password" placeholder="Mot de passe" data-form-field="password"
                                        required="required" class="form-control display-7" value=""
                                        id="password-formbuilder-13">
                                </div>
                                <div data-for="password_confirmation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="password_confirmation-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Confirmation mot de passe
                                        <x-required />
                                    </label>
                                    <input type="password" name="password_confirmation" placeholder="Confirmation mot de passe"
                                        data-form-field="password_confirmation" required="required"
                                        class="form-control display-7" value="" id="password_confirmation-formbuilder-13">
                                </div>
                            @endguest
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary display-7">Publier</button>
                            </div>
                        </div>
                    </form>
                    <!--Formbuilder Form-->
                </div>
            </div>
        </div>
    </section>
    <x-separator />
    <x-social-sharing />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
@endsection
