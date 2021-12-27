<div class="modal mbr-popup cid-sQ9ib2xyNF fade" tabindex="-1" role="dialog" data-overlay-color="#efefef"
    data-overlay-opacity="0.8" id="mbr-popup-2y" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container position-static margin-center-pos">
                <div class="modal-header pb-0">
                    <h5 class="modal-title mbr-fonts-style display-5">Appel de fonds</h5>
                    <button type="button" class="close d-flex" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                            fill="currentColor">
                            <path
                                d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <hr>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Vous vous apprêtez à faire un appel de fond.<br>Pour les formations, séminaires ou conférences,
                        nous allons mener une enquête au près des participants pour s'assurer que le programme a bien eu
                        lieu pour plus de garantie.<br>La plateforme prend 5% du montant collecté, nous prenons
                        supporterons les frais d'envoi.</p>
                    <hr>
                    <div>
                        <div class="form-wrapper">
                            <!--Formbuilder Form-->
                            <form action="{{ route('appelfond.store') }}" method="POST"
                                class="mbr-form form-with-styler" data-form-title="newAppelFondForm">
                                @csrf
                                <x-form-errors :errors="$errors->all()" />
                                <input type="number" value="{{ $programme->id }}" name="programme_id" hidden="hidden">
                                <input type="number" value="{{ $programme->gain_net }}" name="montant" hidden="hidden">
                                <div class="dragArea">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="methodePaiement">
                                        <label for="methodePaiement-mbr-popup-2y"
                                            class="form-control-label mbr-fonts-style display-7">Méthode de
                                            paiement</label>
                                        <select name="methodePaiement" data-form-field="methodePaiement"
                                            class="form-control display-7" id="methodePaiement-mbr-popup-2y">
                                            <option value="" selected disabled>Sélectionner une
                                                méthode de paiement</option>
                                            <option value="Orange Money">Orange Money</option>
                                            <option value="Waves">Waves</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="mobilePaiement">
                                        <label for="mobilePaiement-mbr-popup-2y"
                                            class="form-control-label mbr-fonts-style display-7">Numéro de téléphone de
                                            paiement</label>
                                        <input type="tel" name="mobilePaiement" placeholder="Numéro de téléphone" max=""
                                            min="" step="" data-form-field="mobilePaiement" required="required"
                                            class="form-control display-7" value="+221"
                                            id="mobilePaiement-mbr-popup-2y">
                                    </div>
                                    <div class="col-auto input-group-btn d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning display-4">Faire la
                                            demande</button>
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
