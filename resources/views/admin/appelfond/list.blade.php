@extends("base")

@section('title', 'Liste des appels de fonds - ' . config('app.name'))

@section('body')
    <section ng-controller="AppelFondController">

        <section data-bs-version="5.1" class="info1 cid-sPNyRAAd7I" id="info1-2j">
            <div class="align-center container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <h3 class="mbr-section-title mb-4 mbr-fonts-style display-1">
                            <strong>Appels de fonds</strong>
                        </h3>

                    </div>
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="table01 photom4_table01 section-table cid-sObY9vjAPL " id="table01-x">
            <div class="row align-center">
                <div class="col-12 col-md-12">
                    <h2 class="mbr-section-title mbr-fonts-style mbr-black display-2">
                        Liste des appels de fonds</h2>
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
                                data-empty="Aucun enregistrement trouvé">
                                <thead>
                                    <tr class="table-heads">
                                        <th class="head-item mbr-fonts-style display-4">#</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Programme</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">User</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Méthode de paiement</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Mobile Paiement</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Montant</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Frais d'envoi</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Date demande</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Traité</th>
                                        <th class="head-item mbr-fonts-style display-4 nowrap">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($appelFonds as $appelFond)
                                        <tr>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                <a
                                                    href="{{ route('programme.show', ['programme' => $appelFond->programme]) }}">{{ $appelFond->programme->nom }}</a>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $appelFond->user->name ?? 'Non précisé' }}</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $appelFond->methodePaiement }}</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                <a
                                                    href="tel:{{ $appelFond->mobilePaiement }}">{{ $appelFond->mobilePaiement }}</a>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $appelFond->montant }} FCFA</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ $appelFond->frais }} FCFA</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ date_format($appelFond->created_at, 'd/m/Y H:i:s') }}</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                <strong>{{ $appelFond->etat }}</strong>
                                            </td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                <a ng-click="select({{ $appelFond }})" class="btn btn-secondary nowrap"
                                                    href="#" data-toggle="modal" data-bs-toggle="modal"
                                                    data-target="#mbr-popup-2w" data-bs-target="#mbr-popup-2w"><span
                                                        class="mbri-setting"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container-fluid table-info-container">
                            <div class="row info mbr-fonts-style display-7">
                                <div class="dataTables_info">
                                    <span class="infoBefore">Vous voyez</span>
                                    <span class="inactive infoRows">{{ count($appelFonds) }}</span>
                                    <span class="infoAfter">entrée(s)</span>
                                    <span class="infoFilteredBefore">(filtré sur
                                        {{ count($appelFonds) }} entrée(s</span><span class="infoFilteredAfter">)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Modfier montant  modal --}}
        <div class="modal mbr-popup cid-sODVeVmwHy fade" tabindex="-1" role="dialog" data-overlay-color="#000000"
            data-overlay-opacity="0.8" id="mbr-popup-2w" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="container position-static margin-center-pos">
                        <div class="modal-header pb-0">
                            <h5 class="modal-title mbr-fonts-style display-5">Mettre à jour statut - Appel Fond
                                @{{ selected . mobilePaiement }}</h5>
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
                                    <form id="appelFondEdit" method="POST" class="mbr-form form-with-styler">
                                        @csrf
                                        @method('put')
                                        <x-form-errors :errors="$errors->all()" />
                                        <div class="dragArea">
                                            <div class="mb-3">
                                                <label for="etat" class="form-label">Etat</label>
                                                <select ng-model="selected.etat" class="form-control" name="etat"
                                                    id="etat">
                                                    <option ng-selected="selected.etat=='En attente'">En attente</option>
                                                    <option ng-selected="selected.etat=='En cours'">En cours</option>
                                                    <option ng-selected="selected.etat=='Traité'">Traité</option>
                                                </select>
                                            </div>
                                            <div class="col" ng-if="selected.etat=='Traité'">
                                                <div class="mb-3">
                                                    <label for="frais" class="form-label">Frais d'envoi</label>
                                                    <input type="number" name="frais" id="frais" class="form-control"
                                                        placeholder="Frais appliqués lors du paiement">
                                                </div>
                                            </div>
                                            <div class="col-md-auto input-group-btn">
                                                <button ng-click="changeEtat()" type="button"
                                                    class="btn btn-white display-4">Appliquer</button>
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
    </section>
@endsection
