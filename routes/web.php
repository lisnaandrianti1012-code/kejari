<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome_landing');
});

// ROUTE UNTUK TV (Tanpa Login)
Route::get('/display', [DisplayController::class, 'index'])->name('display.index');
Route::post('/display/musik/upload', [DisplayController::class, 'uploadMusik'])->name('display.musik.upload');

// ROUTE AUTENTIKASI
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ROUTE UNTUK ADMIN (Butuh Login)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // CRUD PANGKAT
    Route::get('/kenaikan-pangkat', [AdminController::class, 'pangkat'])->name('admin.pangkat');
    Route::post('/kenaikan-pangkat', [AdminController::class, 'storePangkat'])->name('admin.pangkat.store');
    Route::put('/kenaikan-pangkat/{id}', [AdminController::class, 'updatePangkat'])->name('admin.pangkat.update');
    Route::delete('/kenaikan-pangkat/{id}', [AdminController::class, 'destroyPangkat'])->name('admin.pangkat.destroy');

    // CRUD GAJI
    Route::get('/kenaikan-gaji', [AdminController::class, 'gaji'])->name('admin.gaji');
    Route::post('/kenaikan-gaji', [AdminController::class, 'storeGaji'])->name('admin.gaji.store');
    Route::put('/kenaikan-gaji/{id}', [AdminController::class, 'updateGaji'])->name('admin.gaji.update');
    Route::delete('/kenaikan-gaji/{id}', [AdminController::class, 'destroyGaji'])->name('admin.gaji.destroy');

    // CRUD MAGANG
    Route::get('/magang', [AdminController::class, 'magang'])->name('admin.magang');
    Route::post('/magang', [AdminController::class, 'storeMagang'])->name('admin.magang.store');
    Route::put('/magang/{id}', [AdminController::class, 'updateMagang'])->name('admin.magang.update');
    Route::delete('/magang/{id}', [AdminController::class, 'destroyMagang'])->name('admin.magang.destroy');

    // KEHADIRAN (Sakit / Cuti / Dinas Luar Kota)
    Route::get('/kehadiran', [AdminController::class, 'kehadiran'])->name('admin.kehadiran');
    Route::post('/kehadiran', [AdminController::class, 'storeKehadiran'])->name('admin.kehadiran.store');
    Route::put('/kehadiran/{id}', [AdminController::class, 'updateKehadiran'])->name('admin.kehadiran.update');
    Route::delete('/kehadiran/{id}', [AdminController::class, 'destroyKehadiran'])->name('admin.kehadiran.destroy');

    // MUSIK BACKGROUND TV
    Route::get('/musik', [AdminController::class, 'musik'])->name('admin.musik');
    Route::post('/musik', [AdminController::class, 'storeMusik'])->name('admin.musik.store');
    Route::post('/musik/{id}/set-active', [AdminController::class, 'setActiveMusik'])->name('admin.musik.setActive');
    Route::delete('/musik/{id}', [AdminController::class, 'destroyMusik'])->name('admin.musik.destroy');

    Route::get('/rekapitulasi', [AdminController::class, 'rekapitulasi'])->name('admin.rekapitulasi');
    Route::get('/rekapitulasi/print/{jenis}', [AdminController::class, 'printRekap'])->name('admin.rekapitulasi.print');
});
