@extends("base")

@section('title', 'Souscrire au programme ' . $programme->nom)

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <section data-bs-version="5.1" class="header3 cid-sOcbVln16Y" id="header03-16">
        <div class="mbr-overlay" style="opacity: 0.7; background-color: #fe525b;"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 image-wrapper">
                    <img src="{{ asset('uploads/programmes/images/' . $programme->image) }}">
                </div>
                <div class="col-12 col-lg-8 align-left">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-5">
                        {{ $programme->typeProgramme->nom }} - <strong>{{ $programme->nom }}</strong>
                    </h1>
                    <p>
                        @foreach ($programme->profilConcernes as $profilConcerne)
                            <h5 class="mbr-fonts-style m-0 display-8 text-white"></h5>
                            <h6 class="mbr-fonts-style display-8 text-white">
                                <strong>{{ $profilConcerne->profil->nom }}</strong>:
                                {{ $profilConcerne->montant > 0 ? $profilConcerne->montant . ' CFA' : 'Gratuit' }}
                            </h6>
                        @endforeach
                    </p>
                    <p class="mbr-text mbr-fonts-style display-7">Vous pouvez souscrire au programme en remplissant le
                        formulaire ci-dessous. <br>
                        Si vous avez déja un compte, merci de vous
                        <a style="font-weight: bold; color: white;"
                            href="{{ route('login') }}?ret={{ Request::url() }}">connecter en cliquant ici</a>
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section class="form cid-sOccI24ivi" id="formbuilder-17" ng-controller="SouscriptionController">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <form action="{{ route('souscription.store') }}" method="POST" class="mbr-form form-with-styler"
                        data-form-title="subscriptionNew" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <x-form-errors :errors="$errors->all()" />
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">Formulaire de souscription</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <input name="programme_id" type="number" value="{{ $programme->id }}" hidden>
                            @if ($programme->is_programme)
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="profil_concerne_id">
                                    <div class="form-control-label">
                                        <label for="profil_concerne_id-formbuilder-17"
                                            class="mbr-fonts-style display-7">Profil</label>
                                    </div>
                                    @foreach ($programme->profilConcernes as $profilConcerne)
                                        <div class="form-check form-check-inline">
                                            <input @if ($loop->first || old('profil_concerne_id') == $profilConcerne->id) checked @endif type="radio" name="profil_concerne_id"
                                                data-form-field="profil_concerne_id" class="form-check-input display-7"
                                                value="{{ $profilConcerne->id }}" id="profil_concerne_id-formbuilder-17">
                                            <label
                                                class="form-check-label display-7">{{ $profilConcerne->profil->nom }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($programme->is_collecte_fond)
                            <div class="mb-3">
                              <label for="montant" class="form-label">Combien voulez vous offrir ?</label>
                              <input type="number"
                                class="form-control" name="montant" id="montant" aria-describedby="montantHelpId" placeholder="Préciser le montant de votre offre">
                              <small id="montantHelpId" class="form-text text-muted">Suivez votre coeur !!!</small>
                            </div>
                            @else
                                {!! $programme->description !!}
                            @endif

                            @guest
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h5 class="mbr-fonts-style display-5">Informations compte</h5>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                                    <label for="name-formbuilder-17" class="form-control-label mbr-fonts-style display-7">Nom
                                        complet</label>
                                    <input type="text" name="name" placeholder="Nom complet" data-form-field="name"
                                        class="form-control display-7" required="required" value="{{ old('name') }}"
                                        id="name-formbuilder-17">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="profession">
                                    <label for="profession-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Profession</label>
                                    <input type="text" name="profession" placeholder="Profession" data-form-field="profession"
                                        class="form-control display-7" required="required" value="{{ old('profession') }}"
                                        id="profession-formbuilder-17">
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
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="telephone">
                                    <label for="telephone-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Téléphone</label>
                                    <input type="tel" name="telephone" placeholder="Téléphone" data-form-field="telephone"
                                        class="form-control display-7" required="required"
                                        ng-value="selectedCountry.calling_codes[0]" id="telephone-formbuilder-17">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="email">
                                    <label for="email-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Email</label>
                                    <input type="email" name="email" placeholder="test@email.com" data-form-field="email"
                                        class="form-control display-7" required="required" value="{{ old('email') }}"
                                        id="email-formbuilder-17">
                                </div>
                                <div data-for="photo" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="photo-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                        Chosir une photo de profil (optionnel)</label>
                                    <input type="file" accept="image/*" name="photo" max="100" min="0" step="1"
                                        data-form-field="photo" class="form-control display-7" value="{{ old('photo') }}"
                                        id="photo-formbuilder-13">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password">
                                    <label for="password-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Mot de passe</label>
                                    <input minlength="6" type="password" name="password" placeholder="Mot de passe"
                                        data-form-field="password" class="form-control display-7" required="required" value=""
                                        id="password-formbuilder-17">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password_confirmation">
                                    <label for="password_confirmation-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Confirmation mot de passe</label>
                                    <input minlength="6" type="password" name="password_confirmation"
                                        placeholder="Confirmation mot de passe" data-form-field="password_confirmation"
                                        required="required" class="form-control display-7" value=""
                                        id="password_confirmation-formbuilder-17">
                                </div>
                            @endguest
                            <div class="col"><button type="submit" class="btn btn-primary display-7"><span
                                        class="fa fa-arrow-right mbr-iconfont mbr-iconfont-btn"></span>Continuer</button>
                            </div>
                        </div>
                    </form>
                    <!--Formbuilder Form-->
                </div>
            </div>
        </div>
    </section>

    <x-social-sharing />
@endsection
