<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;

Route::get('/', [PollController::class,'welcom']);




Route::middleware(['auth'])->group(function () {
    Route::resource('polls', PollController::class);
    Route::post('polls/{poll}/vote', [VoteController::class, 'vote'])->name('polls.vote');
    Route::get("/polls_one",[PollController::class,'polls_one'])->name('polls_one');
    Route::get("/index",[PollController::class,'index'])->name('index');
    Route::get('/update/{id}',[PollController::class,'update'])->name('update');
    Route::get('/polls/{id}/results', [PollController::class, 'getPollResults'])->name('polls.results');

});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
