<?php

use App\Http\Controllers\TaskManagementController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    
    Route::redirect('/', '/task');

    Route::resource('task', TaskManagementController::class);

    Route::post('task-priority-reorder', [TaskManagementController::class, 'reOrderPriority'])->name('task-priority-reorder');

});

