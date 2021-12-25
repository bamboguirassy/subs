@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->image) }}">
@endsection

@section('description', $programme->description)

@section('body')
    <div style="margin-top: 70px;" class="d-none d-sm-block"></div>
    <div ng-controller="SouscriptionController" class="card" style="padding-top: 70px; background-color: #BA265E">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <img src="{{ asset('uploads/programmes/images/' . $programme->parent->image) }}"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <h5 class="card-title display-7">
                                                <span class="display-5">
                                                    {{ $programme->nom }}</span>
                                                <span class="mbri-arrow-next"></span>
                                                <b>{{ $programme->parent->nom }}</b>
                                            </h5>
                                            <p class="card-text">Veuillez selectionner les modules auxquels vous
                                                souhaitez souscrire... Vous pouvez renevir plus tard pour souscrire à
                                                d'autres modules...</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <form action="{{ route('souscription.store', compact('programme')) }}"
                                            method="post">
                                            @csrf
                                            @method('post')
                                            <input name="programme_id" type="number" value="{{ $programme->id }}" hidden>
                                            <x-form-errors :errors="$errors->all()" />
                                            <ul class="list-group">
                                                @foreach ($programme->parent->modules as $module)
                                                    <li ng-init="ms[{{ $module->id }}]=false" class="list-group-item">
                                                        <input ng-model="ms[{{ $module->id }}]"
                                                            ng-change="selectModule({{ $module }})"
                                                            class="form-check-input me-1" type="checkbox" name="moduleIds[]"
                                                            value="{{ $module->id }}" ng-checked="{{$module->getMySouscription($programme)!=null}}" ng-disabled="{{$module->getMySouscription($programme)!=null}}">
                                                        Module {{ $loop->index + 1 }} > {{ $module->nom }} <br>
                                                        <span
                                                            class="badge bg-primary pull-right">@if ($module->montant == 0) gratuit @else {{ $module->montant }} FCFA @endif</span>
                                                    </li>
                                                @endforeach
                                                <li class="list-group-item" ng-cloak>
                                                    <div class="display-5 d-flex align-items-center justify-content-center">
                                                        @{{ montantModuleSelectionne }} FCFA
                                                    </div>
                                                </li>
                                                @guest
                                                    <li class="list-group-item">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <hr>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <h5 class="mbr-fonts-style display-5">Informations compte</h5>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                                                            <label for="name-formbuilder-17"
                                                                class="form-control-label mbr-fonts-style display-7">Nom
                                                                complet</label>
                                                            <input type="text" name="name" placeholder="Nom complet"
                                                                data-form-field="name" class="form-control display-7"
                                                                required="required" value="{{ old('name') }}"
                                                                id="name-formbuilder-17">
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group"
                                                            data-for="profession">
                                                            <label for="profession-formbuilder-17"
                                                                class="form-control-label mbr-fonts-style display-7">Profession</label>
                                                            <input type="text" name="profession" placeholder="Profession"
                                                                data-form-field="profession" class="form-control display-7"
                                                                required="required" value="{{ old('profession') }}"
                                                                id="profession-formbuilder-17">
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="country_cca2" class="form-label">Pays</label>
                                                                <select ng-change="selectCountry()" ng-model="country_cca2"
                                                                    class="form-control" name="country_cca2"
                                                                    id="country_cca2">
                                                                    <option value="{{ $senegal['cca2'] }}">
                                                                        {{ $senegal['admin'] }}</option>
                                                                    <option ng-repeat="country in countries"
                                                                        ng-value="country.cca2">
                                                                        @{{ country . admin }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group"
                                                            data-for="telephone">
                                                            <label for="telephone-formbuilder-17"
                                                                class="form-control-label mbr-fonts-style display-7">Téléphone</label>
                                                            <input type="tel" name="telephone" placeholder="Téléphone"
                                                                data-form-field="telephone" class="form-control display-7"
                                                                required="required" ng-value="selectedCountry.calling_codes[0]"
                                                                id="telephone-formbuilder-17">
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="email">
                                                            <label for="email-formbuilder-17"
                                                                class="form-control-label mbr-fonts-style display-7">Email</label>
                                                            <input type="email" name="email" placeholder="test@email.com"
                                                                data-form-field="email" class="form-control display-7"
                                                                required="required" value="{{ old('email') }}"
                                                                id="email-formbuilder-17">
                                                        </div>
                                                        <div data-for="photo" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                            <label for="photo-formbuilder-13"
                                                                class="form-control-label mbr-fonts-style display-7">
                                                                Chosir une photo de profil (optionnel)</label>
                                                            <input type="file" accept="image/*" name="photo" max="100" min="0"
                                                                step="1" data-form-field="photo" class="form-control display-7"
                                                                value="{{ old('photo') }}" id="photo-formbuilder-13">
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group"
                                                            data-for="password">
                                                            <label for="password-formbuilder-17"
                                                                class="form-control-label mbr-fonts-style display-7">Mot de
                                                                passe</label>
                                                            <input minlength="6" type="password" name="password"
                                                                placeholder="Mot de passe" data-form-field="password"
                                                                class="form-control display-7" required="required" value=""
                                                                id="password-formbuilder-17">
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group"
                                                            data-for="password_confirmation">
                                                            <label for="password_confirmation-formbuilder-17"
                                                                class="form-control-label mbr-fonts-style display-7">Confirmation
                                                                mot de passe</label>
                                                            <input minlength="6" type="password" name="password_confirmation"
                                                                placeholder="Confirmation mot de passe"
                                                                data-form-field="password_confirmation" required="required"
                                                                class="form-control display-7" value=""
                                                                id="password_confirmation-formbuilder-17">
                                                        </div>
                                                    </li>
                                                @endguest
                                            </ul>
                                            <div class="card-body">
                                                <div class="d-grid gap-2">
                                                    <button ng-disabled="selectedModules.length<1" type="submit"
                                                        class="btn btn-primary">Continuer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-separator />
    <hr class="mt-5">
@endsection
