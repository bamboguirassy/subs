@extends('base')

@section('title',"Profil - Mon compte")

@section('body')

<section data-bs-version="5.1" class="content2 cid-sOc3YTgSUN" id="content2-12">
    <div class="container">
        <div class="row content-row align-items-center">
            <div class="col-md-12 col-lg-12">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 mbr-bold display-5">
                    Modifier mon profil<br></h1>
                <p class="mbr-text mbr-black mbr-regular mbr-light mbr-fonts-style display-7">
                    Merci de remplir le formulaire ci-dessous pour Modifier votre Profile...
                </p>
            </div>
        </div>
    </div>
</section>
<section data-bs-version="5.1" class="header1 cid-sM09FrIsem" id="header01-1s">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-5 m-auto">
                <div class="image-wrapper md-pb">
                    <img class="w-100 lazyload"
                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt=""
                        loading="lazy"
                        data-src="assets/images/key-5284793-960-720-512x512.png">
                </div>
            </div>
            </div>
            <div class="col-12 col-md-12 col-lg m-auto">
                <div class="text-wrapper align-left">
                    <h1 class="mbr-section-title mbr-fonts-style mb-4 display-1"><strong>{{ auth()->user()->name
                            }}</strong></h1>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Bonjour <strong>{{Auth::user()->name}}</strong>, vous souhaitez mettre à jour certains de vos
                        informations ou gérer votre compte
                        ? Bienvenue !</p>

                </div>
            </div>
        </div>
    </div>
</section>

<x-separator />

<section class="form cid-sM09R9Ta0w" id="formbuilder-1u">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form enctype="multipart/form-data" action="{{route('user.update', ['user'=>auth()->user()])}}" method="POST"
                    class="mbr-form form-with-styler" data-form-title="accountUpdateForm"><input type="hidden"
                        name="email" data-form-email="true"
                        value="t5EG3ENQJDVdLKNBqw1CugNlJSzld9GeEsj+7m7uP4QASm9neZrxXbOy8/U+PkIcuICI7XgaewJgKggp3gbShnZeBQlF0Hw1bOy1SdOV35eX8ZGN6h8o91NHJFfqPI1h.uQDLLkz44XITIw310BAFKEz0fD3XxjzYpCZunvTVYTjcr+UX1YPcH4b3ta8wGBN45VHhwxiMgJmFLRu5dqfBzh0xElpfz/BvGjDPLlaA8XUmQ6+UAWa4k6U40f8yesi3">
                    @csrf
                    @method('put')
                    <x-form-errors :errors="$errors->all()" />
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Mettre à jour mes informations</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div data-for="name" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="name-formbuilder-1u" class="form-control-label mbr-fonts-style display-7">Nom
                                complet</label>
                            <input type="text" name="name" data-form-field="name" class="form-control display-7"
                                required="required" value="{{old('profession') ?? auth()->user()->name}}"
                                id="name-formbuilder-1u">
                        </div>
                        <div data-for="profession" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="name-formbuilder-1u" class="form-control-label mbr-fonts-style display-7">Profession</label>
                            <input type="text" name="profession" data-form-field="name" class="form-control display-7"
                                required="required" value="{{old('profession') ?? auth()->user()->profession}}"
                                id="profession-formbuilder-1u">
                        </div>
                        <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="email-formbuilder-1u"
                                class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input type="email" name="email" placeholder="Email" data-form-field="email"
                                class="form-control display-7" required="required"
                                value="{{old('email') ?? auth()->user()->email}}" id="email-formbuilder-1u">
                        </div>
                        <div data-for="telephone" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="telephone-formbuilder-1u"
                                class="form-control-label mbr-fonts-style display-7">Numéro Téléphone</label>
                            <input type="tel" name="telephone" pattern="*" data-form-field="telephone"
                                class="form-control display-7" required="required"
                                value="{{old('telephone') ?? auth()->user()->telephone}}"
                                id="telephone-formbuilder-1u">
                        </div>
                        <div data-for="presentation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="presentation-formbuilder-13"
                                class="form-control-label mbr-fonts-style display-7">Présenation</label>
                            <textarea id="wysiwyg" name="presentation"
                                placeholder="Présentez-vous clairement pour que les participants puissent vous connaitre"
                                data-form-field="presentation" class="form-control display-7"
                                id="presentation-formbuilder-13">{{old('presentation') ?? auth()->user()->presentation}}</textarea>
                        </div>
                        <div data-for="photo" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="photo-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                Chosir une photo de profil</label>
                            <input type="file" accept="image/*" name="photo" max="100" min="0" step="1"
                                data-form-field="photo"  class="form-control display-7" value=""
                                id="photo-formbuilder-13">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary display-7">Mettre à jour</button>
                        </div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section><br>

<x-separator />

<section class="form cid-sM0bOSkGZE" id="formbuilder-1w">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{ route('change.password.request') }}" method="POST" class="mbr-form form-with-styler"
                    data-form-title="Form Name">
                    @csrf
                    @method('put')
                    <input type="hidden" name="g-recaptcha-response"
                        data-form-captcha="true" value="6LcLaNIcAAAAALsGkwXbDA3AS4MvzPGyMbrj2h06"><input type="hidden"
                        name="email" data-form-email="true"
                        value="vsBHyohFbTTMEIIwcDwdr1Fv6WtWND4GOYopUjM5kGA7+kA1iGcEuQNBkxjG+ETmUYmUbOPi1ZakV2un8Srik4Mr7Ub1yGBTVNaBDALFY/NyFZd0ugIU/YeAJsaq4FPg.IM/5s4PO1ILhNbJoBpiDePNUfN2TQw3KeX9UnYfChXJwdCOBdsZYyTKXuxswQ/PVi0d7es7Ahb4ZD+NzyzFFvo+4cqE2amYUgZF//lMdJCY3JKggTYlq6R8ibyCUKCDE">
                        <x-form-errors :errors="$errors->all()" />
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Changement - mot de passe</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="currentPassword">
                            <label for="currentPassword-formbuilder-1w"
                                class="form-control-label mbr-fonts-style display-7">Mot de passe actuel</label>
                            <input type="password" name="currentPassword" placeholder="Mot de passe actuel"
                                data-form-field="currentPassword" class="form-control display-7" required="required"
                                value="" id="currentPassword-formbuilder-1w">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password" style="">
                            <label for="password-formbuilder-1w"
                                class="form-control-label mbr-fonts-style display-7">Nouveau mot de passe</label>
                            <input type="password" name="password" placeholder="Nouveau mot de passe"
                                data-form-field="password" class="form-control display-7" required="required" value=""
                                id="password-formbuilder-1w">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password_confirmation">
                            <label for="password_confirmation-formbuilder-1w"
                                class="form-control-label mbr-fonts-style display-7">Confirmation - Nouveau mot de
                                passe</label>
                            <input type="password" name="password_confirmation"
                                placeholder="Confirmation du mot de passe" data-form-field="password_confirmation"
                                class="form-control display-7" required="required" value=""
                                id="password_confirmation-formbuilder-1w">
                        </div>
                        <div class="col-auto" style="">
                            <button type="submit" class="btn btn-primary display-7">Changer le mot de passe</button>
                        </div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div><br>
</section>

@endsection
