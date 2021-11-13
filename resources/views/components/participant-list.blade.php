<section data-bs-version="5.1" class="table01 photom4_table01 section-table cid-sObY9vjAPL" id="table01-x">
    <div class="container-fluid">
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
                    <div class="container-fluid scroll">
                        <table class="table table-striped isSearch" cellspacing="0"
                            data-empty="No matching records found">
                            <thead>
                                <tr class="table-heads">
                                    <th class="head-item mbr-fonts-style display-4">#</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Nom complet</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Profil</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Email</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Téléphone</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">DATE</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Profession</th>
                                    {{-- <th class="head-item mbr-fonts-style display-4 nowrap">ACTION</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($souscriptions as $souscription)
                                    <tr>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">{{ $loop->index + 1 }}
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ $souscription->user->name }}</td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ $souscription->profilConcerne->profil->nom }}</td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap"><a
                                                href="mailto:{{ $souscription->user->email }}">{{ $souscription->user->email }}</a>
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap"><a
                                                href="tel:{{ $souscription->user->telephone }}">{{ $souscription->user->telephone }}</a>
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ date_format($souscription->created_at, 'd/m/Y H:i:s') }}</td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ $souscription->user->profession }}</td>
                                        {{-- <td class="body-item mbr-fonts-style display-7 nowrap">button</td> --}}
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
    </div>
</section>
