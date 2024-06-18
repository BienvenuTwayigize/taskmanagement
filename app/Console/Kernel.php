<?php

namespace App\Console;

use App\Console\Commands\SendTaskReminders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendTaskReminders::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:task-reminders')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
