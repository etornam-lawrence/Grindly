<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth')->group(function (){
//     Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
//     Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
//     // Route::get('/plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
//     Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
//     Route::patch('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
//     Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');
//     Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
// });


require __DIR__.'/auth.php';
require __DIR__.'/app.php';

