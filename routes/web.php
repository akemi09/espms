<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('users', UserController::class);


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
