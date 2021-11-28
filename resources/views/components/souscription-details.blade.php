<section data-bs-version="5.1" class="extContent cid-sOGZSPGq1N" id="extContent21-22">
    <div class="container">
        <h2 class="mbr-section-title pb-1 mbr-fonts-style mbr-bold display-2">Détails</h2>
        <div class="row">
            <div class="col-md-4">
                <p class="mbr-text mbr-fonts-style display-7">
                    <strong>Date Souscription:</strong>
                    {{ date_format(new DateTime($souscription->created_at), 'd/m/Y H:i:s') }}
                </p>
            </div>
            @if ($souscription->programme->is_programme)
                <div class="col-md-4">
                    <p class="mbr-text mbr-fonts-style display-7">
                        <strong>Profil</strong>: {{ $souscription->profilConcerne->profil->nom }}
                    </p>
                </div>
            @endif
            <div class="col-md-4">
                <p class="mbr-text mbr-fonts-style display-7">
                    <strong>Montant</strong>: {{ $souscription->montant }} FCFA
                </p>
            </div>
            @if ($souscription->facture)
                <div class="col-md-4">
                    <p class="mbr-text mbr-fonts-style display-7">
                        <strong>Méthode paiement</strong>: {{ $souscription->facture->methodePaiement }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="mbr-text mbr-fonts-style display-7">
                        <strong>Mobile paiement</strong>: {{ $souscription->facture->clientPhone }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="mbr-text mbr-fonts-style display-7">
                        <strong>UID</strong>: {{ $souscription->facture->uid }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</section>
