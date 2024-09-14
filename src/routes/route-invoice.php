<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Invoice\InvoiceController;

Route::prefix('invoice')->middleware('auth')->group(function () {

    Route::get('/index', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');

    Route::get('/get-draft/{job_no}/{invoice_no?}', [InvoiceController::class, 'getDraftByJobNo'])->name('get-draft');


    // POST route for creating invoices
    Route::post('/store/{id?}', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/edit/{invoiceId}', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::get('/print/{invoiceId}', [InvoiceController::class, 'print'])->name('invoice.print');
});
