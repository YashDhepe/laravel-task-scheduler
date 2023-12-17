<?php

namespace App\Console;

use App\Jobs\SendOverdueTaskJob;
use App\Jobs\SendOverdueTaskNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // Run every day at midnight to send email notifications for overdue tasks
        // $schedule->job(new JobsSendOverdueTaskNotification)->dailyAt('00:00');
        $schedule->job(new SendOverdueTaskJob)->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
