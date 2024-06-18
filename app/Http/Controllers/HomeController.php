<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use illuminate\support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userType = Auth::user()->type;

        if ($userType == 0) {

            $studentId = Auth::id();

            // Retrieve tasks assigned to the logged-in student ordered by end_date
            $tasks = Task::where('assigned_to', $studentId)
                        ->orderBy('end_date', 'asc')
                        ->get();
    
            // Count tasks by status
            $totalTasks = $tasks->count();
            $pendingTasks = $tasks->where('status', 'pending')->count();
            $inProgressTasks = $tasks->where('status', 'inprogress')->count();
            $overdueTasks = $tasks->where('status', 'overdue')->count();
            $completedTasks = $tasks->where('status', 'completed')->count();

            return view('student', compact('tasks', 'totalTasks', 'pendingTasks', 'inProgressTasks', 'overdueTasks', 'completedTasks'));
        } elseif ($userType == 1) {
            
            $status = $request->query('status', ''); // Set default to empty string

            $tasks = Task::when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->with(['assignedBy', 'createdBy', 'assignedTo', 'parentTask'])
            ->orderBy('created_at', 'desc')
            ->get();
            
                // Count all tasks
                $totalTasks = Task::count();

                // Count tasks by status
                $pendingTasks = Task::where('status', 'pending')->count();
                $inProgressTasks = Task::where('status', 'inprogress')->count();
                $overdueTasks = Task::where('status', 'overdue')->count();
                $completedTasks = Task::where('status', 'completed')->count();
            return view('admin.admin', compact('tasks', 'totalTasks', 'pendingTasks', 'overdueTasks', 'completedTasks', 'inProgressTasks'));
        } else {
            // handle other types or redirect to a default page
            return redirect('/login');
        }
        
    } 

}
