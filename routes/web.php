<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Default route → arahkan ke home kalau login, kalau belum ke login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

// ================= LOGIN ================= //
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ================= AUTH AREA ================= //
Route::middleware(['auth'])->group(function () {
    // Home setelah login
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Menu lain
    Route::get('/jenisbarang', function () {
        return view('jenisbarang');
    })->name('jenis.barang');

    Route::get('/requestbarang', function () {
        return view('requestbarang');
    })->name('request.barang');
});
