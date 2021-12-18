@extends("base")

@section('title', 'Liste des appels de fonds - ' . config('app.name'))

@section('body')
    <section data-bs-version="5.1" class="info1 cid-sPNyRAAd7I" id="info1-2j">
        <div class="align-center container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h3 class="mbr-section-title mb-4 mbr-fonts-style display-1">
                        <strong>Notifications</strong>
                    </h3>
                </div>
                <div class="col-12">
                    <x-empty-message title="Pas encore de notification"
                                        message="Aucune notification pour le moment" />
                </div>
            </div>
        </div>
    </section>

@endsection
