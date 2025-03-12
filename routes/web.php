<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneratorController;

Route::get('/', [GeneratorController::class, 'home'])->name('home');

Route::post('/submit', [GeneratorController::class, 'submit'])->name('submit');
Route::get('/options', [GeneratorController::class, 'options'])->name('options');

Route::get('/previewCV', [GeneratorController::class, 'previewCV'])->name('previewCV');
Route::get('/downloadCV', [GeneratorController::class, 'downloadCV'])->name('downloadCV');
Route::get('/regenerateCV', [GeneratorController::class, 'regenerateCV'])->name('regenerateCV');

Route::get('/previewCL', [GeneratorController::class, 'previewCL'])->name('previewCL');
Route::get('/downloadCL', [GeneratorController::class, 'downloadCL'])->name('downloadCL');
Route::get('/regenerateCL', [GeneratorController::class, 'regenerateCL'])->name('regenerateCL');
