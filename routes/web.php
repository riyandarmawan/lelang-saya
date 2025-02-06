<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'postLogin']);
Route::get('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/register', [AuthController::class, 'postRegister']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'petugas'])->group(function () {
    Route::get('/dashboard/barang', [BarangController::class, 'index']);
    Route::get('/dashboard/barang/create', [BarangController::class, 'create']);
    Route::post('/dashboard/barang/create', [BarangController::class, 'store']);
    Route::get('/dashboard/barang/update/{id}', [BarangController::class, 'update']);
    Route::post('/dashboard/barang/update/{id}', [BarangController::class, 'change']);
    Route::post('/dashboard/barang/delete/{id}', [BarangController::class, 'delete']);

    Route::get('/dashboard/lelang', [LelangController::class, 'index']);
    Route::get('/dashboard/lelang/create', [LelangController::class, 'create']);
    Route::post('/dashboard/lelang/create', [LelangController::class, 'store']);
    Route::get('/dashboard/lelang/update/{id}', [LelangController::class, 'update']);
    Route::post('/dashboard/lelang/update/{id}', [LelangController::class, 'change']);
    Route::post('/dashboard/lelang/delete/{id}', [LelangController::class, 'delete']);
});