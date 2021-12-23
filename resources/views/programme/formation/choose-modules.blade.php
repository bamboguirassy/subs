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
    <div class="card" style="padding-top: 70px; background-color: #BA265E">
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
                                        <form action="" method="post">
                                            <ul class="list-group">
                                                @foreach ($programme->parent->modules as $module)
                                                    <li class="list-group-item">
                                                        <input class="form-check-input me-1" type="checkbox" value=""
                                                            aria-label="...">
                                                        Module {{ $loop->index + 1 }} > {{ $module->nom }} <br>
                                                        <span class="badge bg-primary pull-right">@if ($module->montant == 0) gratuit @else {{ $module->montant }} FCFA @endif</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="card-body">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">Procéder à
                                                        l'inscription</button>
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
