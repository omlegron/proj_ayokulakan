<?php

namespace App\Console;

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
        'App\Console\Commands\getPriceListPPOB',
        'App\Console\Commands\darmaWilayahHotel',
        'App\Console\Commands\notifToday',
        'App\Console\Commands\notifHadist',
        'App\Console\Commands\cronjobTransaksi',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('ppob:pricelist')->everyMinute();
        $schedule->command('notifToday:check')->everyMinute();
        $schedule->command('notifHadist:check')->dailyAt('05:59');
        $schedule->command('command:transaksi')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        
        require base_path('routes/console.php');
    }
}
