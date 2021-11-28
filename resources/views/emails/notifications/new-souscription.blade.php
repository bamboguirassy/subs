@component('mail::message')
# {{ config('app.name') }}
## _Confirmation Souscription_

[![Subs]({{ asset('assets/images/subs-logo.png') }})]({{ asset('assets/images/subs-logo.png') }})

Bonjour **{{ $souscription->user->name }}**,<br>
@if ($souscription->programme->is_programme)
Votre souscription pour le programme "**{{ $souscription->programme->nom }}**" a reussi.<br>

Votre numéro de ticket est le suivant : <br>
| **{{ $souscription->uid }}** <br>
Le programme démarre le
***{{ date_format(new DateTime($souscription->programme->dateDemarrage), 'd/m/Y') }}***.<br>

@component('mail::button', ['url' => route('programme.show', ['programme' => $souscription->programme])])Accéder au programme
@endcomponent

Vous serez notifié à la programmation de chaque séance.<br>

Pour toute information complémentaire, prenez contact avec le responsable sur le numéro de téléphone suivant : <a href="tel:{{ $souscription->programme->user->telephone }}">**{{ $souscription->programme->user->telephone }}**</a>.<br>
@elseif ($souscription->programme->is_collecte_fond)
Nous avons reçu votre contribution à notre programme social : **{{ $souscription->programme->nom }}**. <br>
Merci d'avoir suivi votre coeur. <br>
Nous vous remercions infiniment. <br>
@else
Nous avons reçu votre inscription pour le programme : **{{ $souscription->programme->nom }}**, vous faites désormais partir des membres. <br>
Merci et à très bientôt pour d'autres programmes. <br>
@endif
Cordialement,
{{ config('app.name') }}
@endcomponent
