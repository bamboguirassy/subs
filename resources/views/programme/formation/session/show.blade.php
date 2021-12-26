@extends("base")

@section('title', $programme->nom . ' - Date clôture prévue - ' . date_format(new DateTime($programme->dateCloture),
    'd/m/Y'))

@section('social-sharing')
    <meta name="twitter:image:src" content="{{ asset('uploads/programmes/images/' . $programme->parent->image) }}">
    <meta property="og:image" content="{{ asset('uploads/programmes/images/' . $programme->parent->image) }}">
@endsection

@section('description', $programme->parent->description)

@section('body')
    <div style="margin-top: 70px;" class="d-none d-sm-block"></div>
    <div class="card" style="padding-top: 70px; background-color: #BA265E">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card mb-3 bg-white">
                        <div class="row g-0">
                            <div class="col-lg-3">
                                <img src="{{ asset('uploads/programmes/images/' . $programme->parent->image) }}"
                                    class="img-fluid rounded-start" alt="...">
                                <div class="card bg-white d-flex py-2 justify-content-center mx-auto">
                                    <a href="{{ route('souscription.new', compact('programme')) }}?step=module"
                                        class="btn btn-primary">Participer &nbsp;
                                        <span class="mbri-arrow-next"></span>
                                    </a>
                                    @if ($programme->is_proprietaire)
                                        <a href="{{ route('programme.edit', compact('programme')) }}"
                                            class="btn btn-warning">Modifier &nbsp;
                                            <span class="mbri-edit"></span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card-body">
                                    <h5 class="card-title text-primary display-7"><b>{{ $programme->nom }}</b> >
                                        {{ $programme->parent->nom }}
                                    </h5>
                                    <p class="card-text"><strong class="text-muted">par
                                            {{ $programme->user->name }}</strong>
                                    </p>
                                    <p>
                                        {!! $programme->description !!}
                                    </p>
                                    @if ($programme->suspendu)
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Cette session est suspendue...</strong>
                                        </div>
                                    @elseif(!$programme->active)
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Cette session est clôturée le
                                                {{ date_format(new DateTime($programme->dateCloture), 'd/m/Y') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Liste des souscriptions</h4>
                            @if(count($tabUsers)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Téléphone</th>
                                            <th>Email</th>
                                            @foreach ($programme->parent->modules as $module)
                                                <th class="nowrap">{{ $module->nom }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tabUsers as $tabUser)
                                            <tr>
                                                <td class="nowrap" scope="row">{{ $loop->index + 1 }}</td>
                                                <td class="nowrap">{{ $tabUser['user']->name }}</td>
                                                <td class="nowrap">
                                                    <a
                                                        href="tel:+{{ $tabUser['user']->telephone }}">{{ $tabUser['user']->telephone }}</a>
                                                </td>
                                                <td class="nowrap">
                                                    <a
                                                        href="mailto:{{ $tabUser['user']->email }}">{{ $tabUser['user']->email }}</a>
                                                </td>
                                                @foreach ($tabUser['states'] as $state)
                                                    <td class="nowrap">
                                                        @if ($state)
                                                            <span class="mbri-success"></span>
                                                        @else
                                                            <span class="mbri-close"></span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <x-empty-message title="Vide" message="Il n'y a aucune souscription pour cette session" />
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-separator />
    <hr class="mt-5">
@endsection
