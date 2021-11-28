@component('mail::message')
# Bonjour **{{ $souscriptionTemp->user->name }}** <br>
| Ceci est un mail de rappel <br>

Le programme ***{{ $souscriptionTemp->programme->nom }}*** sera cloturé {{ $remainDate }}. <br>
@if ($souscriptionTemp->programme->is_programme)
Il faut finaliser vite votre inscription pour y prendre part. <br>
|  NB: Une fois la date de cloture dépassée, il ne vous sera plus possible de prendre part au programme. <br>
@elseif($souscriptionTemp->programme->is_collecte_fond)
Suivez votre coeur et participez à ce programme car c'est une cause noble. <br>
@else
Si vous voulez faire partir de ce programme, il faut finaliser votre souscription avant date de clôture...
@endif

@component('mail::button', ['url' => route('souscription.new',['programme'=>$souscriptionTemp->programme])])Finaliser mon inscription
@endcomponent

Si vous avez du mal avec le lien, merci de cliquer sur le lien ci-dessous ou de le copier/coller dans votre navigateur : {{ route('souscription.new', ['programme'=>$souscriptionTemp->programme]) }} <br>
Ou encore cliquer ici: <a href="{{route('souscription.new',['programme'=>$souscriptionTemp->programme])}}">{{route('souscription.new',['programme'=>$souscriptionTemp->programme])}}</a>


Pour rappel, le programme débute le {{ date_format(new DateTime($souscriptionTemp->programme->dateDemarrage), 'd/m/Y') }}
<br>


Cordialement,<br>
{{ config('app.name') }}
@endcomponent
