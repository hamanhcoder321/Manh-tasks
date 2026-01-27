<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

    Route::get('/user', [UserController::class, 'index'])
        ->name('user.index');

    /*

     Dashboard

    */
    Route::get('/', function () {
        $user = Auth::user(); // lấy user đã đăng nhập


        // đếm số lượng task, file, project của user
        $tasksCount = $user->tasks()->count();
        $filesCount = $user->files()->count();
        $projectsCount = $user->projects()->count();

        //Danh sách 5 task mới nhất của user để hiển thị trên dashboard.
        $recentTasks = $user->tasks()->latest()->take(5)->get();


        //Truyền 4 biến sang view: $tasksCount, $filesCount, $projectsCount, $recentTasks
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

    // tạo task mới cho project
    Route::post('projects/{project}/tasks', [TaskController::class, 'store'])
        ->name('projects.tasks.store');

    /*

     Tasks

    */
    
    // xem chi tiết task (nhiệm vụ) theo id bao gồm cả những người được giao task đó 
    Route::get('tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show');

    // cập nhật thông tin task
    Route::put('tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    // cập nhật trạng thái task not_started, in_progress, completed
    Route::post('tasks/{task}/update-status', [TaskController::class, 'updateStatus'])
        ->name('tasks.update-status');

    /*

     Files (Tệp)

    */
    // tạo sửa xoá file
    Route::resource('files', FileController::class);
});
