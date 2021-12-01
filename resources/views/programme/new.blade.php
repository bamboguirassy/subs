@extends("base")

@section('title', 'Publier un nouveau programme')

@section('description',
    'Publier un nouveau programme et permettez aux interessés de souscrire pour prendre part au
    programme.',)

@section('body')
    <section data-bs-version="5.1" class="content2 cid-sOc3YTgSUN" id="content2-12">
        <div class="container">
            <div class="row content-row align-items-center">
                <div class="col-md-12 col-lg-12">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 mbr-bold display-5">
                        Publication - {{ $typeProgramme->nom }}<br>
                    </h1>
                    <p class="mbr-text mbr-black mbr-regular mbr-light mbr-fonts-style display-7">
                        Merci de remplir le formulaire ci-dessous pour lancer votre programme...
                        @guest
                            <br>
                            Si vous avez déja un compte, merci de vous <a style="font-weight: bolder; color: white;"
                                href="{{ route('login') }}?ret={{ Request::url() }}">connecter en cliquant ici</a> avant de
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
                                    class="form-control-label mbr-fonts-style display-7">Intitulé du programme</label>
                                <input type="text" name="nom" placeholder="Libellé du programme" data-form-field="nom"
                                    class="form-control display-7" required="required" value="{{ old('nom') }}"
                                    id="nom-formbuilder-13">
                            </div>
                            @if ($typeProgramme->code == 'PROG')
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="form-control-label">
                                        <label for="Autre-formbuilder-13" class="mbr-fonts-style display-7">Profils
                                            ciblés</label>
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
                            @if ($typeProgramme->code == 'TONTINE' || $typeProgramme->code == 'COTI')
                                <div class="mb-3">
                                    <label for="montant" class="form-label">Montant à payer</label>
                                    <input required="required" type="number" class="form-control" name="montant"
                                        id="montant" placeholder="Montant que chacun doit payer"
                                        value="{{ old('montant') }}">
                                </div>
                                @if ($typeProgramme->code == 'TONTINE')
                                    <div class="mb-3">
                                        <label for="frequence" class="form-label">Frequence de cotisation</label>
                                        <select required="required" class="form-control" name="frequence" id="frequence">
                                            <option>mensuelle</option>
                                            <option>hebdomadaire</option>
                                        </select>
                                    </div>
                                @endif
                            @endif
                            <div data-for="dateCloture" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="dateCloture-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">
                                    Date de clôture des inscriptions (souscriptions)
                                </label>
                                <input type="date" name="dateCloture" data-form-field="dateCloture" required="required"
                                    class="form-control display-7" value="{{ old('dateCloture') }}"
                                    id="dateCloture-formbuilder-13">
                            </div>
                            @if ($typeProgramme->code == 'PROG' || $typeProgramme->code == 'TONTINE')
                                <div data-for="dateDemarrage" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="dateDemarrage-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Date Démarrage</label>
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
                                        du programme</label>
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
                                        pour illimité)</label>
                                    <input type="number" name="nombreParticipants"
                                        placeholder="Nombre maximum de participants" max="" min="0" step="1"
                                        data-form-field="nombreParticipants" required="required"
                                        class="form-control display-7" value="{{ old('nombreParticipants') }}"
                                        id="nombreParticipants-formbuilder-13">
                                </div>
                            @endif
                            <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="description-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">Description du programme</label>
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
                                    Chosir une image de couverture @if ($typeProgramme->code != 'PROG') <span class="text-primary">(optionnelle)</span> @endif</label>
                                <input type="file" accept="image/*" name="image" max="100" min="0" step="1"
                                    data-form-field="image" @if ($typeProgramme->code == 'PROG') required="required" @endif class="form-control display-7" value=""
                                    id="image-formbuilder-13">
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
                                        complet</label>
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
                                    </label>
                                    <input type="tel" name="telephone" placeholder="Téléphone" data-form-field="telephone"
                                        required="required" class="form-control display-7"
                                        ng-value="selectedCountry.calling_codes[0]" id="telephone-formbuilder-13">
                                </div>
                                <div data-for="profession" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="profession-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Profession</label>
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
                                    <label for="email-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Email</label>
                                    <input type="email" name="email" placeholder="test@email.com" data-form-field="email"
                                        required="required" class="form-control display-7" value="{{ old('email') }}"
                                        id="email-formbuilder-13">
                                </div>
                                <div data-for="password" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="password-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Mot de passe</label>
                                    <input type="password" name="password" placeholder="Mot de passe" data-form-field="password"
                                        required="required" class="form-control display-7" value=""
                                        id="password-formbuilder-13">
                                </div>
                                <div data-for="password_confirmation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="password_confirmation-formbuilder-13"
                                        class="form-control-label mbr-fonts-style display-7">Confirmation mot de passe</label>
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
@endsection
