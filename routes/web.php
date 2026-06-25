<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\KuotaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminDokumentasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\UserController;

// Redirect root to catalog
Route::get('/', function () {
    return redirect()->route('katalog.index');
});

// Public Catalog Route
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');

// Public Gallery Route (accessible without login)
Route::get('/user/galeri', [UserController::class, 'galeri'])->name('user.galeri');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Auth & Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Booking Management (Admin)
    Route::get('/booking', [AdminBookingController::class, 'index'])->name('admin.booking.index');
    Route::patch('/booking/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.booking.status');
    Route::delete('/booking/{id}', [AdminBookingController::class, 'destroy'])->name('admin.booking.destroy');

    // Kuota Management
    Route::get('/kuota', [KuotaController::class, 'index'])->name('admin.kuota.index');
    Route::post('/kuota', [KuotaController::class, 'store'])->name('admin.kuota.store');
    Route::post('/kuota/{tanggal}/sync', [KuotaController::class, 'sync'])->name('admin.kuota.sync');
    Route::delete('/kuota/{tanggal}', [KuotaController::class, 'destroy'])->name('admin.kuota.destroy');

    // Galeri Dokumentasi Management
    Route::get('/dokumentasi', [AdminDokumentasiController::class, 'index'])->name('admin.dokumentasi.index');
    Route::post('/dokumentasi', [AdminDokumentasiController::class, 'store'])->name('admin.dokumentasi.store');
    Route::delete('/dokumentasi/{id}', [AdminDokumentasiController::class, 'destroy'])->name('admin.dokumentasi.destroy');

    // Pembayaran Management (Midtrans Monitor)
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::post('/pembayaran/sync-all', [PembayaranController::class, 'syncAll'])->name('admin.pembayaran.syncAll');
    Route::post('/pembayaran/{id}/sync', [PembayaranController::class, 'sync'])->name('admin.pembayaran.sync');

    // Profile Settings
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting.index');
    Route::put('/setting/profile', [SettingController::class, 'updateProfile'])->name('admin.setting.profile');
    Route::put('/setting/password', [SettingController::class, 'updatePassword'])->name('admin.setting.password');
    Route::post('/setting/photo', [SettingController::class, 'updatePhoto'])->name('admin.setting.photo');
});

// Auth Routes (Semua user yang login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Booking Routes (Semua user yang sudah login bisa booking)
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/quota', [BookingController::class, 'getQuota'])->name('booking.quota');

    // User Pages (katalog_user)
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/booking', [UserController::class, 'booking'])->name('booking');
        Route::get('/profil', [UserController::class, 'profil'])->name('profil');
        Route::put('/profil', [UserController::class, 'updateProfil'])->name('profil.update');
        Route::put('/profil/password', [UserController::class, 'updatePassword'])->name('profil.password');
        Route::post('/profil/photo', [UserController::class, 'updatePhoto'])->name('profil.photo');
    });
});

