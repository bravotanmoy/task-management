<?php

use App\Http\Controllers\TaskManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebAuthController;
use Illuminate\Support\Facades\Route;



Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['jwt'])->group(function () {
    
    Route::redirect('/', '/task');

    Route::resource('task', TaskManagementController::class);

    Route::post('task-priority-reorder', [TaskManagementController::class, 'reOrderPriority'])->name('task-priority-reorder');

    Route::post('logout', [WebAuthController::class, 'logout'])->name('logout');
});


    



