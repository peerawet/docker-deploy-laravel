<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Receipt\ReceiptController;

Route::prefix('receipt')->middleware('auth')->group(function () {
    
        Route::get('/vat/index', [ReceiptController::class, 'vat'])->name('receipt.vat.index');
        Route::get('/no-vat/index', [ReceiptController::class, 'noVat'])->name('receipt.no-vat.index');
        Route::get('/create', [ReceiptController::class, 'create'])->name('receipt.vat.create');
        Route::post('/store/{id?}', [ReceiptController::class, 'store'])->name('receipt.store');
        Route::get('/get-draft/{invoice_no}', [ReceiptController::class, 'getDataByJobNo'])->name('get-data');
        Route::get('/edit/{receiptId}', [ReceiptController::class, 'edit'])->name('receipt.edit');
});
