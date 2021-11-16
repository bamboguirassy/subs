@extends("base")

@section("title","Modifier un  programme")

@section("body")
<section data-bs-version="5.1" class="content2 cid-sOc3YTgSUN" id="content2-12">
    <div class="container">
        <div class="row content-row align-items-center">
            <div class="col-md-12 col-lg-12">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 mbr-bold display-5">
                    Modifier un prgramme<br></h1>
                <p class="mbr-text mbr-black mbr-regular mbr-light mbr-fonts-style display-7">
                    Merci de remplir le formulaire ci-dessous pour relancer votre programme...
                </p>
            </div>
        </div>
    </div>
</section>

<section class="form cid-sOc41298IC" id="formbuilder-13">

    <div class="container" ng-controller="ProgrammeNewController">
        <div class="row" ng-init="initVals({{$profils}})">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form enctype="multipart/form-data" action="{{ route('programme.update',$programme->id) }}" method="POST"
                    class="mbr-form form-with-styler" data-form-title="programeNewForm">
                    @method('put')
                    @csrf
                    <x-form-errors :errors="$errors->all()" />
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Modifier Programme</h4>
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
                                <option value="{{ old('type_programme_id') ?? $typeProgramme->id }} " selected>{{ $typeProgramme->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nom-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Intitulé du programme</label>
                            <input type="text"  name="nom" placeholder="Libellé du programme" data-form-field="nom"
                                class="form-control display-7" required="required" value="{{ old('nom') ?? $programme->nom }}" id="nom-formbuilder-13">
                        </div>
                        <div data-for="dateCloture" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateCloture-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Date de cloture des
                                inscriptions</label>
                            <input type="date" name="dateCloture" data-form-field="dateCloture" required="required"
                                class="form-control display-7"  value="{{ old('dateCloture') ?? $programme->dateCloture }}" id="dateCloture-formbuilder-13">
                        </div>
                        <div data-for="dateDemarrage" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="dateDemarrage-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Date Démarrage du programme</label>
                            <input type="date" name="dateDemarrage" data-form-field="dateDemarrage" required="required"
                                class="form-control display-7" value="{{old('dateDemarrage')?date_format(new DateTime(old('dateDemarrage')),'d/m/Y') : date_format(new DateTime($programme->dateDemarrage),'d/m/Y')}}" id="dateDemarrage-formbuilder-13">
                        </div>
                        <div data-for="duree" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="duree-formbuilder-13" class="form-control-label mbr-fonts-style display-7">Durée
                                (en heures)
                                du programme</label>
                            <input type="number" name="duree" placeholder="Durée programme" max="" min="0" step="1"
                                data-form-field="duree" class="form-control display-7"  value="{{ old('duree') ?? $programme->duree }}"
                                id="duree-formbuilder-13">
                        </div>
                        <div data-for="nombreSeance" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nombreSeance-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Nombre de séances</label>
                            <input type="number" name="nombreSeance" placeholder="Nombre de séances" max="" min="0"
                                step="1" data-form-field="nombreSeance" class="form-control display-7" value="{{ old('nombreSeance') ?? $programme->nombreSeance }}"
                                id="nombreSeance-formbuilder-13">
                        </div>
                        <div data-for="nombreParticipants" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nombreParticipants-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Nombre Max Participants (Mettre 0
                                pour illimité)</label>
                            <input type="number" name="nombreParticipants" placeholder="Nombre maximum de participants"
                                max="100" min="0" step="1" data-form-field="nombreParticipants" required="required"
                                class="form-control display-7"  value="{{ old('nombreParticipants') ?? $programme->nombreParticipants }}" id="nombreParticipants-formbuilder-13">
                        </div>
                        <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="description-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Description</label>
                            <textarea  id="wysiwyg" name="description"
                                placeholder="Description du programme" data-form-field="description" required="required"
                                class="form-control display-7" id="description-formbuilder-13">{{ old('description') ?? $programme->description }}</textarea>
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
                            <label for="image-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                Chosir une image de couverture</label>
                            <input type="file" accept="image/*" name="image" max="100" min="0" step="1"
                                data-form-field="image"  class="form-control display-7" value=""
                                id="image-formbuilder-13">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <form action="">
                                <button type="submit" class="btn btn-primary display-7">Mettre à jour</button>

                            </form>
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
