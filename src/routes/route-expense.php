<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Expense\ExpenseController;

Route::prefix('expense')->middleware('auth')->group(function () {
    Route::get('/index', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/create-update/{id?}', [ExpenseController::class, 'createUpdate'])->name('expense.create-update');
    Route::post('/store-update', [ExpenseController::class, 'expensePost'])->name('expense.store-update');

    // New delete route for expenses
    Route::post('/delete/{id}', [ExpenseController::class, 'delete'])->name('delete.expense');
});
