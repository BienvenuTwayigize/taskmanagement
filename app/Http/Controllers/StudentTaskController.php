<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentTaskController extends Controller
{
    // Method to retrieve logged-in student's tasks
    public function index(Request $request)
    {
        $studentId = Auth::id();
        $status = $request->query('status'); // Get the 'status' query parameter from the request
    
        $tasksQuery = Task::query()
            ->with(['assignedBy', 'createdBy', 'assignedTo', 'parentTask'])
            ->orderBy('created_at', 'desc')
            ->where('assigned_to', $studentId); // Filter by assigned_to ID
    
        if ($status) {
            $tasksQuery->where('status', $status); // Apply the status filter if 'status' parameter is present
        }
    
        $tasks = $tasksQuery->get();
    
        return view('student.tasks.index', compact('tasks'));
    }

    // Method to show the details of a task
    public function show($id)
    {
        $task = Task::findOrFail($id);

        // Ensure the task belongs to the logged-in student
        if ($task->assigned_to != Auth::id()) {
            return redirect()->route('student.tasks.index')->with('error', 'Unauthorized access.');
        }

        return view('student.tasks.show', compact('task'));
    }

    // Method to show the form for editing a task
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // Ensure the task belongs to the logged-in student
        if ($task->assigned_to != Auth::id()) {
            return redirect()->route('student.tasks.index')->with('error', 'Unauthorized access.');
        }

        return view('student.tasks.edit', compact('task'));
    }

    // Method to update a task
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Ensure the task belongs to the logged-in student
        if ($task->assigned_to != Auth::id()) {
            return redirect()->route('student.tasks.index')->with('error', 'Unauthorized access.');
        }

        $validatedData = $request->validate([
            'progress' => 'required|integer|min:0|max:100',
            'status' => 'required|in:pending,inprogress,overdue,completed',
        ]);

        $task->update($validatedData);

        return redirect()->route('student.tasks.index')->with('message', 'Task updated successfully.');
    }
}
