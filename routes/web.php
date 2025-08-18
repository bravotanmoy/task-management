<?php

use App\Http\Controllers\TaskManagementController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/task');

Route::resource('task', TaskManagementController::class);

Route::post('task-priority-reorder', [TaskManagementController::class, 'reOrderPriority'])->name('task-priority-reorder');
