<?php
use Illuminate\Support\Facades\Route;

// PWA Offline fallback
Route::get('/offline', function () { return view('offline'); })->name('offline');
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ModulController;
use App\Http\Controllers\Frontend\KuisController;
use App\Http\Controllers\Frontend\SiswaDashboardController;
use App\Http\Controllers\Frontend\ProfilController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\KontenController as GuruKontenController;
use App\Http\Controllers\Guru\KuisController as GuruKuisController;
use App\Http\Controllers\Guru\SiswaController as GuruSiswaController;

// ROOT → langsung ke login
Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru'  => redirect()->route('guru.dashboard'),
            default => redirect()->route('siswa.dashboard'),
        };
    }
    return redirect()->route('login');
})->name('home');

// AUTH
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// LUPA SANDI
Route::get('/lupa-sandi',    [PasswordResetController::class, 'showForm'])->name('password.request');
Route::post('/lupa-sandi',   [PasswordResetController::class, 'findAccount'])->name('password.find');
Route::post('/reset-sandi',  [PasswordResetController::class, 'updatePassword'])->name('password.update.direct');

// MODUL & KUIS (bisa diakses tanpa login)
Route::get('/modul/{kategori}', [ModulController::class, 'show'])->name('modul.show');
Route::post('/modul/{kategori}/progress', [ModulController::class, 'updateProgress'])->name('modul.progress');
Route::get('/kuis', [KuisController::class, 'index'])->name('kuis.index');
Route::get('/kuis/soal/{level}', [KuisController::class, 'soal'])->name('kuis.soal');
Route::post('/kuis/simpan', [KuisController::class, 'simpan'])->name('kuis.simpan');

// SISWA DASHBOARD
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('siswa.profil');
});

// ADMIN (Kepala Sekolah) — HANYA dashboard & data perkembangan siswa (read-only).
// Tidak ada akses konten/soal kuis sama sekali — itu sepenuhnya tugas Guru.
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('siswa/{user}', [SiswaController::class, 'show'])->name('siswa.show');
});

// GURU — pemilik penuh konten & soal kuis (upload, edit, hapus), serta yang
// mengelola akun siswa (edit status & hapus akun siswa).
Route::prefix('guru')->name('guru.')->middleware(['auth','guru'])->group(function () {
    Route::get('/', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::resource('konten', GuruKontenController::class);
    Route::post('konten-sync', [GuruKontenController::class, 'sync'])->name('konten.sync');
    Route::resource('kuis', GuruKuisController::class);
    Route::get('siswa', [GuruSiswaController::class, 'index'])->name('siswa.index');
    Route::get('siswa/{user}', [GuruSiswaController::class, 'show'])->name('siswa.show');
    Route::delete('siswa/{user}', [GuruSiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::patch('siswa/{user}/toggle', [GuruSiswaController::class, 'toggleStatus'])->name('siswa.toggle');
});
