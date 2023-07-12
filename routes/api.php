<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\URLShortnerController;

Route::post('/shorten', [URLShortnerController::class, 'shorten'])->name('shorten')->middleware('auth:sanctum');
Route::get('/visit/{id}', [URLShortnerController::class, 'visit'])->name('visit');
Route::group([
    'prefix' => 'users',
    'as' => 'users.',
    'controller' => UserController::class,
], function () {
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});