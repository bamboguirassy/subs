@extends("base")

@section('title', 'Liste des programmes - ' . config('app.name'))

@section('body')
    <section data-bs-version="5.1" class="info1 cid-sPNyRAAd7I" id="info1-2j">
        <div class="align-center container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h3 class="mbr-section-title mb-4 mbr-fonts-style display-1">
                        <strong>Programmes</strong>
                    </h3>

                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="table01 photom4_table01 section-table cid-sObY9vjAPL " id="table01-x">
        <div class="row align-center">
            <div class="col-12 col-md-12">
                <h2 class="mbr-section-title mbr-fonts-style mbr-black display-2">
                    Liste des Programmes</h2>
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
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Nom</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Date cloture</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Type</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Date création</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Email</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Téléphone</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Statut</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Nombre souscription</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap">Nombre leads</th>
                                    <th class="head-item mbr-fonts-style display-4 nowrap"> Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($programmes as $programme)
                                    <tr>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            <a href="{{ route('programme.show',compact('programme')) }}">{{ $programme->nom }}</a>
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ $programme->dateCloture }}
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ $programme->typeProgramme->nom }}</td>
                                            <td class="body-item mbr-fonts-style display-7 nowrap">
                                                {{ date_format($programme->created_at, 'd/m/Y H:i:s') }}</td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            <a
                                                href="mailto:{{ $programme->user->email }}">{{ $programme->user->email }}</a>
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            <a
                                                href="tel:{{ $programme->user->telephone }}">{{ $programme->user->telephone }}</a>
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ $programme->active?'Active':'Inactive' }}
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ count($programme->souscriptions) }}
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">
                                            {{ count($programme->souscriptionTemps) }}
                                        </td>
                                        <td class="body-item mbr-fonts-style display-7 nowrap">

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
                                <span class="inactive infoRows">{{ count($programmes) }}</span>
                                <span class="infoAfter">entrée(s)</span>
                                <span class="infoFilteredBefore">(filtré sur
                                    {{ count($programmes) }} entrée(s</span><span class="infoFilteredAfter">)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
