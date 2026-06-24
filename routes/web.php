<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PenghuniAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfilController;


Route::get('/', function () {
    return view('index');
});

Route::get('/daftar-kamar', [BookingController::class, 'index'])->name('daftarkamar');
Route::get('/detail-kamar/{id_kamar}', function ($id_kamar) {
    return view('detailKamar', ['id_kamar' => $id_kamar]);
});


Route::middleware('auth:penghuni')->group(function () {
    
    // Route untuk form pesanan (berdasarkan id kamar)
    Route::get('/form-pesanan/{id_kamar}', function ($id_kamar) {
        return view('formpesanan', ['id_kamar' => $id_kamar]);
    })->name('formpesanan');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    // Route untuk halaman riwayat sewa
    Route::get('/riwayat', [App\Http\Controllers\BookingController::class, 'riwayat'])->name('riwayat');

});


Route::middleware('guest:penghuni')->group(function () {
    Route::get('/register', [PenghuniAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [PenghuniAuthController::class, 'register']);

    Route::get('/login', [PenghuniAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [PenghuniAuthController::class, 'login']);
});

Route::middleware('auth:penghuni')->group(function () {
    Route::post('/logout', [PenghuniAuthController::class, 'logout'])->name('logout');
    // nanti rute "status sewa saya" bisa ditaruh di sini
});


Route::middleware('auth:penghuni')->group(function () {
    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');
});


