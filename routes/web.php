<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('landing-page');

Auth::routes();

Route::middleware(['admin'])->group(function () {
    Route::resource('slot', SlotController::class);
});

Route::middleware(['customer'])->group(function () {
    Route::post('top-up', [TopUpController::class, 'index'])->name('topup.index');

    Route::get('transaksis/{id}/control', [TopUpController::class, 'control'])->name('transaksi.control');
    Route::post('transaksis/control/update', [TopUpController::class, 'controlUpdate'])->name('control.update');

    Route::get('pembayaran/finish', [TopUpController::class, 'paymentFinish'])->name('payment.finish');
    Route::get('pembayaran/unfinish', [TopUpController::class, 'paymentUnfinish'])->name('payment.unfinish');
    Route::get('pembayaran/error', [TopUpController::class, 'paymentError'])->name('payment.error');
    Route::post('pembayaran/cancel', [TopUpController::class, 'paymentCancellation'])->name('payment.cancel');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('profil', ProfilController::class)->except([
        'edit'
    ]);
    Route::resource('pembayaran', PaymentsController::class);

    Route::get('profile/edit', [HomeController::class, 'edit'])
        ->name('profil.edit');
});
