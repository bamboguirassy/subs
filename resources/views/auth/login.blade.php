@extends("base")

@section('title', 'Page de connexion')

@section('description', 'Identifiez vous pour accéder à la plateforme.')

@section('body')
    <section data-bs-version="5.1" class="header3 cid-sOcnUFYG0i" id="header3-1i">
        <div class="align-center container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong>Authentification</strong></h1>

                    <p class="mbr-text mbr-fonts-style display-7">Identifiez vous !</p>

                </div>
            </div>
        </div>
    </section>

    <section class="form cid-sOcnqXmnWl" id="formbuilder-1h">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <form action="{{ route('login.request') }}" method="POST" class="mbr-form form-with-styler">
                        @csrf
                        @method('post')
                        <x-form-errors :errors="$errors->all()" />
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5 text-primary">Se connecter</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="email-formbuilder-1h"
                                    class="form-control-label mbr-fonts-style display-7">Email</label>
                                <input type="email" name="email" placeholder="Email" data-form-field="email"
                                    class="form-control display-7 @error('email') is-invalid @enderror" required="required"
                                    value="" id="email-formbuilder-1h">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password">
                                <label for="password-formbuilder-1h"
                                    class="form-control-label mbr-fonts-style display-7">Mot de passe</label>
                                <input type="password" name="password" placeholder="Password" data-form-field="password"
                                    class="form-control display-7" required="required" value=""
                                    id="password-formbuilder-1h">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary display-7">Se connecter</button>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublié ?') }}
                                        </a>
                                    @endif
                                </div>
                                {{-- <div class="col-6">
                                    @if (Route::has('register'))
                                        <a class="btn btn-link"
                                            href="{{ route('register') }}">{{ __("S'inscrire") }}</a>
                                    @endif
                                </div> --}}
                            </div>
                        </div>
                </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
        </div>
    </section>
@endsection
