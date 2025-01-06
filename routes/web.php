<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;

// Route to display the main page for authenticated users
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Registration routes
Route::get('/register', [AuthController::class, 'store'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register');

// Logout routes
Route::get('/logout', function () {Auth::logout(); return redirect('/login');})->name('logout');
Route::post('/logout', function () {Auth::logout(); return redirect('/login');})->name('logout');

// User route
Route::get('/user', [UserController::class, 'index']);

// Person routes
Route::get('/person/create', [PersonController::class, 'create'])->name('person.create');
Route::post('/person', [PersonController::class, 'store'])->name('person.store');
Route::get('/person/{id}/edit', [PersonController::class, 'edit'])->name('person.edit');
Route::delete('/person/{id}', [PersonController::class, 'destroy'])->name('person.destroy');

// Gift routes
Route::get('/gift/create', [GiftController::class, 'create'])->name('gift.create');
Route::post('/gift', [GiftController::class, 'store'])->name('gift.store');
Route::get('/gift/{id}/edit', [GiftController::class, 'edit'])->name('gift.edit');
Route::delete('/gift/{id}', [GiftController::class, 'destroy'])->name('gift.destroy');