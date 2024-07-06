<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Mail\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role')) {
            $role = $request->input('role');
            $query->where('type', $role);
        }
    
        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

         // Send the email notification
        Mail::to($user->email)->send(new UserRegistered($user->name, $user->email, $request->password));

        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'type' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'type' => $request->type,
        ]);

        return redirect()->route('users.index')->with('message', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
         // Unassign tasks
        Task::where('assigned_to', $user->id)->update(['assigned_to' => null]);

        $user->delete();
        return redirect()->route('users.index')->with('message', 'User deleted successfully.');
    }
}
