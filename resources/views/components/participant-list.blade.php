<section ng-controller="SouscriptionController">

    @if (count($souscriptions) < 1)
        <x-empty-message title="Vide" message="Il n'y a aucun participant pour le moment !" />
    @elseif(auth()->check() && $souscriptions[0]->programme->user->id==auth()->id())
        <section data-bs-version="5.1" class="content11 cid-sOc1O66rsI" id="content11-z">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="mbr-section-btn align-center">
                        <a class="btn btn-primary display-4" href="#" data-toggle="modal" data-bs-toggle="modal"
                            data-target="#mbr-popup-1w" data-bs-target="#mbr-popup-1w"><span
                                class="mdi-communication-email mbr-iconfont mbr-iconfont-btn"></span>Evoyer mail
                        </a>
                        <a class="btn btn-primary display-4" href="#" data-toggle="modal" data-bs-toggle="modal"
                            data-target="#mbr-sms-modal" data-bs-target="#mbr-sms-modal"><span
                                class="mdi-communication-email mbr-iconfont mbr-iconfont-btn"></span>Envoyer SMS
                        </a>
                        {{-- <a class="btn btn-info display-4" href="">
                            <span class="icon54-v3-export mbr-iconfont mbr-iconfont-btn"></span>
                            Exporter
                        </a>
                        <a class="btn btn-secondary display-4" href="">
                            <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                            Supprimer
                        </a> --}}
                    </div>
                </div>
            </div>
        </section>
        <x-separator />
        <section data-bs-version="5.1" class="table01 photom4_table01 section-table cid-sObY9vjAPL " id="table01-x">
            <div class="row align-center">
                <div class="col-12 col-md-12">
                    <h2 class="mbr-section-title mbr-fonts-style mbr-black display-2">
                        Liste des participants</h2>
                    <div class="table-wrapper pt-5" style="width: 95%;">
                        <div class="container-fluid">
                            <div class="row search">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="dataTables_filter">
                                        <label class="searchInfo mbr-fonts-style display-7">Chercher:</label>
                                        <input class="form-control input-sm" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="table table-striped isSearch table-responsive-stack" cellspacing="0"
                                data-empty="No matching records found">
                                <thead>
                                    <tr class="table-heads">
                                        <th class="head-item mbr-fonts-style display-4">#</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Nom complet</th>
                                        @if ($souscriptions[0]->programme->is_programme)
                                            <th class="head-item mbr-fonts-style display-4 nowrap">Profil</th>
                                        @endif
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Email</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Téléphone</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">DATE</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Profession</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Montant</th>
                                        @if ($souscriptions[0]->programme->active)
                                            <th class="head-item mbr-fonts-style display-4 nowrap"> Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($souscriptions as $souscription)
                                        <tr>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $souscription->user->name }}</td>
                                            @if ($souscription->programme->is_programme)
                                                <td class="body-item mbr-fonts-style display-7 nowrap">
                                                    {{ $souscription->profilConcerne->profil->nom }}</td>
                                            @endif
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                <a
                                                    href="mailto:{{ $souscription->user->email }}">{{ $souscription->user->email }}</a>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                <a
                                                    href="tel:{{ $souscription->user->telephone }}">{{ $souscription->user->telephone }}</a>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ date_format($souscription->created_at, 'd/m/Y H:i:s') }}</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $souscription->user->profession }}</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $souscription->montant > 0 ? $souscription->montant . ' FCFA' : 'gratuit' }}
                                            </td>
                                            @if ($souscriptions[0]->programme->active)
                                                <td class="body-item mbr-fonts-style display-7 nowrap">
                                                    <a ng-click="select({{ $souscription }})"
                                                        class="btn btn-warning nowrap" href="#" data-toggle="modal"
                                                        data-bs-toggle="modal" data-target="#mbr-popup-2w"
                                                        data-bs-target="#mbr-popup-2w"><span
                                                            class="mbri-cash"></span>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container-fluid table-info-container">
                            <div class="row info mbr-fonts-style display-7">
                                <div class="dataTables_info">
                                    <span class="infoBefore">Vous voyez</span>
                                    <span class="inactive infoRows">{{ count($souscriptions) }}</span>
                                    <span class="infoAfter">entrée(s)</span>
                                    <span class="infoFilteredBefore">(filtré sur
                                        {{ count($souscriptions) }} entrée(s</span><span
                                        class="infoFilteredAfter">)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- send mail modal --}}
        <div class="modal mbr-popup cid-sODVeVmwHy fade" tabindex="-1" role="dialog" data-overlay-color="#000000"
            data-overlay-opacity="0.8" id="mbr-popup-1w" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="container position-static margin-center-pos">
                        <div class="modal-header pb-0">
                            <h5 class="modal-title mbr-fonts-style display-5">Envoyer un email</h5>
                            <button type="button" class="close d-flex" data-dismiss="modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                    viewBox="0 0 23 23" fill="currentColor">
                                    <path
                                        d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="mbr-text mbr-fonts-style display-7">
                                Envoyer un mail à tous les participants.</p>
                            <div>
                                <div class="form-wrapper">
                                    <!--Formbuilder Form-->
                                    <form
                                        action="{{ route('send.email.to.participants', ['programme' => $souscriptions[0]->programme]) }}"
                                        method="POST" class="mbr-form form-with-styler">
                                        @csrf
                                        <x-form-errors :errors="$errors->all()" />
                                        <div class="dragArea">
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="objet">
                                                <label for="objet-mbr-popup-1w"
                                                    class="form-control-label mbr-fonts-style display-7">Objet</label>
                                                <input type="text" name="objet" placeholder="Objet du mail"
                                                    data-form-field="objet" class="form-control display-7"
                                                    required="required" value="" id="objet-mbr-popup-1w">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="message">
                                                <label for="message-mbr-popup-1w"
                                                    class="form-control-label mbr-fonts-style display-7">Message</label>
                                                <textarea id="wysiwyg" name="message"
                                                    placeholder="Rédiger le mail ici..." data-form-field="message"
                                                    class="form-control display-7" required="required"
                                                    id="message-mbr-popup-1w"></textarea>
                                            </div>
                                            <div class="col-md-auto input-group-btn">
                                                <button type="submit"
                                                    class="btn btn-secondary display-4">Envoyer</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--Formbuilder Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end send mail modal --}}
        {{-- send sms modal --}}
        <div class="modal mbr-popup cid-sODVeVmwHy cid-sms-modal fade" tabindex="-1" role="dialog"
            data-overlay-color="#000000" data-overlay-opacity="0.8" id="mbr-sms-modal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="container position-static margin-center-pos">
                        <div class="modal-header pb-0">
                            <h5 class="modal-title mbr-fonts-style display-5">Envoyer un SMS</h5>
                            <button type="button" class="close d-flex" data-dismiss="modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                    viewBox="0 0 23 23" fill="currentColor">
                                    <path
                                        d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="mbr-text mbr-fonts-style display-7">
                                Envoyer un SMS à tous les participants. <br>
                                Vous avez présentement {{ auth()->user()->nombreSms }} SMS disponible(s).
                                @if (auth()->user()->nombreSms < count($souscriptions))
                                    <br>
                                    <div class="mbr-text mbr-fonts-style display-7"
                                        style="background-color: rgb(211, 125, 125);">Vous ne pouvez malheureusement pas
                                        envoyer de SMS à tous les participants car le solde SMS est insuffisant. &nbsp;
                                        Le nombre de participant est {{ count($souscriptions) }}. &nbsp;
                                        Pour les contacter, merci d'acheter un pack SMS ici : <a
                                            href="{{ route('achatsms.create') }}" style="font-weight: bold;">Acheter
                                            des SMS</a>
                                    </div>
                                @endif
                            </p>
                            @if (auth()->user()->nombreSms > count($souscriptions))
                                <div>
                                    <div class="form-wrapper">
                                        <!--Formbuilder Form-->
                                        <form
                                            action="{{ route('send.sms.to.participants', ['programme' => $souscriptions[0]->programme]) }}"
                                            method="POST" class="mbr-form form-with-styler">
                                            @csrf
                                            <x-form-errors :errors="$errors->all()" />
                                            <div class="dragArea">
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group"
                                                    data-for="message">
                                                    <textarea maxlength="160" name="message"
                                                        placeholder="Rédiger le sms ici..." data-form-field="message"
                                                        class="form-control display-7" required="required"
                                                        id="message-mbr-popup-1w-sms"></textarea>
                                                </div>
                                                <div class="col-md-auto input-group-btn">
                                                    <button type="submit"
                                                        class="btn btn-secondary display-4">Envoyer</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--Formbuilder Form-->
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end send mail modal --}}



        {{-- Modfier montant  modal --}}
        <div class="modal mbr-popup cid-sODVeVmwHy fade" tabindex="-1" role="dialog" data-overlay-color="#000000"
            data-overlay-opacity="0.8" id="mbr-popup-2w" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="container position-static margin-center-pos">
                        <div class="modal-header pb-0">
                            <h5 class="modal-title mbr-fonts-style display-5">Modifier le Montant - Souscription
                                @{{ selected . uid }}</h5>
                            <button type="button" class="close d-flex" data-dismiss="modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                    viewBox="0 0 23 23" fill="currentColor">
                                    <path
                                        d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-wrapper">
                                    <!--Formbuilder Form-->
                                    <form id="souscriptionMontantEdit" method="POST" class="mbr-form form-with-styler">
                                        @csrf
                                        @method('put')
                                        <x-form-errors :errors="$errors->all()" />
                                        <div class="dragArea">
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="objet">
                                                <label for="montant-mbr-popup-2w"
                                                    class="form-control-label mbr-fonts-style display-7">Le
                                                    montant</label>
                                                <input type="text" name="montant" placeholder="Montant"
                                                    data-form-field="montant" class="form-control display-7"
                                                    required="required" ng-value="selected.montant"
                                                    id="montant-mbr-popup-1w">
                                            </div>

                                            <div class="col-md-auto input-group-btn">
                                                <button ng-click="submitMontantEditForm()" type="button"
                                                    class="btn btn-white display-4">Modifier</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--Formbuilder Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Modfier montant  modal --}}
    @endif

</section>
