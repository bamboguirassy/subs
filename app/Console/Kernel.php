<?php

namespace App\Console;

use App\Console\Commands\GenerateProgramNextPayment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('remind:programme:closing')
            ->dailyAt('18:30')->timezone('Africa/Dakar')
            ->emailOutputTo(config('mail.cc'));
        $schedule->command('remind:leads-to-subscribe')
            ->dailyAt('10:00')->timezone('Africa/Dakar')
            ->emailOutputTo(config('mail.cc'));
        $schedule->command('generate:program-next-payment')->dailyAt('08:00')->timezone('Africa/Dakar')->emailOutputTo(config('mail.cc'));
        $schedule->command('display:solde-sms')->dailyAt('07:00')->timezone('Africa/Dakar')->emailOutputTo(config('mail.cc'));
        $schedule->command('delete:programme-leads')->dailyAt('23:59')->timezone('Africa/Dakar')->emailOutputTo(config('mail.cc'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
