@component('mail::message')
# Bonjour **{{ $programme->user->name }}**

Le programme ***{{ $programme->nom }}*** sera cloturé demain. <br>
Si vous souhaitez prolonger le délai, merci de le faire dès maintenant. <br>
|  NB: Les participants (ceux qui se sont déja inscrits) seront automatiquement notifiés de ce changement. <br>

@component('mail::button', ['url' => route('programme.edit',compact('programme'))])
Modifier le programme
@endcomponent

## Bilan actuel
- **Nombre de participants:** : {{count($programme->souscriptions)}} <br>
- **Montant Gain:** : en FCFA <br/>

Pour rappel, le programme débute le {{date_format(new DateTime($programme->dateDemarrage),'d/m/Y')}} <br>


Cordialement,<br>
{{ config('app.name') }}
@endcomponent
