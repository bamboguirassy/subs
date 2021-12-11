@component('mail::message')
# {{ config('app.name') }}
[![{{ config('app.name') }}]({{ asset('assets/images/fulllogo_nobuffer.png') }})]({{ asset('assets/images/fulllogo_nobuffer.png') }})

{!! $mailObject['message'] !!} <br>

{{ config('app.name') }}
@endcomponent
