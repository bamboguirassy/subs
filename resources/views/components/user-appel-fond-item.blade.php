<div class="card mb-3" style="border: 1px solid gray;">
    <a href="{{ route('programme.show', ['programme' => $appelFond->programme]) }}">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ isset($appelFond->programme->image) ? asset('uploads/programmes/images/' . $appelFond->programme->image) : asset('assets/images/fulllogo_nobuffer.png') }}"
                    class="img-fluid rounded-start" alt="{{ $appelFond->programme->nom }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title display-4"><strong>{{ $appelFond->programme->nom }}</strong></h5>
                    <p class="mbr-section-text mbr-fonts-style align-left" style="font-size: 14px;">
                        {{ $appelFond->montant }} FCFA - {{ $appelFond->methodePaiement }} -
                        {{ $appelFond->mobilePaiement }} </p>
                    <p class="card-text display-4">
                        <strong>{{ $appelFond->etat }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </a>
</div>
