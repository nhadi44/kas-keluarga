<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\VerifyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login.index');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process')->middleware('throttle.custom:3,1');
Route::get('/register', [AuthController::class, 'register'])->name('register.index');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.index');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password.index');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('/pemasukan')->group(function () {
        Route::get('/', [PemasukanController::class, 'index'])->name('pemasukan.index');
        Route::post('/get-data', [PemasukanController::class, 'getData'])->name('pemasukan.get-data');
        Route::post('/get-saldo-by-user-id', [PemasukanController::class, 'getSaldoByUserId'])->name('pemasukan.get-saldo-user-by-id');
        Route::post('/store', [PemasukanController::class, 'store'])->name('pemasukan.store');
        Route::post('/update', [PemasukanController::class, 'update'])->name('pemasukan.update');
        Route::post('/delete', [PemasukanController::class, 'delete'])->name('pemasukan.delete');
    });

    Route::prefix("/pengeluaran")->group(function () {
        Route::get('/', [PengeluaranController::class, "index"])->name("pengeluaran.index");

        Route::post('/get-data', [PengeluaranController::class, "getAll"])->name("pengeluaran.get-data");
        Route::post('/get-saldo-by-user-id', [PengeluaranController::class, "getSaldoByUserId"])->name("pengeluaran.get-saldo-by-user-id");
        Route::post('/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    });
});
