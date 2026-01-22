<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*

 Auth routes

*/
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

/*

 Protected routes

*/
Route::middleware(['auth'])->group(function () {

    /*

     Dashboard

    */
    Route::get('/', function () {
        $user = Auth::user();

        $tasksCount = $user->tasks()->count();
        $filesCount = $user->files()->count();
        $projectsCount = $user->projects()->count();

        $recentTasks = $user->tasks()->latest()->take(5)->get();

        return view('dashboard', compact(
            'tasksCount',
            'filesCount',
            'projectsCount',
            'recentTasks'
        ));
    })->name('dashboard');

    /*

     Projects

    */
    Route::resource('projects', ProjectController::class);

    // Thêm thành viên vào project
    Route::post('project/team', [ProjectController::class, 'addMember'])
        ->name('projects.addMember');

    // Danh sách & tạo task theo project
    Route::get('projects/{project}/tasks', [TaskController::class, 'index'])
        ->name('projects.tasks.index');

    Route::post('projects/{project}/tasks', [TaskController::class, 'store'])
        ->name('projects.tasks.store');

    /*

     Tasks

    */
    Route::get('tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show');

    Route::put('tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::post('tasks/{task}/update-status', [TaskController::class, 'updateStatus'])
        ->name('tasks.update-status');

    /*

     Files (Tệp)

    */
    Route::resource('files', FileController::class);
});
