<?php

namespace App\Console\Commands;

use App\Mail\TaskReminderMail;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTaskReminders extends Command
{
    protected $signature = 'send:task-reminders';
    protected $description = 'Send task reminders based on reminder start and end dates';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();

        $tasks = Task::where('reminder_start_date', '<=', $today)
                     ->where('reminder_end_date', '>=', $today)
                     ->get();

        foreach ($tasks as $task) {
            $finalReminder = $today->equalTo(Carbon::parse($task->reminder_end_date));
            Mail::to($task->assignedTo->email)->send(new TaskReminderMail($task, $finalReminder));
        }

        return 0;
    }
}
