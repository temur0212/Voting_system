<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GitHubController;

Route::get('/', [PollController::class,'welcom']);


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('auth/github', [GitHubController::class, 'redirectToGitHub'])->name('auth.github');
Route::get('auth/github/callback', [GitHubController::class, 'handleGitHubCallback']);

Route::middleware(['auth'])->group(function () {
    Route::resource('polls', PollController::class);
    Route::post('polls/{poll}/vote', [VoteController::class, 'vote'])->name('polls.vote');
    Route::get("/polls_one",[PollController::class,'polls_one'])->name('polls_one');
    Route::get("/polls_all",[PollController::class,'polls_all'])->name('polls_all');
    Route::get("/index",[PollController::class,'index'])->name('index');
    Route::get('/update/{id}',[PollController::class,'update'])->name('update');
    Route::get('/polls/{id}/results', [PollController::class, 'getPollResults'])->name('polls.results');

});



Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
