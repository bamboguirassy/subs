@extends("base")

@section("title","")

@section("description","")

@section("body")
<section data-bs-version="5.1" class="content2 cid-sOc3YTgSUN" id="content2-12">
    <div class="container">
        <div class="row content-row align-items-center">
            <div class="col-md-12 col-lg-12">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 mbr-bold display-5">
                    Publier un prgramme<br></h1>
                <p class="mbr-text mbr-black mbr-regular mbr-light mbr-fonts-style display-7">
                    Merci de remplir le formulaire ci-dessous pour lancer votre programme...</p>
            </div>
        </div>
    </div>
</section>

<section class="form cid-sOc41298IC" id="formbuilder-13">

    <div class="container" ng-controller="ProgrammeNewController">
        <div class="row" ng-init="initVals({{$profils}})">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form enctype="multipart/form-data" action="{{ route('programme.store') }}" method="POST" class="mbr-form form-with-styler"
                    data-form-title="programeNewForm">
                    @method('post')
                    @csrf
                    <div class="form-row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">Oops...! some
                            problem!</div>
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Programme - Nouveau</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div data-for="type_programme_id" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="type_programme_id-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Type
                                programme</label>
                            <select required="required" name="type_programme_id" data-form-field="type_programme_id"
                                class="form-control display-7" id="type_programme_id-formbuilder-13">
                                <option value="" disabled selected>Sélectionner le type</option>
                                @foreach ($typeProgrammes as $typeProgramme)
                                <option value="{{ $typeProgramme->id }}">{{ $typeProgramme->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nom-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Intitulé du programme</label>
                            <input type="text" name="nom" placeholder="Libellé du programme" data-form-field="nom"
                                class="form-control display-7" required="required" value="" id="nom-formbuilder-13">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div class="form-control-label">
                                <label for="Autre-formbuilder-13" class="mbr-fonts-style display-7">Profils
                                    ciblés</label>
                            </div>
                            <div ng-repeat="profil in profils"
                                data-for="@{{profil.nom}}" class="form-check form-check-inline">
                                <input ng-change="selectProfil(profil)" ng-model="programme.profils[profil.id]" type="checkbox" value="@{{profil.id}}" name="profils[]"
                                    data-form-field="@{{profil.nom}}" class="form-check-input display-7"
                                    id="@{{profil.nom}}-formbuilder-13">
                                <label for="@{{profil.nom}}-formbuilder-13" class="form-check-label display-7"
                                    ng-bind="profil.nom">Professionnel</label>
                            </div>
                        </div>
                        <ng-container ng-repeat="profil in profils">
                            <div ng-if="profil.selected" data-for="coutPour@{{profil.id}}" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="coutPour@{{profil.id}}-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">Coût pour @{{profil.nom}}</label>
                                <input type="number" name="cout[@{{profil.id}}]"
                                    placeholder="Prix du ticket pour les @{{profil.nom}}s" min="0" step="1"
                                    data-form-field="coutPour@{{profil.nom}}" required="required"
                                    class="form-control display-7" value="" id="coutPour@{{profil.id}}-formbuilder-13">
                            </div>
                        </ng-container>
                        <div data-for="dateCloture" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateCloture-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Date de cloture des
                                inscriptions</label>
                            <input type="date" name="dateCloture" data-form-field="dateCloture" required="required"
                                class="form-control display-7" value="" id="dateCloture-formbuilder-13">
                        </div>
                        <div data-for="dateDemarrage" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateDemarrage-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Date Démarrage du programme</label>
                            <input type="date" name="dateDemarrage" data-form-field="dateDemarrage" required="required"
                                class="form-control display-7" value="" id="dateDemarrage-formbuilder-13">
                        </div>
                        <div data-for="duree" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="duree-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Durée
                                (en heures)
                                du programme</label>
                            <input type="number" name="duree" placeholder="Durée programme" max="" min="0" step="1"
                                data-form-field="duree" class="form-control display-7" value=""
                                id="duree-formbuilder-13">
                        </div>
                        <div data-for="nombreSeance" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nombreSeance-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Nombre de séances</label>
                            <input type="number" name="nombreSeance" placeholder="Nombre de séances" max="" min="0"
                                step="1" data-form-field="nombreSeance" class="form-control display-7" value=""
                                id="nombreSeance-formbuilder-13">
                        </div>
                        <div data-for="nombreParticipants" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nombreParticipants-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Nombre Max Participants (Mettre 0
                                pour illimité)</label>
                            <input type="number" name="nombreParticipants" placeholder="Nombre maximum de participants"
                                max="100" min="0" step="1" data-form-field="nombreParticipants" required="required"
                                class="form-control display-7" value="" id="nombreParticipants-formbuilder-13">
                        </div>
                        <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="description-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Description</label>
                            <textarea froala ng-model="programme.description" name="description" placeholder="Description du programme"
                                data-form-field="description" required="required" class="form-control display-7"
                                id="description-formbuilder-13"></textarea>
                        </div>
                        <div data-for="modeDeroulement" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div class="form-control-label">
                                <label for="modeDeroulement-formbuilder-13" class="mbr-fonts-style display-7">Mode de
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
                        <div data-for="image" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="image-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">
                            Chosir une image de couverture</label>
                            <input type="file" accept="image/*" name="image"
                                max="100" min="0" step="1" data-form-field="image" required="required"
                                class="form-control display-7" value="" id="image-formbuilder-13">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h5 class="mbr-fonts-style display-5">Informations compte</h5>
                        </div>
                        <div data-for="name" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="name-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Nom
                                complet</label>
                            <input type="text" name="name" placeholder="Nom complet" data-form-field="name" required="required"
                                class="form-control display-7" value="" id="name-formbuilder-13">
                        </div>
                        <div data-for="profession" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="profession-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Profession</label>
                            <input type="text" name="profession" placeholder="Profession" data-form-field="profession"
                                required="required" class="form-control display-7" value=""
                                id="profession-formbuilder-13">
                        </div>
                        <div data-for="presentation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="presentation-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Présenation</label>
                            <textarea ng-model="programme.presentation" froala name="presentation"
                                placeholder="Présentez-vous clairement pour que les participants puissent vous connaitre"
                                data-form-field="presentation" required="required" class="form-control display-7"
                                id="presentation-formbuilder-13"></textarea>
                        </div>
                        <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="email-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input type="email" name="email" placeholder="test@email.com" data-form-field="email"
                                required="required" class="form-control display-7" value="" id="email-formbuilder-13">
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

<section data-bs-version="5.1" class="social1 cid-sOflmUjTLx" id="share1-1o">
    <div class="container">
        <div class="media-container-row">
            <div class="col-12">
                <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5">
                    <strong>Partager sur !</strong>
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
@endsection