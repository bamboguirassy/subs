@extends("base")

@section('title', 'Souscrire au programme ' . $programme->nom)

@section('description', $programme->description)

@section('body')
    <section data-bs-version="5.1" class="header3 cid-sOcbVln16Y" id="header03-16">
        <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(16, 49, 120);"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 align-left">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-5">
                        {{ $programme->typeProgramme->nom }} - <strong>{{ $programme->nom }}</strong>
                    </h1>
                    <p>
                        @foreach ($programme->profilConcernes as $profilConcerne)
                            <h5 class="mbr-fonts-style m-0 display-8 text-white"></h5>
                            <h6 class="mbr-fonts-style display-8 text-white">
                                <strong>{{ $profilConcerne->profil->nom }}</strong>:
                                {{ $profilConcerne->montant > 0 ? $profilConcerne->montant . ' CFA' : 'Gratuit' }}</h6>
                        @endforeach
                    </p>
                    <p class="mbr-text mbr-fonts-style display-7">Vous pouvez souscrire au programme en remplissant le
                        formulaire ci-dessous. <br>
                    SI vous avez déja un compte, merci de vous connecter avant !</p>

                </div>
            </div>
        </div>
    </section>

    <section class="form cid-sOccI24ivi" id="formbuilder-17">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <form action="{{ route('souscription.store') }}" method="POST" class="mbr-form form-with-styler"
                        data-form-title="subscriptionNew">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="profil_concerne_id">
                                <div class="form-control-label">
                                    <label for="profil_concerne_id-formbuilder-17"
                                        class="mbr-fonts-style display-7">Profil</label>
                                </div>
                                @foreach ($programme->profilConcernes as $profilConcerne)
                                    <div class="form-check form-check-inline">
                                        <input @if ($loop->first) checked @endif type="radio" name="profil_concerne_id"
                                            data-form-field="profil_concerne_id" class="form-check-input display-7"
                                            value="{{ $profilConcerne->id }}" id="profil_concerne_id-formbuilder-17">
                                        <label class="form-check-label display-7">{{ $profilConcerne->profil->nom }}</label>
                                    </div>
                                @endforeach
                            </div>
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
                                        class="form-control display-7" required="required" value="" id="name-formbuilder-17">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="profession">
                                    <label for="profession-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Profession</label>
                                    <input type="text" name="profession" placeholder="Profession" data-form-field="profession"
                                        class="form-control display-7" required="required" value=""
                                        id="profession-formbuilder-17">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="email">
                                    <label for="email-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Email</label>
                                    <input type="email" name="email" placeholder="test@email.com" data-form-field="email"
                                        class="form-control display-7" required="required" value="" id="email-formbuilder-17">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="telephone">
                                    <label for="telephone-formbuilder-17"
                                        class="form-control-label mbr-fonts-style display-7">Téléphone</label>
                                    <input type="tel" name="telephone" placeholder="Téléphone" data-form-field="telephone"
                                        class="form-control display-7" required="required" value=""
                                        id="telephone-formbuilder-17">
                                </div>
                                <div data-for="photo" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="photo-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                        Chosir une photo de profil</label>
                                    <input type="file" accept="image/*" name="photo" max="100" min="0" step="1"
                                        data-form-field="photo" required="required" class="form-control display-7" value=""
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
                                        class="fa fa-plus-square-o mbr-iconfont mbr-iconfont-btn"></span>Continuer</button>
                            </div>
                        </div>
                    </form>
                    <!--Formbuilder Form-->
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="social1 cid-sOflEpVNiX" id="share1-1p">
        <div class="container">
            <div class="media-container-row">
                <div class="col-12">
                    <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5"><strong>Partager
                            sur&nbsp;</strong></h3>
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
