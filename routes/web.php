<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['check.word'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/home/about', [HomeController::class, 'about']);
    Route::get('/home/services', [HomeController::class, 'services']);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/profile/settings', [ProfileController::class, 'settings']);
    Route::get('/profile/history', [ProfileController::class, 'history']);

    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/contact/feedback', [ContactController::class, 'feedback']);
    Route::get('/contact/support', [ContactController::class, 'support']);
});


Route::get('/echo', [App\Http\Controllers\ProfileController::class, 'echoJson']);
