<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('landing-page');

Auth::routes();

Route::middleware(['admin'])->group(function () {
    Route::resource('slot', \App\Http\Controllers\SlotController::class);
});

Route::middleware(['customer'])->group(function () {
    Route::post('top-up', [\App\Http\Controllers\TopUpController::class, 'index'])->name('topup.index');

    Route::get('transaksis/{id}/control', [\App\Http\Controllers\TopUpController::class, 'control'])->name('transaksi.control');
    Route::post('transaksis/control/update', [\App\Http\Controllers\TopUpController::class, 'controlUpdate'])->name('control.update');

    Route::get('payments/finish', [\App\Http\Controllers\TopUpController::class, 'paymentFinish'])->name('payment.finish');
    Route::get('payments/unfinish', [\App\Http\Controllers\TopUpController::class, 'paymentUnfinish'])->name('payment.unfinish');
    Route::get('payments/error', [\App\Http\Controllers\TopUpController::class, 'paymentError'])->name('payment.error');
    Route::post('payments/cancel', [\App\Http\Controllers\TopUpController::class, 'paymentCancellation'])->name('payment.cancel');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
    Route::resource('transaksi', \App\Http\Controllers\TransaksiController::class);
    Route::resource('profil', \App\Http\Controllers\ProfilController::class);
    Route::resource('payments', \App\Http\Controllers\PaymentsController::class);
});
