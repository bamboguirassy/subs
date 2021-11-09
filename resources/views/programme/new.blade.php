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


    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{ route('programme.store') }}" method="POST" class="mbr-form form-with-styler"
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
                        <div data-for="type" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="type-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Type
                                programme</label>
                            <select name="type" data-form-field="type" class="form-control display-7"
                                id="type-formbuilder-13">
                                <option value="Conférence">Conférence</option>
                                <option value="Formation">Formation</option>
                                <option value="Séminaire">Séminaire</option>
                                <option value="Autre">Autre</option>
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
                            <div data-for="Tout" class="form-check form-check-inline">
                                <input type="checkbox" value="Yes" name="Tout" data-form-field="Tout"
                                    class="form-check-input display-7" id="Tout-formbuilder-13">
                                <label for="Tout-formbuilder-13" class="form-check-label display-7">Tout</label>
                            </div>
                            <div data-for="Professionnel" class="form-check form-check-inline">
                                <input type="checkbox" value="Yes" name="Professionnel" data-form-field="Professionnel"
                                    class="form-check-input display-7" id="Professionnel-formbuilder-13">
                                <label for="Professionnel-formbuilder-13"
                                    class="form-check-label display-7">Professionnel</label>
                            </div>
                            <div data-for="Etudiant" class="form-check form-check-inline">
                                <input type="checkbox" value="Yes" name="Etudiant" data-form-field="Etudiant"
                                    class="form-check-input display-7" id="Etudiant-formbuilder-13">
                                <label for="Etudiant-formbuilder-13" class="form-check-label display-7">Etudiant</label>
                            </div>
                            <div data-for="Autre" class="form-check form-check-inline">
                                <input type="checkbox" value="Yes" name="Autre" data-form-field="Autre"
                                    class="form-check-input display-7" id="Autre-formbuilder-13">
                                <label for="Autre-formbuilder-13" class="form-check-label display-7">Autre</label>
                            </div>
                        </div>
                        <div data-for="coutPourProfessionnel" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="coutPourProfessionnel-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Coût pour professionnel</label>
                            <input type="number" name="coutPourProfessionnel"
                                placeholder="Prix du ticket pour les professionnels" max="" min="0" step="1"
                                data-form-field="coutPourProfessionnel" required="required"
                                class="form-control display-7" value="" id="coutPourProfessionnel-formbuilder-13">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="coutPourEtudiant">
                            <label for="coutPourEtudiant-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Coût pour étudiant</label>
                            <input type="number" name="coutPourEtudiant" placeholder="Prix du ticket pour les étudiants"
                                max="" min="0" step="1" data-form-field="coutPourEtudiant" required="required"
                                class="form-control display-7" value="" id="coutPourEtudiant-formbuilder-13">
                        </div>
                        <div data-for="coutPourAutre" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="coutPourAutre-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Coût pour autre</label>
                            <input type="number" name="coutPourAutre" placeholder="Coût pour autre profil" max=""
                                min="0" step="1" data-form-field="coutPourAutre" required="required"
                                class="form-control display-7" value="" id="coutPourAutre-formbuilder-13">
                        </div>
                        <div data-for="dateCloture" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateCloture-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Date de cloture</label>
                            <input type="date" name="dateCloture" data-form-field="dateCloture" required="required"
                                class="form-control display-7" value="" id="dateCloture-formbuilder-13">
                        </div>
                        <div data-for="dateDemarrage" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateDemarrage-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Date Démarrage</label>
                            <input type="date" name="dateDemarrage" data-form-field="dateDemarrage" required="required"
                                class="form-control display-7" value="" id="dateDemarrage-formbuilder-13">
                        </div>
                        <div data-for="duree" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="duree-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Durée
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
                            <textarea name="description" placeholder="Description du programme"
                                data-form-field="description" required="required" class="form-control display-7"
                                id="description-formbuilder-13"></textarea>
                        </div>
                        <div data-for="modeDeroulement" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div class="form-control-label">
                                <label for="modeDeroulement-formbuilder-13" class="mbr-fonts-style display-7">Mode de
                                    déroulement</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="modeDeroulement" data-form-field="modeDeroulement"
                                    class="form-check-input display-7" value="En ligne" checked="checked"
                                    id="modeDeroulement-formbuilder-13">
                                <label class="form-check-label display-7">En ligne</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="modeDeroulement" data-form-field="modeDeroulement"
                                    class="form-check-input display-7" value="En présentiel"
                                    id="modeDeroulement-formbuilder-13">
                                <label class="form-check-label display-7">En présentiel</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h5 class="mbr-fonts-style display-5">Informations compte</h5>
                        </div>
                        <div data-for="text1" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="text1-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Nom
                                complet</label>
                            <input type="text" name="text1" placeholder="name" data-form-field="text1"
                                required="required" class="form-control display-7" value="" id="text1-formbuilder-13">
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
                            <textarea name="presentation"
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