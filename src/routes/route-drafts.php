<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Drafts\Drafts;


Route::prefix('drafts')->middleware('auth')->group(function () {
        Route::get('/index', [Drafts::class, 'index'])->name('drafts.index');

        Route::get('/create/{draftId?}', [Drafts::class, 'create'])->name('drafts.create');


        Route::get('/create-clone/{draftId}', [Drafts::class, 'createClone'])->name('drafts.createClone');


        Route::get('/incident/{draftId?}', [Drafts::class, 'accident_report'])->name('drafts.report.accident');
        Route::post('/incident/{draftId?}', [Drafts::class, 'accidentReportPost'])->name('drafts.report.accident.post'); // Post action

        Route::get('/truck-waybill/index', [Drafts::class, 'truck_waybill_index'])->name('drafts.truckWaybill.index');
        Route::get('/truck-waybill/{id?}', [Drafts::class, 'truck_waybill'])->name('drafts.truckWaybill');
        Route::post('/truck-waybill/post', [Drafts::class, 'truck_waybill_post'])->name('drafts.truckWaybill.post'); // Post action

        Route::post('/store/{draftId?}', [Drafts::class, 'draftPost'])->name('drafts.post');

        Route::post('/delete-draft/{draftId}', [Drafts::class, 'draftDeletePost'])->name('drafts.deletePost');
        Route::post('/delete-selected-drafts', [Drafts::class, 'deleteSelectedDrafts'])->name('drafts.deleteSelected');
        Route::get('/print/{draftId}', [Drafts::class, 'print'])->name('drafts.print');
        Route::get('/edit/{draftId}', [Drafts::class, 'edit'])->name('drafts.edit');

        // Add the route for updating a draft
        // Route::post('/update-draft/{draftId}', [Drafts::class, 'updateDraft'])->name('drafts.update');
        // Corrected route declaration for check-booking
        Route::post('/check-booking', [Drafts::class, 'checkBooking'])->name('checkBooking');
        Route::post('/check-customer-ref', [Drafts::class, 'checkCustomerRef'])->name('checkCustomerRef');
});
