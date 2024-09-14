<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterFiles\Depot;
use App\Http\Controllers\MasterFiles\Shipper;
use App\Http\Controllers\MasterFiles\Agent; // Added
use App\Http\Controllers\MasterFiles\GateInDepot;
use App\Http\Controllers\MasterFiles\ContainerType;
use App\Http\Controllers\MasterFiles\Sale;
use App\Http\Controllers\MasterFiles\Vessel;
use App\Http\Controllers\MasterFiles\Feeder; // Import the Feeder controller
use App\Http\Controllers\MasterFiles\DestinationPort;
use App\Http\Controllers\MasterFiles\TranshipmentPort;
use App\Http\Controllers\MasterFiles\LoadingPort;
use App\Http\Controllers\MasterFiles\DeliveryLocation;
use App\Http\Controllers\MasterFiles\LoadingLocation;
use App\Http\Controllers\MasterFiles\Description;
use App\Http\Controllers\MasterFiles\ReceiptDescription;
use App\Http\Controllers\MasterFiles\Bank;
use App\Http\Controllers\MasterFiles\Payee;
use App\Http\Controllers\MasterFiles\Category;
use App\Http\Controllers\MasterFiles\ExpenseDescription;

Route::prefix('master-files')->middleware('auth')->group(function () {


    Route::prefix('depot')->group(function () {
        Route::get('/index', [Depot::class, 'index'])->name('masterFiles.index.depot');
        Route::post('/delete/{id}', [Depot::class, 'deleteDepot'])->name('delete.depot');
        Route::post('/edit/{id}', [Depot::class, 'updateDepot'])->name('edit.depot');
        Route::post('/add', [Depot::class, 'addDepot'])->name('add.depot');
    });

    Route::prefix('shipper')->group(function () {
        Route::get('/index', [Shipper::class, 'index'])->name('masterFiles.index.shipper');
        Route::post('/delete/{id}', [Shipper::class, 'deleteShipper'])->name('delete.shipper');
        Route::post('/edit/{id}', [Shipper::class, 'updateShipper'])->name('edit.shipper');
        Route::post('/add', [Shipper::class, 'addShipper'])->name('add.shipper');
    });

    Route::prefix('agent')->group(function () { // Added
        Route::get('/index', [Agent::class, 'index'])->name('masterFiles.index.agent');
        Route::post('/delete/{id}', [Agent::class, 'deleteAgent'])->name('delete.agent'); // Added
        Route::post('/edit/{id}', [Agent::class, 'updateAgent'])->name('edit.agent'); // Added
        Route::post('/add', [Agent::class, 'addAgent'])->name('add.agent'); // Added
    }); // Added


    Route::prefix('gate-in-depot')->group(function () {
        Route::get('/index', [GateInDepot::class, 'index'])->name('masterFiles.index.gate-in-depot');
        Route::post('/delete/{id}', [GateInDepot::class, 'deleteGateInDepot'])->name('delete.gate-in-depot');
        Route::post('/edit/{id}', [GateInDepot::class, 'updateGateInDepot'])->name('edit.gate-in-depot');
        Route::post('/add', [GateInDepot::class, 'addGateInDepot'])->name('add.gate-in-depot');
    });

    Route::prefix('container-type')->group(function () {
        Route::get('/index', [ContainerType::class, 'index'])->name('masterFiles.index.container-type');
        Route::post('/delete/{id}', [ContainerType::class, 'deleteContainerType'])->name('delete.container-type');
        Route::post('/edit/{id}', [ContainerType::class, 'updateContainerType'])->name('edit.container-type');
        Route::post('/add', [ContainerType::class, 'addContainerType'])->name('add.container-type');
    });

    Route::prefix('sale')->group(function () {
        Route::get('/index', [Sale::class, 'index'])->name('masterFiles.index.sale');
        Route::post('/delete/{id}', [Sale::class, 'deleteSale'])->name('delete.sale');
        Route::post('/edit/{id}', [Sale::class, 'updateSale'])->name('edit.sale');
        Route::post('/add', [Sale::class, 'addSale'])->name('add.sale');
    });

    Route::prefix('vessel')->group(function () {
        Route::get('/index', [Vessel::class, 'index'])->name('masterFiles.index.vessel');
        Route::post('/delete/{id}', [Vessel::class, 'deleteVessel'])->name('delete.vessel');
        Route::post('/edit/{id}', [Vessel::class, 'updateVessel'])->name('edit.vessel');
        Route::post('/add', [Vessel::class, 'addVessel'])->name('add.vessel');
    });

    Route::prefix('feeder')->group(function () {
        Route::get('/index', [Feeder::class, 'index'])->name('masterFiles.index.feeder');
        Route::post('/delete/{id}', [Feeder::class, 'deleteFeeder'])->name('delete.feeder');
        Route::post('/edit/{id}', [Feeder::class, 'updateFeeder'])->name('edit.feeder');
        Route::post('/add', [Feeder::class, 'addFeeder'])->name('add.feeder');
    });
    Route::prefix('destination-port')->group(function () {
        Route::get('/index', [DestinationPort::class, 'index'])->name('masterFiles.index.destination-port');
        Route::post('/delete/{id}', [DestinationPort::class, 'deleteDestinationPort'])->name('delete.destination-port');
        Route::post('/edit/{id}', [DestinationPort::class, 'updateDestinationPort'])->name('edit.destination-port');
        Route::post('/add', [DestinationPort::class, 'addDestinationPort'])->name('add.destination-port');
    });
    Route::prefix('transhipment-port')->group(function () {
        Route::get('/index', [TranshipmentPort::class, 'index'])->name('masterFiles.index.transhipment-port');
        Route::post('/delete/{id}', [TranshipmentPort::class, 'deleteTranshipmentPort'])->name('delete.transhipment-port');
        Route::post('/edit/{id}', [TranshipmentPort::class, 'updateTranshipmentPort'])->name('edit.transhipment-port');
        Route::post('/add', [TranshipmentPort::class, 'addTranshipmentPort'])->name('add.transhipment-port');
    });

    Route::prefix('loading-port')->group(function () {
        Route::get('/index', [LoadingPort::class, 'index'])->name('masterFiles.index.loading-port');
        Route::post('/delete/{id}', [LoadingPort::class, 'deleteLoadingPort'])->name('delete.loading-port');
        Route::post('/edit/{id}', [LoadingPort::class, 'updateLoadingPort'])->name('edit.loading-port');
        Route::post('/add', [LoadingPort::class, 'addLoadingPort'])->name('add.loading-port');
    });

    Route::prefix('loading-location')->group(function () {
        Route::get('/index', [LoadingLocation::class, 'index'])->name('masterFiles.index.loading-location');
        Route::post('/delete/{id}', [LoadingLocation::class, 'deleteLoadingLocation'])->name('delete.loading-location');
        Route::post('/edit/{id}', [LoadingLocation::class, 'updateLoadingLocation'])->name('edit.loading-location');
        Route::post('/add', [LoadingLocation::class, 'addLoadingLocation'])->name('add.loading-location');
    });

    Route::prefix('delivery-location')->group(function () {
        Route::get('/index', [DeliveryLocation::class, 'index'])->name('masterFiles.index.delivery-location');
        Route::post('/delete/{id}', [DeliveryLocation::class, 'deleteDeliveryLocation'])->name('delete.delivery-port');
        Route::post('/edit/{id}', [DeliveryLocation::class, 'updateDeliveryLocation'])->name('edit.delivery-port');
        Route::post('/add', [DeliveryLocation::class, 'addDeliveryLocation'])->name('add.delivery-port');
    });

    Route::prefix('description')->group(function () {
        Route::get('/index', [Description::class, 'index'])->name('masterFiles.index.description');
        Route::post('/delete/{id}', [Description::class, 'deleteDescription'])->name('delete.description');
        Route::post('/edit/{id}', [Description::class, 'updateDescription'])->name('edit.description');
        Route::post('/add', [Description::class, 'addDescription'])->name('add.description');
    });

    Route::prefix('receipt-description')->group(function () {
        Route::get('/index', [ReceiptDescription::class, 'index'])->name('masterFiles.index.receiptDescription');
        Route::post('/delete/{id}', [ReceiptDescription::class, 'deleteDescription'])->name('delete.receiptDescription');
        Route::post('/edit/{id}', [ReceiptDescription::class, 'updateDescription'])->name('edit.receiptDescription');
        Route::post('/add', [ReceiptDescription::class, 'addDescription'])->name('add.receiptDescription');
    });

    Route::prefix('bank')->group(function () {
        Route::get('/index', [Bank::class, 'index'])->name('masterFiles.index.bank');
        Route::post('/delete/{id}', [Bank::class, 'deleteBank'])->name('delete.bank');
        Route::post('/edit/{id}', [Bank::class, 'updateBank'])->name('edit.bank');
        Route::post('/add', [Bank::class, 'addBank'])->name('add.bank');
    });

    Route::prefix('payee')->group(function () {
        Route::get('/index', [Payee::class, 'index'])->name('masterFiles.index.payee');
        Route::post('/delete/{id}', [Payee::class, 'deletePayee'])->name('delete.payee');
        Route::post('/edit/{id}', [Payee::class, 'updatePayee'])->name('edit.payee');
        Route::post('/add', [Payee::class, 'addPayee'])->name('add.payee');
    });

    Route::prefix('category')->group(function () {
        Route::get('/index', [Category::class, 'index'])->name('masterFiles.index.category');
        Route::post('/delete/{id}', [Category::class, 'deleteCategory'])->name('delete.category');
        Route::post('/edit/{id}', [Category::class, 'updateCategory'])->name('edit.category');
        Route::post('/add', [Category::class, 'addCategory'])->name('add.category');
    });
    
    Route::prefix('expense-description')->group(function () {
        Route::get('/index', [ExpenseDescription::class, 'index'])->name('masterFiles.index.expense-description');
        Route::post('/add', [ExpenseDescription::class, 'addExpenseDescription'])->name('add.expense-description');
        Route::post('/edit/{id}', [ExpenseDescription::class, 'updateExpenseDescription'])->name('edit.expense-description');
        Route::post('/delete/{id}', [ExpenseDescription::class, 'deleteExpenseDescription'])->name('delete.expense-description');
    });
    
});
