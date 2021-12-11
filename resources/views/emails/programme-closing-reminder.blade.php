@component('mail::message')
[![{{ config('app.name') }}]({{ asset('assets/images/fulllogo_nobuffer.png') }})]({{ asset('assets/images/fulllogo_nobuffer.png') }})

# Bonjour **{{ $programme->user->name }}**

Le programme ***{{ $programme->nom }}***, que vous avez initié, sera cloturé le {{date_format(new DateTime($programme->dateCloture),'d/m/Y')}}. <br>
Si vous souhaitez apporter des modifications ou prolonger le délai, merci de le faire à temps. <br>
|  NB: Les participants (ceux qui se sont déja inscrits) seront automatiquement notifiés de ce changement. <br>
<br>

Ce rappel vous sera envoyé à : <br>
-  A une semaine de la date de cloture
-  A 3 jours de la date de cloture
-  A la veille de la date de cloture
<br>

@component('mail::button', ['url' => route('programme.show',compact('programme'))])
Accéder au programme
@endcomponent

## Bilan actuel
- **Nombre de participants:** : {{count($programme->souscriptions)}} <br>
- **Montant Gain:** : (à calculer) en FCFA <br/>

@isset($programme->dateDemarrage)
Pour rappel, le programme débute le {{date_format(new DateTime($programme->dateDemarrage),'d/m/Y')}} <br>
@endisset


Cordialement,<br>
{{ config('app.name') }}
@endcomponent
