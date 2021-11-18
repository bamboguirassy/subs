<?php

use App\Mail\RemindProgrammeClosing;
use App\Models\Programme;
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

Artisan::command('remind:programme:closing', function() {
    $today = today();
    $tomorrow = $today->addDay("+1");
    $programmes = Programme::where('dateCloture',$tomorrow)
    ->get();
    $nombreProgramme = count($programmes);
   foreach ($programmes as $programme) {
       Mail::to($programme->user)->bcc(config('mail.cc'))->send(new RemindProgrammeClosing($programme));
   }
    $this->comment("Vous avez {$nombreProgramme} programmes qui seront cloturés pour ".date_format($tomorrow,'d/m/Y'));
})->purpose('Remind programme owners for programme close-date one day before');
