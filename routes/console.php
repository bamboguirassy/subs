<?php

use App\Mail\RemindLeadsToSouscribe;
use App\Mail\RemindProgrammeClosing;
use App\Mail\RemindSubscribedUsers;
use App\Models\Parametrage;
use App\Models\Programme;
use App\Models\Souscription;
use App\Models\SouscriptionTemp;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('display:solde-sms', function () {
    $this->comment(Parametrage::getInstance()->soldeSms." SMS restant(s) dans le système !");
})->purpose('Display solde SMS....');

Artisan::command('delete:programme-leads', function () {
    $this->comment("### Script de suppression des leads, un mois après clôture d'un programme.");
    // recuperer les programmes cloturées il y'a un mois
    $programmes = Programme::where('dateCloture',today()->addMonths('-1'))->get();
    foreach ($programmes as $programme) {
        // recuperer les leads
        $this->comment("Le programme {$programme->nom} a ".count($programme->souscriptionTemps)." leads qui sont supprimés.");
        SouscriptionTemp::destroy($programme->souscriptionTemps);
    }
    $this->comment("Le traitement est terminé sans erreur !");
})->purpose('Delete closed programs leads');

Artisan::command('remind:programme:closing', function () {
    $today = today();
    $closingDate = $today->addDay("+1");
    $programmes = Programme::where('dateCloture', $closingDate)
        ->get();
    $nombreProgramme = count($programmes);
    $this->comment("Vous avez {$nombreProgramme} programmes qui seront cloturés pour le" . date_format($closingDate, 'd/m/Y'));
    foreach ($programmes as $programme) {
        Mail::to($programme->user)->bcc(config('mail.cc'))->send(new RemindProgrammeClosing($programme));
        $this->comment("Programme: {$programme->nom} / Rappel envoyé à {$programme->user->name} - {$programme->user->email}");
    }
    // porgamme expirtant dans 3 jours
    $today = today();
    $closingDate = $today->addDay("+3");
    $programmes = Programme::where('dateCloture', $closingDate)
        ->get();
    $nombreProgramme = count($programmes);
    $this->comment("Vous avez {$nombreProgramme} programmes qui seront cloturés pour le" . date_format($closingDate, 'd/m/Y'));
    foreach ($programmes as $programme) {
        Mail::to($programme->user)->bcc(config('mail.cc'))->send(new RemindProgrammeClosing($programme));
        $this->comment("Programme: {$programme->nom} / Rappel envoyé à {$programme->user->name} - {$programme->user->email}");
    }
    // porgamme expirtant dans 7 jours
    $today = today();
    $closingDate = $today->addDay("+7");
    $programmes = Programme::where('dateCloture', $closingDate)
        ->get();
    $nombreProgramme = count($programmes);
    $this->comment("Vous avez {$nombreProgramme} programmes qui seront cloturés pour le" . date_format($closingDate, 'd/m/Y'));
    foreach ($programmes as $programme) {
        Mail::to($programme->user)->bcc(config('mail.cc'))->send(new RemindProgrammeClosing($programme));
        $this->comment("Programme: {$programme->nom} / Rappel envoyé à {$programme->user->name} - {$programme->user->email}");
    }
})->purpose('Remind programme owners for programme close-date one day before');

/** Cette commande permet d'envoyer des emails aux utilisateurs
 * qui ont commencé mais pas completé leur souscription pour un programme
 * Elle permet de rappeler ceux qui ont souscrit aussi pour ne pas rater le programme
 */
