<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Mail\TaskAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status'); // Get the 'status' query parameter from the request

        $tasksQuery = Task::query()
            ->with(['assignedBy', 'createdBy', 'assignedTo', 'parentTask'])
            ->orderBy('created_at', 'desc');
    
        if ($status) {
            $tasksQuery->where('status', $status); // Apply the status filter if 'status' parameter is present
        }
    
        $tasks = $tasksQuery->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('type', 0)->get(); // Assuming 0 is the type for students
        $tasks = Task::all(); // For parent task dropdown
        return view('admin.tasks.create', compact('users', 'tasks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reminder_start_date' => 'nullable|date',
            'reminder_end_date' => 'nullable|date',
            'status' => 'required|in:pending,overdue,completed,inprogress',
            'priority' => 'required|in:low,medium,high',
            'category' => 'nullable|string|max:255',
            'attachments' => 'nullable|array',
            'comments' => 'nullable|string',
            'is_recurring' => 'nullable|boolean',
            'recurrence_interval' => 'nullable|in:daily,weekly,monthly',
            'parent_task_id' => 'nullable|exists:tasks,id',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['assigned_by'] = auth()->user()->id;
        $validatedData['attachments'] = json_encode($validatedData['attachments'] ?? []);

        $task = Task::create($validatedData);

                // Send email notification to the assigned student
        $student = User::find($validatedData['assigned_to']);
        Mail::to($student->email)->send(new TaskAssigned($task, $student));

        return redirect()->route('tasks.index')->with('message', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('admin.tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $students = User::where('type', 0)->get(); // Assuming 0 is the type for students
        $tasks = Task::all();
        return view('admin.tasks.edit', compact('task', 'students', 'tasks'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reminder_start_date' => 'nullable|date',
            'reminder_end_date' => 'nullable|date',
            'status' => 'required|in:pending,overdue,completed,inprogress',
            'priority' => 'required|in:low,medium,high',
            'category' => 'nullable|string|max:255',
            'attachments' => 'nullable|array',
            'comments' => 'nullable|string',
            'is_recurring' => 'nullable|boolean',
            'recurrence_interval' => 'nullable|in:daily,weekly,monthly',
            'parent_task_id' => 'nullable|exists:tasks,id',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        $validatedData['assigned_by'] = auth()->user()->id;
        $validatedData['attachments'] = json_encode($validatedData['attachments'] ?? []);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully.');
    }
}
