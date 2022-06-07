<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('hello');
});

Route::get('/posts', function () {
    return view('posts.index');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');