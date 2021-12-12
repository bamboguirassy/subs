@extends("base")

@section('title', 'Liste des appels de fonds - ' . config('app.name'))

@section('body')
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
                    Mes appels de fonds</h2>
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
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Méthode de paiement</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Mobile Paiement</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Montant</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Frais d'envoi</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Date demande</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Traité</th>
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
@endsection
