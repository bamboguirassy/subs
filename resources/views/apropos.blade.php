@extends("base")

@section('title', config('app.name'))

@section('body')
    <section data-bs-version="5.1" class="info1 cid-sPNyRAAd7I" id="info1-2j">
        <div class="align-center container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <h3 class="mbr-section-title mb-4 mbr-fonts-style display-1">
                        <strong>Comment ça marche ?</strong>
                    </h3>
                    <p class="mbr-text mb-5 mbr-fonts-style display-7">
                        Vous voulez récupérer les inscriptions des participants à vos programmes ? Vous souhaitez récupérer
                        les paiements des participants et avoir une vue d'ensemble sur vos programmes ? ça se fait
                        naturellement sur <strong>{{  config('app.name') }}</strong>.</p>

                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="content13 cid-sPNyMLw1C3" id="content13-2i">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style mb-4 display-5"><strong>Retrouvez tous les détails sur la
                            plateforme ici :</strong></h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6">
                            <ul class="list mbr-fonts-style display-7">
                                <li><strong>Comment publier un programme ?</strong><br>Il suffit de cliquer <strong><a
                                            href="#top" class="text-primary">ici</a> </strong>pour publier un programme.
                                </li>
                                <li><strong>Qui peut souscrire ?</strong><br>La souscription dépends des profils que vous
                                    avez visé pour votre programme. Il existe des programmes qui ne seront pas visibles
                                    directement au public, vous le partagez avec les concernés.</li>
                                <li><strong>Comment récupérer&nbsp;les fonds</strong><br>Vous pouvez récupérer vos fonds
                                    moyennant une déduction de 5% qui sera reversée à la plateforme.</li>
                                <li><strong>Peut-on organiser des tontines sur la plateforme ?<br></strong>Oui, vous avez la
                                    possibilité d'organiser des programmes de paiements récurrent qui vous aident à mieux
                                    organiser les collectes des fonds des participants.</li>
                                <li><strong>Que permet de faire la plateforme ?<br></strong>La plateforme vous permet de
                                    collecter les inscriptions, collecter les fonds (uniquement pour les programmes
                                    payants), automatiser les rappels pour ceux qui n'ont pas encore finalisé leurs
                                    inscriptions sur la plateforme. Elle vous permet même de recevoir de façon périodique
                                    des rapports automatisés sur les souscriptions.</li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list mbr-fonts-style display-7">
                                <li><strong>Quand peut-on récupérer&nbsp;ses fonds ?</strong><br>Vous pouvez récupérer vos
                                    fonds à la date limite de souscription définie dans le programme.&nbsp;</li>
                                <li><strong>Est ce que les remboursements sont gérés ?<br></strong>Tout participant peut
                                    décider d'annuler son inscription en faisant directement la demande depuis la
                                    plateforme. Une fois la date de cloture dépassée, il ne peut avoir de remboursement
                                    depuis la plateforme.</li>
                                <li><strong>Peut-on gérer des cotisations à partir de la plateforme ?<br></strong>Oui, vous
                                    pouvez bel et bien organiser un programme de cotisation avec vos amis ou votre famille
                                    ou vos collègues dans le but de rendre transparent les paiements effectués et savoir qui
                                    a payé de qui ne l'a pas fait.</li>
                                <li><strong>Peut on avoir des détails sur la plateforme ?<br></strong>Oui, vous pouvez
                                    directement nous contacter sur WhatsApp depuis la plateforme ou encore nous contacter
                                    depuis la page <a href="#top" class="text-primary"><strong>contact </strong></a>de la
                                    plateforme.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
