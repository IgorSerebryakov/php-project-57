<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuthenticated;
use App\Http\Controllers\LabelController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(CheckAuthenticated::class)->group(function () {
    Route::get('task_statuses/create', [TaskStatusController::class, 'create'])->name('task_statuses.create');
    Route::post('task_statuses', [TaskStatusController::class, 'store'])->name('task_statuses.store');
    Route::get('task_statuses/{id}', [TaskStatusController::class, 'show'])->name('task_statuses.show');
    Route::get('task_statuses/{id}/edit', [TaskStatusController::class, 'edit'])->name('task_statuses.edit');
    Route::patch('task_statuses/{id}', [TaskStatusController::class, 'update'])->name('task_statuses.update');
    Route::delete('task_statuses/{id}', [TaskStatusController::class, 'destroy'])->name('task_statuses.destroy');

    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('labels/create', [LabelController::class, 'create'])->name('labels.create');
    Route::post('labels', [LabelController::class, 'store'])->name('labels.store');
    Route::get('labels/{id}', [LabelController::class, 'show'])->name('labels.show');
    Route::get('labels/{id}/edit', [LabelController::class, 'edit'])->name('labels.edit');
    Route::patch('labels/{id}', [LabelController::class, 'update'])->name('labels.update');
    Route::delete('labels/{id}', [LabelController::class, 'destroy'])->name('labels.destroy');
});

require __DIR__.'/auth.php';

Route::get('task_statuses', [TaskStatusController::class, 'index'])
    ->name('task_statuses.index');

Route::get('tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::get('labels', [LabelController::class, 'index'])
    ->name('labels.index');
