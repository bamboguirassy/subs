@extends('base')

@section('title', 'Vérifier son email')

@section('body')
<div class="container" style="margin-top: 120px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirmez votre adresse email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un lien de vérifivation récent a été envoyé à votre adresse email.') }}
                        </div>
                    @endif

                    {{ __('Avant de procéder, merci de vérifier votre boite email pour y trouver le lien de vérification.') }} <br>
                    {{ __("Si vous n'avez pas reçu de mail") }},
                    <form style="display: inline-block;" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Cliquez ici pour en recevoir') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
