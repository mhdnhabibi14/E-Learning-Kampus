<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/dosen/dashboard', [DosenDashboardController::class, 'index'])
        ->middleware('role:dosen')
        ->name('dosen.dashboard');

    Route::get('/mahasiswa/dashboard', [MahasiswaDashboardController::class, 'index'])
        ->middleware('role:mahasiswa')
        ->name('mahasiswa.dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('fakultas', FakultasController::class)->except(['create', 'edit', 'show'])->parameters(['fakultas' => 'fakultas']);
    });
});
