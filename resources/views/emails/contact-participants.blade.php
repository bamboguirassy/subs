@component('mail::message')
# {{ config('app.name') }}

{!! $mailObject['message'] !!} <br>

{{ config('app.name') }}
@endcomponent
