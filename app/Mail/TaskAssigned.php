<?php

namespace App\Mail;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $student;

    public function __construct(Task $task, User $student)
    {
        $this->task = $task;
        $this->student = $student;
    }

    public function build()
    {
        return $this->view('emails.task_assigned')
                    ->with([
                        'task' => $this->task,
                        'student' => $this->student,
                    ]);
    }
}
