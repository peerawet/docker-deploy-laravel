<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Authentication\Login;
use App\Http\Controllers\Authentication\Management;

Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/login', [Login::class, 'loginPost'])->name('login.post');
Route::get('/logout', [Login::class, 'logout'])->name('logout');
