<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\VideoReactionController;
use App\Http\Controllers\CommentReactionController;
use App\Http\Controllers\ReplyReactionController;
use App\Http\Controllers\SubscriptionController;

Route::middleware([\App\Http\Middleware\Authenticate::class])->group(function () {

    Route::get('/subscribe/{subscribedtoid}', [SubscriptionController::class, 'create'])->name('subscription.create');

    Route::get('/user/{id}/settings', [UserController::class, 'settings'])->name('users.settings');

    Route::put('/user/update', [UserController::class, 'update'])->name('users.update');

    Route::put('/user/security', [UserController::class, 'security'])->name('users.security');

    Route::get('/subscriptions', [VideoController::class, 'subscriptions'])->name('videos.subscriptions');

    Route::get('/my-videos', [VideoController::class, 'mine'])->name('videos.mine');

    Route::get('/liked-videos', [VideoController::class, 'liked'])->name('videos.liked');

    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');

    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');

    Route::get('/videos/{id}/edit', [VideoController::class, 'edit'])->name('videos.edit');

    Route::put('/videos/{id}', [VideoController::class, 'update'])->name('videos.update');

    Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.delete');

    Route::get('/like/{videoId}', [VideoReactionController::class, 'like'])->name('videoreaction.like');

    Route::get('/dislike/{videoId}', [VideoReactionController::class, 'dislike'])->name('videoreaction.dislike');

    Route::post('/comments/create/{videoid}', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/comment/like/{commentid}/{videoid}', [CommentReactionController::class, 'like'])->name('commentreaction.like');

    Route::get('/comment/dislike/{commentid}/{videoid}', [CommentReactionController::class, 'dislike'])->name('commentreaction.dislike');

    Route::post('/replies/create/{commentid}/{videoid}', [ReplyController::class, 'store'])->name('replies.store');

    Route::get('/reply/like/{replyid}/{videoid}', [ReplyReactionController::class, 'like'])->name('replyreaction.like');

    Route::get('/reply/dislike/{replyid}/{videoid}', [ReplyReactionController::class, 'dislike'])->name('replyreaction.dislike');
});

Route::get('/user/{id}/videos', [UserController::class, 'videos'])->name('users.videos');

Route::get('/user/{id}/about', [UserController::class, 'about'])->name('users.about');

Route::get('/', [VideoController::class, 'index'])->name('home');

Route::get('/trending', [VideoController::class, 'trending'])->name('videos.trending');

Route::get('/search/{query?}', [VideoController::class, 'search'])->name('videos.search');

Route::get('/video/{id}', [VideoController::class, 'show'])->name('videos.show');

Auth::routes();