@extends("base")

@section('title', 'Publier un nouveau programme - Choisir type programme')

@section('description',
    'Publier un nouveau programme et permettez aux interessés de souscrire pour prendre part au
    programme.',)

@section('body')
<div style="margin-top: 120px;">
    <x-separator />
</div>
    <x-programme-type-choice />
    <x-separator />
    <x-social-sharing />
@endsection
