<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\WelcomeController::class)->name('welcome');
Route::post('/import', \App\Http\Controllers\ImportController::class)->name('import');
