<?php

use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*------------------------------------------
--------------------------------------------
All Student Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', UserAccess::class . ':0'])->group(function () {
    Route::get('/student', [HomeController::class, 'index'])->name('student');

    Route::get('/student/tasks', [StudentTaskController::class, 'index'])->name('student.tasks.index');
    Route::get('/student/tasks/{task}', [StudentTaskController::class, 'show'])->name('student.tasks.show');
    Route::get('/student/tasks/{task}/edit', [StudentTaskController::class, 'edit'])->name('student.tasks.edit');
    Route::put('/student/tasks/{task}', [StudentTaskController::class, 'update'])->name('student.tasks.update');

});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', UserAccess::class . ':1'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
    Route::resource('admin/tasks', TaskController::class);
    Route::resource('admin/users', UserController::class);
});