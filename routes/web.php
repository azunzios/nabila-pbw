<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublikasiController;

Route::get('/', function () {
    return view('welcome');
});

// Pastikan semua baris di bawah ini tertulis lengkap ke bawah:
Route::get('/publikasi', [PublikasiController::class, 'index'])->name('publikasi.index');
Route::get('/publikasi/create', [PublikasiController::class, 'create'])->name('publikasi.create');
Route::post('/publikasi', [PublikasiController::class, 'store'])->name('publikasi.store');
Route::get('/publikasi/{id}/edit', [PublikasiController::class, 'edit'])->name('publikasi.edit');
Route::put('/publikasi/{id}', [PublikasiController::class, 'update'])->name('publikasi.update');
Route::delete('/publikasi/{id}', [PublikasiController::class, 'destroy'])->name('publikasi.destroy');
