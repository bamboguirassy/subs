<?php

use App\Mail\RemindLeadsToSouscribe;
use App\Mail\RemindProgrammeClosing;
use App\Models\Programme;
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

Artisan::command('remind:programme:closing', function () {
    $today = today();
    $tomorrow = $today->addDay("+1");
    $programmes = Programme::where('dateCloture', $tomorrow)
        ->get();
    $nombreProgramme = count($programmes);
    $this->comment("Vous avez {$nombreProgramme} programmes qui seront cloturés pour " . date_format($tomorrow, 'd/m/Y'));
    foreach ($programmes as $programme) {
        Mail::to($programme->user)->bcc(config('mail.cc'))->send(new RemindProgrammeClosing($programme));
        $this->comment("Programme: {$programme->nom} / Rappel envoyé à {$programme->user->name} - {$programme->user->email}");
    }
})->purpose('Remind programme owners for programme close-date one day before');

Artisan::command('remind:leads-to-subscribe', function () {
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
    }

    /** programme expirant dans trois jours */
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
    }

    /** programme expirant dans une semain jours */
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
    }
})->purpose("Cette commande rappel la finalisation de la souscription pour les leads.");
