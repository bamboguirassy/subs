@component('mail::message')
# Appel de fond <br>
[![{{ config('app.name') }}]({{ asset('assets/images/fulllogo_nobuffer.png') }})]({{ asset('assets/images/fulllogo_nobuffer.png') }})
-- Ceci est un mail automatique <br>
Bonjour **Admin**, <br>
Un appel de fond pour ***{{ $appelFond->programme->frequence }}*** est lancé. <br>
## Spécifications de la demande
**Mode de paiement :** {{$appelFond->methodePaiement}} <br>
**Montant :** {{$appelFond->montant}} <br>
**Identifiant demande :** {{$appelFond->id}} <br>
Merci de procéder au paiement le plutôt possible. <br>

@component('mail::button', ['url' => route('programme.show',['programme'=>$appelFond->programme])]) Accéder au programme
@endcomponent

Cordialement, <br>
{{ config('app.name') }}
@endcomponent