Artisan::command('remind:leads-to-subscribe', function () {
    /** les programmes qui expirent demain */
    $today = today();
    $programmes = Programme::where('dateCloture', $today)
        ->get();
    $this->comment("Vous avez " . count($programmes) . " programmes qui seront cloturés pour " . date_format($today, 'd/m/Y'));
    foreach ($programmes as $programme) {
        $this->comment("Programme - {$programme->nom} :");
        // recuperer les users ayant des souscriptionTemp pour ce programme
        $souscriptionTemps = SouscriptionTemp::where('programme_id', $programme->id)
            ->get();
        $contactedEmails = [];
        $this->comment("Les souscriptions en instances...");
        foreach ($souscriptionTemps as $souscriptionTemp) {
            if (!in_array($souscriptionTemp->user_id, $contactedEmails)) {
                $contactedEmails[] = $souscriptionTemp->user_id;
                Mail::to($souscriptionTemp->user)->send(new RemindLeadsToSouscribe($souscriptionTemp, " aujourd'hui"));
                $this->comment("Rappel envoyé à {$souscriptionTemp->user->name} - {$souscriptionTemp->user->email}");
            }
        }
        // recuperer ceux qui ont souscrit
        if ($programme->is_programe || $programme->typeProgramme->code == 'TONTINE') {
            $souscriptions = Souscription::where('programme_id', $programme->id)
                ->get();
            $contactedEmails = [];
            $this->comment("Les souscriptions confirmées");
            foreach ($souscriptions as $souscription) {
                $contactedEmails[] = $souscription->user_id;
                Mail::to($souscription->user)->send(new RemindSubscribedUsers($souscription));
                $this->comment("Rappel envoyé à {$souscription->user->name} - {$souscription->user->email}");
            }
        }
    }

    /** les programmes qui expirent demain */
    $today = today();
    $tomorrow = $today->addDay("+1");
    $programmes = Programme::where('dateCloture', $tomorrow)
        ->get();
    $this->comment("Vous avez " . count($programmes) . " programmes qui seront cloturés pour " . date_format($tomorrow, 'd/m/Y'));
    foreach ($programmes as $programme) {
        $this->comment("Programme - {$programme->nom} :");
        // recuperer les users ayant des souscriptionTemp pour ce programme
        $souscriptionTemps = SouscriptionTemp::where('programme_id', $programme->id)
            ->get();
        $contactedEmails = [];
        foreach ($souscriptionTemps as $souscriptionTemp) {
            if (!in_array($souscriptionTemp->user_id, $contactedEmails)) {
                $contactedEmails[] = $souscriptionTemp->user_id;
                Mail::to($souscriptionTemp->user)->send(new RemindLeadsToSouscribe($souscriptionTemp, ' demain'));
                $this->comment("Rappel envoyé à {$souscriptionTemp->user->name} - {$souscriptionTemp->user->email}");
            }
        }
        // recuperer ceux qui ont souscrit
        if ($programme->is_programe || $programme->typeProgramme->code == 'TONTINE') {

            $souscriptions = Souscription::where('programme_id', $programme->id)
                ->get();
            $contactedEmails = [];
            $this->comment("Les souscriptions confirmées");
            foreach ($souscriptions as $souscription) {
                $contactedEmails[] = $souscription->user_id;
                Mail::to($souscription->user)->send(new RemindSubscribedUsers($souscription));
                $this->comment("Rappel envoyé à {$souscription->user->name} - {$souscription->user->email}");
            }
        }
    }

    /** programme expirant dans trois jours */
    $today = today();
    $inThreeeDays = $today->addDay("+3");
    $programmes = Programme::where('dateCloture', $inThreeeDays)
        ->get();
    $this->comment("Vous avez " . count($programmes) . " programmes qui seront cloturés pour " . date_format($inThreeeDays, 'd/m/Y'));
    foreach ($programmes as $programme) {
        $this->comment("Programme - {$programme->nom} :");
        // recuperer les users ayant des souscriptionTemp pour ce programme
        $souscriptionTemps = SouscriptionTemp::where('programme_id', $programme->id)
            ->get();
        $contactedEmails = [];
        foreach ($souscriptionTemps as $souscriptionTemp) {
            if (!in_array($souscriptionTemp->user_id, $contactedEmails)) {
                $contactedEmails[] = $souscriptionTemp->user_id;
                Mail::to($souscriptionTemp->user)->send(new RemindLeadsToSouscribe($souscriptionTemp, " dans 3 jours"));
                $this->comment("Rappel envoyé à {$souscriptionTemp->user->name} - {$souscriptionTemp->user->email}");
            }
        }
        // recuperer ceux qui ont souscrit
        if ($programme->is_programe || $programme->typeProgramme->code == 'TONTINE') {
            $souscriptions = Souscription::where('programme_id', $programme->id)
                ->get();
            $contactedEmails = [];
            $this->comment("Les souscriptions confirmées");
            foreach ($souscriptions as $souscription) {
                $contactedEmails[] = $souscription->user_id;
                Mail::to($souscription->user)->send(new RemindSubscribedUsers($souscription));
                $this->comment("Rappel envoyé à {$souscription->user->name} - {$souscription->user->email}");
            }
        }
    }

    /** programme expirant dans une semain jours */
    $today = today();
    $inAWeek = $today->addWeek("+1");
    $programmes = Programme::where('dateCloture', $inAWeek)
        ->get();
    $this->comment("Vous avez " . count($programmes) . " programmes qui seront cloturés pour " . date_format($inAWeek, 'd/m/Y'));
    foreach ($programmes as $programme) {
        $this->comment("Programme - {$programme->nom} :");
        // recuperer les users ayant des souscriptionTemp pour ce programme
        $souscriptionTemps = SouscriptionTemp::where('programme_id', $programme->id)
            ->get();
        $contactedEmails = [];
        foreach ($souscriptionTemps as $souscriptionTemp) {
            if (!in_array($souscriptionTemp->user_id, $contactedEmails)) {
                $contactedEmails[] = $souscriptionTemp->user_id;
                Mail::to($souscriptionTemp->user)->bcc(config('mail.cc'))->send(new RemindLeadsToSouscribe($souscriptionTemp, " dans une semaine."));
                $this->comment("Rappel envoyé à {$souscriptionTemp->user->name} - {$souscriptionTemp->user->email}");
            }
        }
        // recuperer ceux qui ont souscrit
        if ($programme->is_programe || $programme->typeProgramme->code == 'TONTINE') {
            $souscriptions = Souscription::where('programme_id', $programme->id)
                ->get();
            $contactedEmails = [];
            $this->comment("Les souscriptions confirmées");
            foreach ($souscriptions as $souscription) {
                $contactedEmails[] = $souscription->user_id;
                Mail::to($souscription->user)->send(new RemindSubscribedUsers($souscription));
                $this->comment("Rappel envoyé à {$souscription->user->name} - {$souscription->user->email}");
            }
        }
    }
})->purpose("Cette commande rappel la finalisation de la souscription pour les leads.");
