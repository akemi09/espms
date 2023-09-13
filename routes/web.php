<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MFOPAPController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Office;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('users', UserController::class);

    Route::get('offices', Office::class)->name('offices.index');

    Route::resource('mfo-pap', MFOPAPController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
