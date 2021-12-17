@extends("base")

@section('title', 'Modification des utilisateurs - ' . config('app.name'))

@section('body')
    <section data-bs-version="5.1" class="info1 cid-sPNyRAAd7I" id="info1-2j">
        <div class="align-center container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h3 class="mbr-section-title mb-4 mbr-fonts-style display-1">
                        <strong>Modification utilisateur</strong>
                    </h3>

                </div>
            </div>
        </div>
    </section>

    <section class="form cid-sM09R9Ta0w" id="formbuilder-1u">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <hr>
                    <div
                        class="mt-2 form-control display-7">
                        <strong>{{ $user->email }}</strong> <b class="text-primary">(en lecture seule)</b></div>
                    <form enctype="multipart/form-data" action="{{ route('user.update', ['user' => $user]) }}"
                        method="POST" class="mbr-form form-with-styler" data-form-title="accountUpdateForm">
                        @csrf
                        @method('put')
                        <x-form-errors :errors="$errors->all()" />
                        <div class="dragArea form-row">
                            <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div data-for="name" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="name-formbuilder-1u" class="form-control-label mbr-fonts-style display-7">Nom
                                    complet
                                    <x-required />
                                </label>
                                <input type="text" name="name" data-form-field="name" class="form-control display-7"
                                    required="required" value="{{ old('profession') ?? $user->name }}"
                                    id="name-formbuilder-1u">
                            </div>
                            <div data-for="profession" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="name-formbuilder-1u"
                                    class="form-control-label mbr-fonts-style display-7">Profession <x-required /></label>
                                <input type="text" name="profession" data-form-field="name" class="form-control display-7"
                                    required="required" value="{{ old('profession') ?? $user->profession }}"
                                    id="profession-formbuilder-1u">
                            </div>
                            <div data-for="telephone" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="telephone-formbuilder-1u"
                                    class="form-control-label mbr-fonts-style display-7">Numéro Téléphone <x-required /></label>
                                <input type="tel" name="telephone" pattern="*" data-form-field="telephone"
                                    class="form-control display-7" required="required"
                                    value="{{ old('telephone') ?? $user->telephone }}"
                                    id="telephone-formbuilder-1u">
                            </div>
                            <div data-for="presentation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="presentation-formbuilder-13"
                                    class="form-control-label mbr-fonts-style display-7">Présenation</label>
                                <textarea id="wysiwyg" name="presentation"
                                    data-form-field="presentation" class="form-control display-7"
                                    id="presentation-formbuilder-13">{{ old('presentation') ?? $user->presentation }}</textarea>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary display-7">Mettre à jour</button> <br>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-default btn-md display-7">Retour à la liste</a>
                            </div>
                        </div>
                    </form>
                    <!--Formbuilder Form-->
                </div>
            </div>
        </div>
    </section>
    <hr>

@endsection
