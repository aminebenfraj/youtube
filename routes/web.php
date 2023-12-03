<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');

Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');

Route::get('/video/{id}', [VideoController::class, 'show'])->name('videos.show');

Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');

Route::get('/videos/{id}/edit', [VideoController::class, 'edit'])->name('videos.edit');
Route::put('/videos/{id}', [VideoController::class, 'update'])->name('videos.update');

Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');


Route::get('/', function () {
    return view('home');
});
