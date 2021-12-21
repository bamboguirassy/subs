<ol class="list-group">
    <li class="list-group-item d-flex justify-content-center text-primary">
        <strong style="font-size: 30px;">{{auth()->user()->nombreSms}} SMS</strong>
    </li>
    @foreach (auth()->user()->achatSmsList as $achatSms)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold text-primary">{{ $achatSms->packSms->nom }}</div>
                <small>{{ $achatSms->montant }} FCFA</small>
                <br>
                {{ date_format($achatSms->created_at,'d/m/y à H:i:s') }}
            </div>
            <span class="badge bg-primary rounded-pill">{{ $achatSms->nombreSms }} SMS</span>
        </li>
    @endforeach
</ol>
<hr>
<div class="d-grid gap-2">
  <a href="{{ route('achatsms.create') }}" class="btn btn-primary">Acheter des SMS</a>
</div>
