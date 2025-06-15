<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\Admin\TanamanController;
use App\Http\Controllers\RekomendasiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\TanamanKatalogController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PlantIdentifierController;
use App\Http\Controllers\Admin\AdminDashboardController; // Pastikan baris ini ada
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AllLahanController;


Route::get('/', function () {
    return view('welcome');
});

// BAGIAN INI SUDAH BENAR, TIDAK PERLU DIUBAH LAGI UNTUK DASHBOARD USER
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return app(UserDashboardController::class)->index();
        }
    }
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rute untuk user biasa (mengelola lahan, chatbot, dan identifikasi)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('lahans', LahanController::class);
    Route::get('/rekomendasi/{lahan}', [RekomendasiController::class, 'show'])->name('rekomendasi.show');

    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/send-message', [ChatbotController::class, 'sendMessage'])->name('chatbot.sendMessage');

    // Rute untuk Identifikasi Tanaman (Sudah benar)
    Route::get('/identifikasi', [PlantIdentifierController::class, 'index'])->name('identifikasi.index');
    Route::post('/identifikasi', [PlantIdentifierController::class, 'identify'])->name('identifikasi.identify');
    // Rute untuk Riwayat Identifikasi Tanaman (Sudah benar)
    Route::get('/identifikasi/riwayat', [PlantIdentifierController::class, 'history'])->name('identifikasi.history');
    Route::get('/identifikasi/riwayat/{result}', [PlantIdentifierController::class, 'showHistory'])->name('identifikasi.history_detail');
    Route::delete('/identifikasi/riwayat/{result}', [PlantIdentifierController::class, 'deleteHistory'])->name('identifikasi.history_delete');
});



// Grup rute khusus untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // START: BAGIAN YANG DIUBAH (UNTUK DASHBOARD ADMIN)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); // <--- BARIS INI YANG DIUBAH
    // END: BAGIAN YANG DIUBAH

    // Rute untuk mengelola katalog tanaman oleh admin (Sudah benar)
    Route::resource('tanaman', TanamanController::class);
    // Rute untuk Manajemen Pengguna (Tambahkan ini)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Rute untuk Daftar Semua Lahan (Tambahkan ini)
    Route::get('/all-lahans', [AllLahanController::class, 'index'])->name('all_lahans.index');

});

// Rute untuk Katalog Tanaman (Akses Umum/User) - Sudah benar
Route::prefix('katalog-tanaman')->name('katalog.')->group(function () {
    Route::get('/', [TanamanKatalogController::class, 'index'])->name('index');
    Route::get('/{tanaman}', [TanamanKatalogController::class, 'show'])->name('show');
});


require __DIR__.'/auth.php';