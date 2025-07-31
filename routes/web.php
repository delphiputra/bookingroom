<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\WaitingListController;
use App\Http\Controllers\AdminHomeController; 

// 🔹 Redirect root ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// 🔹 Login dan Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔹 Halaman home admin menggunakan controller agar bisa kirim data $bookings
Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');

// 🔹 Halaman home user
Route::get('/user', [UserHomeController::class, 'index'])->name('user.home');

// 🔹 Route user untuk lihat detail ruangan
Route::get('/user/ruangans/{id}', [UserHomeController::class, 'show'])->name('user.ruangans.show');

// 🔹 Route admin untuk kelola ruangan dan user
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ruangans', RuanganController::class);
    Route::resource('users', UserController::class);
    Route::get('home', [AdminHomeController::class, 'index'])->name('home'); 
});

// 🔹 Route user
Route::prefix('user')->name('user.')->group(function () {
    Route::resource('booking', BookingController::class);
    Route::get('/waitinglist', [WaitingListController::class, 'index'])->name('waitinglist.index');
});
