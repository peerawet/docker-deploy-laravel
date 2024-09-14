<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\Management;
use App\Http\Controllers\Authentication\Permission;
use App\Http\Middleware\CheckMenuAccess;

Route::prefix('users')->group(function () {
    Route::prefix('management')->middleware('auth')->middleware(CheckMenuAccess::class . ':12')->group(function () { //12คือid ของmenu จัดการผู้ใช้งาน
        Route::get('/index', [Management::class, 'index'])->name('users.management.index');
        Route::get('/create', [Management::class, 'create'])->name('users.management.create');
        Route::get('/edit/{userId}', [Management::class, 'editUserAccount'])->name('users.management.editUserAccount');
        Route::post('/delete-user/{userId}', [Management::class, 'deletePost'])->name('delete.post');
        Route::post('/register', [Management::class, 'registerPost'])->name('register.post');
        Route::post('/edit/{userId}', [Management::class, 'updateUserAccount'])->name('update.post');
    });

    Route::prefix('permission')->middleware('auth')->middleware(CheckMenuAccess::class . ':12')->group(function () {
        Route::get('/index', [Permission::class, 'index'])->name('users.permission.index');
        Route::get('/create', [Permission::class, 'create'])->name('users.permission.create');
        Route::get('/edit/{roleId}', [Permission::class, 'edit'])->name('users.permission.edit');
        Route::post('/delete-role/{roleId}', [Permission::class, 'delete'])->name('users.permission.delete');
        Route::post('/update-role/{roleId}', [Permission::class, 'editPost'])->name('users.permission.editPost');
        Route::post('/create', [Permission::class, 'createPost'])->name('users.permission.createPost');
    });
});
