<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerReport\ManagerReport;

Route::prefix('manager-report')->middleware('auth')->group(function () {
    Route::get('/kba/{start?}/{end?}', [ManagerReport::class, 'kba'])->name('manager.kba');
    Route::get('/kbc/{start?}/{end?}', [ManagerReport::class, 'kbc'])->name('manager.kbc');
    Route::get('/full-report/{start?}/{end?}', [ManagerReport::class, 'fullReport'])->name('manager.full-report');
    Route::get('/expense-report/{start?}/{end?}', [ManagerReport::class, 'expenseReport'])->name('manager.expense-report');
});
