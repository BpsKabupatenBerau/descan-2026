<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\SpasialController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\PublikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes — DESCAN 2026
|--------------------------------------------------------------------------
*/

// ── Beranda ──────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ── Statistik ─────────────────────────────────────────────────────────────
Route::prefix('statistik')->name('statistik.')->group(function () {
    Route::get('/',              [StatistikController::class, 'index'])   ->name('index');
    Route::get('/{cat}',         [StatistikController::class, 'category'])->name('category');
    Route::get('/{cat}/{slug}',  [StatistikController::class, 'show'])    ->name('show');
});

// ── Spasial / Peta ────────────────────────────────────────────────────────
Route::prefix('spasial')->name('spasial.')->group(function () {
    Route::get('/', [SpasialController::class, 'index'])->name('index');
});

// ── Infografis ────────────────────────────────────────────────────────────
Route::prefix('infografis')->name('infografis.')->group(function () {
    Route::get('/',         [InfografisController::class, 'index'])->name('index');
    Route::get('/{slug}',   [InfografisController::class, 'show']) ->name('show');
});

// ── Publikasi ─────────────────────────────────────────────────────────────
Route::prefix('publikasi')->name('publikasi.')->group(function () {
    Route::get('/',                  [PublikasiController::class, 'index'])   ->name('index');
    Route::get('/{slug}/download',   [PublikasiController::class, 'download'])->name('download');
});
