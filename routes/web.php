<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);

Route::get('/news', [App\Http\Controllers\HomeController::class, 'news']);
Route::get('/news/{slug}', [App\Http\Controllers\HomeController::class, 'newsView']);
Route::get('/{slug}', [App\Http\Controllers\HomeController::class, 'page']);

