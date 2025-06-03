<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StudySessionController;
use Illuminate\Support\Facades\Route;

//Plans
Route::middleware('auth')->group(function (){
    Route::resource('plans', PlanController::class)->except(['show', 'destroy']);
    Route::resource('sessions', StudySessionController::class)->except(['destroy']);

    Route::post('/sessions/{session}/start', [StudySessionController::class, 'start'])->name('sessions.start');
    // Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    // Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
    // // Route::get('/plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
    // Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    // Route::patch('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
    // Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');
    // Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
});

//Study sessions
//leaderboard
