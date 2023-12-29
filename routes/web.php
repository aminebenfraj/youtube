<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\VideoReactionController;
use App\Http\Controllers\CommentReactionController;
use App\Http\Controllers\ReplyReactionController;

Route::get('/', [VideoController::class, 'index'])->name('home');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/register', [UserController::class, 'create'])->name('users.register');
Route::get('/login', [UserController::class, 'login'])->name('users.login');
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


Route::get('/like/{videoId}', [VideoReactionController::class, 'like'])->name('videoreaction.like');

Route::get('/dislike/{videoId}', [VideoReactionController::class, 'dislike'])->name('videoreaction.dislike');


Route::post('/comments/create/{videoid}', [CommentController::class, 'store'])->name('comments.store');

Route::get('/comment/like/{commentid}/{videoid}', [CommentReactionController::class, 'like'])->name('commentreaction.like');

Route::get('/comment/dislike/{commentid}/{videoid}', [CommentReactionController::class, 'dislike'])->name('commentreaction.dislike');

Route::post('/replies/create/{commentid}/{videoid}', [ReplyController::class, 'store'])->name('replies.store');

Route::get('/reply/like/{replyid}/{videoid}', [ReplyReactionController::class, 'like'])->name('replyreaction.like');

Route::get('/reply/dislike/{replyid}/{videoid}', [ReplyReactionController::class, 'dislike'])->name('replyreaction.dislike');
