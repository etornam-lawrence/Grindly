<?php

use App\Http\Controllers\LoginMailController;
use App\Http\Controllers\StudySessionController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\StudyChartMailController;
use Illuminate\Support\Facades\Route;

//study sessions routes
Route::middleware('auth')->group(function (){
    Route::resource('sessions', StudySessionController::class)->except(['destroy']);
    Route::get('/chart/sessions', [StudySessionController::class, 'lineChart'])->name('session.chart');
 
});

Route::get('/mail/sessions', [StudyChartMailController::class, 'sendMail'])->name('chart.mail');

// Route::get('/login-mail', LoginMailController::class, 'loginMail')->name('mail.login');
//notes routes
Route::middleware('auth')->group(function (){
    Route::resource('/notes', NotesController::class)->except(['create','show']);
    Route::get('notes/{note}/{slug}', [NotesController::class, 'edit'])->name('notes.edit');
    Route::patch('notes/{note}/{slug}', [NotesController::class, 'update'])->name('notes.update');

});
