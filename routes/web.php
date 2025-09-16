<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/middleware-test', function () {
    return "Ти пройшов middleware ✅";
})->middleware('check.word');

