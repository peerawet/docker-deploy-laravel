<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountReport\AccountReport;

Route::prefix('account-report')->middleware('auth')->group(function () {
    Route::get('/jobs-without-invoice/{start?}/{end?}', [AccountReport::class, 'jobsWithoutInvoice'])->name('account.jobs-without-invoice');

    Route::get('/invoices-without-receipt/{start?}/{end?}', [AccountReport::class, 'invoiceWithoutReceipt'])->name('account.invoices-without-receipt');
    Route::get('/invoice-no-receipt/{start?}/{end?}', [AccountReport::class, 'invoiceNoReceipt'])->name('account.invoice-no-receipt');

    // Additional routes
    Route::get('/cancelled-jobs/{start?}/{end?}', [AccountReport::class, 'cancelledJobs'])->name('account.cancelled-jobs');
    Route::get('/summary-receipts-with-vat/{start?}/{end?}', [AccountReport::class, 'summaryReceiptsWithVAT'])->name('account.summary-receipts-with-vat');
    Route::get('/summary-receipts-without-vat/{start?}/{end?}', [AccountReport::class, 'summaryReceiptsWithoutVAT'])->name('account.summary-receipts-without-vat');
    Route::get('/receipt-issued-not-paid/{start?}/{end?}', [AccountReport::class, 'receiptIssuedNotPaid'])->name('account.receipt-issued-not-paid');
    Route::get('/summary-all-costs/{start?}/{end?}', [AccountReport::class, 'summaryAllCosts'])->name('account.summary-all-costs');
});
