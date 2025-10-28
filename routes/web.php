<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'index'])->name('home');


Route::resource('posts', PostController::class);


Route::resource('categories', CategoryController::class)->only(['index', 'show']);


Route::resource('tags', TagController::class)->only(['index', 'show']);


Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{post}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
