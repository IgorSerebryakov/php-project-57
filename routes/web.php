<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*  middleware(['auth', 'verified']) - добавляет обработчики auth и verified к маршруту.
 *  auth - только аутентифицированные пользователи могут получить доступ к маршруту. Если пользователь не вошёл
 *  в систему, он будет перенаправлен на страницу входа.
 *  verified - подтвердил ли пользователь свой адрес электронной почты. Ограничивает доступ к маршруту для пользователей,
 *  чья электронная почта не была подтверждена.
 */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
 *
 *
 */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
