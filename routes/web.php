<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\KepalaGudangController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\ProfileController;

require __DIR__ . '/auth.php';

// =====================
// DEFAULT ROUTE
// =====================
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('home')
        : redirect()->route('login');
});


// =====================
// AUTH
// =====================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// =====================
// PROFILE (all roles)
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', fn() => view('profile.index'))->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});


// =====================
// SUPERADMIN (role:1)
// =====================
Route::middleware(['auth', 'role:1'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->controller(SuperadminController::class)
    ->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/request', 'requestIndex')->name('request.index');
        Route::get('/sparepart', [SuperadminController::class, 'sparepartIndex'])->name('sparepart.index');
        Route::get('/sparepart/{tiket_sparepart}/detail', [SuperadminController::class, 'showDetail'])->name('sparepart.detail');
        Route::get('/history', 'historyIndex')->name('history.index');
    });


// =====================
// KEPALA RO (role:2)
// =====================
Route::middleware(['auth', 'role:2'])
    ->prefix('kepalaro')
    ->name('kepalaro.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('kepalaro.dashboard'))->name('dashboard');
    });


// =====================
// KEPALA GUDANG (role:3)
// =====================
Route::middleware(['auth', 'role:3'])
    ->prefix('kepalagudang')
    ->name('kepalagudang.')
    ->controller(KepalaGudangController::class)
    ->group(function () {
        Route::get('/dashboard', fn() => view('kepalagudang.dashboard'))->name('dashboard');
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/request', 'requestIndex')->name('request.index');
        Route::post('/request/store', 'requestStore')->name('request.store');

        Route::post('/sparepart/store', [SparepartController::class, 'store'])->name('sparepart.store');
        Route::get('/sparepart', [SparepartController::class, 'index'])->name('sparepart.index');
        Route::get('/sparepart/{tiket_sparepart}/detail', [SparepartController::class, 'showDetail'])->name('sparepart.detail');

        Route::get('/history', 'historyIndex')->name('history.index');
        Route::get('/history/{id}', 'historyDetail')->name('history.detail');

        Route::get('/profile', fn() => view('kepalagudang.profile'))->name('profile');
    });



// =====================
// USER (role:4)
// =====================
Route::middleware(['auth', 'role:4'])
    ->prefix('user')
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });


// =====================
// AUTHENTICATED AREA (all roles)
// =====================
// Menu lain
Route::get('/jenisbarang', fn() => view('user.jenisbarang'))->name('jenis.barang');

// Request Barang
Route::prefix('requestbarang')->name('request.')->controller(PermintaanController::class)->group(function () {
    Route::get('/', 'index')->name('barang');
    Route::get('/{tiket}', 'getDetail');
    Route::post('/', 'store')->name('store');
});