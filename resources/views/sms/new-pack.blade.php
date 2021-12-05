@extends("base")

@section('title', 'Acheter un pack SMS')

@section('description',
    "Acheter des SMS pour interagir directement avec les participants en plus des emails pour plus
    d'impact",)

@section('body')
    <style>
        .card {
            border: none;
            padding: 10px 50px;
            background-color: white;
        }

        .card::after {
            position: absolute;
            z-index: -1;
            opacity: 0;
            -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card:hover {


            transform: scale(1.02, 1.02);
            -webkit-transform: scale(1.02, 1.02);
            backface-visibility: hidden;
            will-change: transform;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .75) !important;
        }

        .card:hover::after {
            opacity: 1;
        }

        .card:hover .btn-outline-primary {
            color: white;
            background: #007bff;
        }

    </style>
    <section data-bs-version="5.1" class="header2 cid-sOct20N5Ut" id="header02-1n">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 title-col">
                    <h6 class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-2">
                        <strong>Acheter un pack SMS</strong>
                    </h6>
                </div>
                <div class="col-12 col-md-12 text-col col-lg-12">
                    <p class="mbr-text align-left mbr-fonts-style mb-0 display-7">
                        <strong>
                            Acheter des SMS pour interagir directement avec les participants en plus des emails pour plus
                            d'impact. <br>
                            Tous les utilisateurs n'ont pas un accès permanent aux mails. <br>
                            Les SMS répresentent le meilleur moyen de communiquer...
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid" style="background: linear-gradient(90deg, #FE525A 0%, #FE0000 100%);">
        <div class="container p-5">
            <div class="row">
                @foreach ($packSms as $packSm)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card h-100 shadow-lg">
                            <form action="{{ route('achatsms.store') }}" method="POST">
                                @csrf
                                @method('post')
                                <input type="number" name="pack_sms_id" id="pack_sms_id" hidden="hidden" value="{{ $packSm->id }}">
                                <div class="card-body">
                                    <div class="text-center p-3">
                                        <h5 class="card-title">{{ $packSm->nom }}</h5>
                                        <br>
                                        <span
                                            class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-3">{{ $packSm->nombreSms }}</span>
                                        SMS
                                        <br><br>
                                        <span
                                            class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-2">{{ $packSm->prix }}</span>
                                        FCFA
                                    </div>
                                    <p class="card-text">{!! $packSm->description !!}</p>
                                </div>
                                <div class="card-body text-center">
                                    <button type="submit" class="btn btn-outline-primary btn-lg"
                                        style="border-radius:30px">Choisir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
