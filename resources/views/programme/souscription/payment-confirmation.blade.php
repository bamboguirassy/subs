@extends("base")

@section('title', 'Statut du paiement')

@section('description', 'Statut du paiement')

@section('body')
    <div style="margin-top: 120px;">

        @if ($state == 'success')
            <div class="alert alert-success" role="alert">
                <strong class="my-auto">Confirmation</strong>
                <div class="card">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Paiement reussi</h4>
                        <p class="card-text">
                            Le paiement que vous avez initié a reussi. Un mail de confirmation sera envoyé à votre adresse
                            email
                            pour notification.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                <strong>Erreur</strong>
                <div class="card">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Le paiement a échoué</h4>
                        <p class="card-text">
                            Vous voyez cette fenêtre car vous avez annulé votre paiement ou <br>
                            Une erreur s'est produite lors de votre paiement, <br>
                            La procédure n'a pas pu être complétée. <br>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
