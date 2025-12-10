<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArsipController;
use App\Models\User;
use App\Models\Arsip; 
use Illuminate\Support\Facades\DB; 

// Arahkan root "/" ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// ================================
// 📁 ROUTE UNTUK DASHBOARD
// ================================
Route::get('/dashboard', function () {
    $users = User::all(); 
    $totalArsip = Arsip::count();
    $arsipDigital = Arsip::whereNotNull('file')->count();
    $arsipFisik = Arsip::whereNull('file')->count();
    $dataGrafikJenis = Arsip::select('jenis_arsip', DB::raw('count(*) as total'))
                            ->whereNotNull('jenis_arsip')
                            ->groupBy('jenis_arsip')
                            ->pluck('total', 'jenis_arsip');

    return view('dashboard', compact(
        'users', 
        'totalArsip', 
        'arsipDigital', 
        'arsipFisik',
        'dataGrafikJenis'
    ));
})->middleware(['auth'])->name('dashboard');

// ================================
// 📁 ROUTE UNTUK ARSIP (CRUD LENGKAP)
// ================================
Route::middleware(['auth'])->group(function () {
    
    // Create (Sudah ada)
    Route::get('/arsip/create', [ArsipController::class, 'create'])->name('arsip.create');
    Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsip.store');
    
    // Read (Daftar Data)
    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
    
    // Read (Pencarian)
    Route::get('/arsip/search', [ArsipController::class, 'search'])->name('arsip.search');

    // Update (Edit & Update)
    Route::get('/arsip/{arsip}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
    Route::put('/arsip/{arsip}', [ArsipController::class, 'update'])->name('arsip.update');

    // Delete
    Route::delete('/arsip/{arsip}', [ArsipController::class, 'destroy'])->name('arsip.destroy');

    // Download
    Route::get('/arsip/download/{id}', [ArsipController::class, 'downloadFile'])->name('arsip.download');

    // ================================
    // 📁 ROUTE UNTUK BACKUP (BARU)
    // ================================
    Route::get('/backup', [ArsipController::class, 'showBackupPage'])->name('backup.index');
    Route::post('/backup/database', [ArsipController::class, 'backupDatabase'])->name('backup.database');
    Route::post('/backup/files', [ArsipController::class, 'backupFiles'])->name('backup.files');
    Route::get('/backup/download/{filename}', [ArsipController::class, 'downloadBackup'])->name('backup.download');
});

