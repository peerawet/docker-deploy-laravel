<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Job\Jobs;


Route::prefix('job')->middleware('auth')->group(function () {
    Route::get('/index', [Jobs::class, 'index'])->name('job.index');
    Route::get('/create', [Jobs::class, 'create'])->name('job.create');

    // Add route for fetching draft details
    Route::get('/get-draft-details/{id}', [Jobs::class, 'getDraftDetails'])->name('job.getDraftDetails');

    // Add your new route here
    Route::post('/store/{id?}', [Jobs::class, 'store'])->name('job.store');
    Route::post('/jobs/{id}', [Jobs::class, 'destroy'])->name('job.destroy');
    Route::post('/delete-selected', [Jobs::class, 'deleteSelected'])->name('job.deleteSelected');

    Route::get('/print/{jobId}', [Jobs::class, 'print'])->name('job.print');
    Route::get('/edit/{jobId}', [Jobs::class, 'edit'])->name('job.edit');

    
});
