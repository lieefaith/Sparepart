<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\SuperadminController;

Route::prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('dashboard', [SuperadminController::class, 'dashboard'])->name('dashboard');
    Route::get('request', [SuperadminController::class, 'requestIndex'])->name('request.index');
    Route::get('sparepart', [SuperadminController::class, 'sparepartIndex'])->name('sparepart.index');
    Route::get('history', [SuperadminController::class, 'historyIndex'])->name('history.index');
});


// Default route → arahkan ke home kalau login, kalau belum ke login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

// SUPERADMIN
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('dashboard');
});

// KEPALA RO
Route::prefix('kepalaro')->name('kepalaro.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('kepalaro.dashboard');
    })->name('dashboard');
});

// KEPALA GUDANG
Route::prefix('kepalagudang')->name('kepalagudang.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('kepalagudang.dashboard');
    })->name('dashboard');
});

// USER
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
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
        return view('request.jenisbarang');
    })->name('jenis.barang');

    Route::get('requestbarang', [PermintaanController::class, 'index'])->name('request.barang');
    Route::get('requestbarang/{tiket}', [PermintaanController::class, 'getDetail']);
    Route::post('/requestbarang', [PermintaanController::class, 'store'])->name('request.store');
});
