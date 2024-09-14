<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Home\Home;


Route::get('/clc', function () {
    // Artisan::call('cache:clear');

    Artisan::call('config:clear');

    Artisan::call('config:cache');

    Artisan::call('view:clear');

    return "Cleared!";
});

Route::get('/', [Home::class, 'index'])->name('home')->middleware('auth');

// Route::get('generate-selected-pdf', [Home::class, 'index'])->name('home')->middleware('auth');

include __DIR__ . '/authentication.php';
include __DIR__ . '/route-drafts.php';
include __DIR__ . '/route-job.php';
include __DIR__ . '/route-invoice.php';
include __DIR__ . '/route-receipt.php';
include __DIR__ . '/route-users-management.php';
include __DIR__ . '/route-pdf.php';
include __DIR__ . '/route-masterFiles.php';
include __DIR__ . '/route-account-report.php';
include __DIR__ . '/route-manager-report.php';
include __DIR__ . '/route-expense.php';

// Register Livewire routes


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// All Route in this project
// require __DIR__ . '/auth.php'
