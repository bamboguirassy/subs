@component('mail::message')
# Mail de rappel - Tontine
-- Ceci est un mail automatique <br>
Bonjour **{{ $souscription->user->name }}**, <br>
Les paiements pour votre tontine ***{{ $programme->frequence }}*** démarre aujourd'hui jusqu'au **{{ date_format(new DateTime($programme->dateCloture),'d/m/Y') }}**. <br>
Merci de procéder au paiement avant la date d'échéance. <br>
Vous avez plusieurs possibilités de paiements parmi lesquelles **Orange Money, FreeMoney, Wizall, Carte Bancaire, etc....** <br>
Merci de cliquer sur le bouton ci-dessous pour procéder au paiement.<br>

@component('mail::button', ['url' => route('souscription.new',['programme'=>$programme])]) Procéder directement au paiement
@endcomponent

Si vous rencontrez des problèmes lors du paiement, merci de contacter le service client de **Bambogroup** à l'adresse : **contact@bambogroup.net** <br>
Ou sur WhatsApp : [+221778224129](+221778224129) <br>

Cordialement, <br>
{{ config('app.name') }}
@endcomponent
