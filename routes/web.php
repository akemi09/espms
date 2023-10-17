<?php

use App\Livewire\User;
use App\Livewire\Office;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TargetAcknowledgementController;
use App\Livewire\Calendar;
use App\Livewire\Ipcr;
use App\Livewire\MfoPap;
use App\Livewire\MyTargets;
use App\Livewire\TargetApproval;
use App\Livewire\TargetApprovalView;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/users', User::class)->name('users.index');

    Route::get('/offices', Office::class)->name('offices.index');

    Route::get('/mfo-pap', MfoPap::class)->name('mfo-pap.index');

    Route::get('/calendar', Calendar::class)->name('calendar.index');

    Route::get('/targets', MyTargets::class)->name('my-targets.index');

    Route::get('/ipcr', Ipcr::class)->name('ipcr.index');

    Route::prefix('target-approvals')->group(function () {
        Route::get('/', TargetApproval::class)->name('target.approvals.index');
        Route::get('/view/{user}', TargetApprovalView::class)->name('target.approvals.show');
        Route::post('/acknowledge/{user}', [TargetAcknowledgementController::class, 'store'])->name('target.acknowledgement.store');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
