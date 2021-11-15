@extends('base')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom complet') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div data-for="telephone" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="telephone-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                    Téléphone
                                </label>
                                <input type="tel" name="telephone" placeholder="Téléphone" data-form-field="telephone"
                                    required="required" class="form-control display-7" value=""
                                    id="telephone-formbuilder-13">
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
                                <textarea id="wysiwyg" name="presentation"
                                    placeholder="Présentez-vous clairement pour que les participants puissent vous connaitre"
                                    data-form-field="presentation" class="form-control display-7"
                                    id="presentation-formbuilder-13"></textarea>
                            </div>
                            <div data-for="photo" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="photo-formbuilder-13" class="form-control-label mbr-fonts-style display-7">
                                    Chosir une photo de profil</label>
                                <input type="file" accept="image/*" name="photo" max="100" min="0" step="1"
                                    data-form-field="photo" required="required" class="form-control display-7" value=""
                                    id="photo-formbuilder-13">
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Adresse E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirmation mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __("Créer le compte") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
