<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $finalReminder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task, bool $finalReminder)
    {
        $this->task = $task;
        $this->finalReminder = $finalReminder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Task Reminder')
                    ->view('emails.task_reminder');
    }    
}
