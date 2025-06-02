<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\myProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard/dashboard', [myProfileController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
