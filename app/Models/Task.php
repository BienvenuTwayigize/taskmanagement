<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'assigned_by', 'created_by', 'assigned_to',
        'start_date', 'end_date', 'reminder_start_date', 'reminder_end_date',
        'status', 'priority', 'category', 'tags', 'attachments', 'comments',
        'is_recurring', 'recurrence_interval', 'parent_task_id', 'progress'
    ];

    protected $casts = [
        'tags' => 'array',
        'attachments' => 'array',
    ];

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function parentTask()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function subtasks()
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }
}
