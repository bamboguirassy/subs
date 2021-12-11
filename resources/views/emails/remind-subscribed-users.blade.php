@component('mail::message')
# Bonjour **{{ $souscription->user->name }}** <br>
| Ceci est un mail de rappel <br>
[![{{ config('app.name') }}]({{ asset('assets/images/fulllogo_nobuffer.png') }})]({{ asset('assets/images/fulllogo_nobuffer.png') }})
<br>
Le programme ***{{ $souscription->programme->nom }}***, auquel vous avez souscrit, démarre le {{ date_format(new DateTime($souscription->programme->dateDemarrage), 'd/m/Y') }}. <br>
Ceci est un mail automatique envoyé par le système pour que vous ne l'oubliez pas dans votre agenda. <br>

@component('mail::button', ['url' => route('programme.show',['programme'=>$souscription->programme])]) Accéder au programme
@endcomponent

Si vous avez du mal à ouvrir le lien, merci de le copier/coller dans votre navigateur : {{ route('programme.show', ['programme'=>$souscription->programme]) }} <br>
Oubien de cliquer ici: <a href="{{route('programme.show',['programme'=>$souscription->programme])}}">{{route('programme.show',['programme'=>$souscription->programme])}}</a>
<br>

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
