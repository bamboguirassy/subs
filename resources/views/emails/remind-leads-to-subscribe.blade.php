@component('mail::message')
# Bonjour **{{ $souscriptionTemp->user->name }}** <br>
|  Ceci est un mail de rappel <br>

Le programme ***{{ $souscriptionTemp->programme->nom }}*** sera cloturé {{$remainDate}}. <br>
Il faut finaliser vite votre inscription pour y prendre part. <br>
|  NB: Une fois la date de cloture dépassée, il ne vous sera plus possible de prendre part au programme. <br>

@component('mail::button', ['url' => route('souscription.new',['programme'=>$souscriptionTemp->programme])])
Finaliser mon inscription
@endcomponent


Pour rappel, le programme débute le {{date_format(new DateTime($souscriptionTemp->programme->dateDemarrage),'d/m/Y')}} <br>


Cordialement,<br>
{{ config('app.name') }}
@endcomponent
