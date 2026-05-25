<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['activeNav' => 'beranda']);
});

// Statistik — Kependudukan
Route::get('/statistik', function () {
    return view('statistik-tingkat-pendidikan', ['activeNav' => 'statistik', 'kategori' => 'kependudukan', 'subpage' => 'tingkat-pendidikan']);
});
Route::get('/statistik/total-penduduk', function () {
    return view('statistik-total-penduduk', ['activeNav' => 'statistik', 'kategori' => 'kependudukan', 'subpage' => 'total-penduduk']);
});
Route::get('/statistik/jumlah-kk', function () {
    return view('statistik-jumlah-kk', ['activeNav' => 'statistik', 'kategori' => 'kependudukan', 'subpage' => 'jumlah-kk']);
});
Route::get('/statistik/jenis-kelamin', function () {
    return view('statistik-jenis-kelamin', ['activeNav' => 'statistik', 'kategori' => 'kependudukan', 'subpage' => 'jenis-kelamin']);
});
Route::get('/statistik/pertumbuhan-penduduk', function () {
    return view('statistik-pertumbuhan-penduduk', ['activeNav' => 'statistik', 'kategori' => 'kependudukan', 'subpage' => 'pertumbuhan-penduduk']);
});
Route::get('/statistik/usia-produktif', function () {
    return view('statistik-usia-produktif', ['activeNav' => 'statistik', 'kategori' => 'kependudukan', 'subpage' => 'usia-produktif']);
});
Route::get('/statistik/status-perkawinan', function () {
    return view('statistik-status-perkawinan', ['activeNav' => 'statistik', 'kategori' => 'kependudukan', 'subpage' => 'status-perkawinan']);
});

// Statistik — Sarana & Prasarana
Route::get('/statistik/sarana-prasarana', function () {
    return view('statistik-fasilitas-kesehatan', ['activeNav' => 'statistik', 'kategori' => 'sarana', 'subpage' => 'fasilitas-kesehatan']);
});
Route::get('/statistik/sarana-prasarana/fasilitas-kesehatan', function () {
    return view('statistik-fasilitas-kesehatan', ['activeNav' => 'statistik', 'kategori' => 'sarana', 'subpage' => 'fasilitas-kesehatan']);
});
Route::get('/statistik/sarana-prasarana/fasilitas-pendidikan', function () {
    return view('statistik-fasilitas-pendidikan', ['activeNav' => 'statistik', 'kategori' => 'sarana', 'subpage' => 'fasilitas-pendidikan']);
});
Route::get('/statistik/sarana-prasarana/sarana-ibadah', function () {
    return view('statistik-sarana-ibadah', ['activeNav' => 'statistik', 'kategori' => 'sarana', 'subpage' => 'sarana-ibadah']);
});
Route::get('/statistik/sarana-prasarana/sarana-olahraga', function () {
    return view('statistik', ['activeNav' => 'statistik', 'kategori' => 'sarana', 'subpage' => 'sarana-olahraga']);
});
Route::get('/statistik/sarana-prasarana/infrastruktur-jalan', function () {
    return view('statistik', ['activeNav' => 'statistik', 'kategori' => 'sarana', 'subpage' => 'infrastruktur-jalan']);
});

// Statistik — Ekonomi
Route::get('/statistik/ekonomi', function () {
    return view('statistik-umkm', ['activeNav' => 'statistik', 'kategori' => 'ekonomi', 'subpage' => 'umkm']);
});
Route::get('/statistik/ekonomi/umkm', function () {
    return view('statistik-umkm', ['activeNav' => 'statistik', 'kategori' => 'ekonomi', 'subpage' => 'umkm']);
});
Route::get('/statistik/ekonomi/mata-pencaharian', function () {
    return view('statistik-mata-pencaharian', ['activeNav' => 'statistik', 'kategori' => 'ekonomi', 'subpage' => 'mata-pencaharian']);
});
Route::get('/statistik/ekonomi/pendapatan-desa', function () {
    return view('statistik-pendapatan-desa', ['activeNav' => 'statistik', 'kategori' => 'ekonomi', 'subpage' => 'pendapatan-desa']);
});
Route::get('/statistik/ekonomi/produksi-pertanian', function () {
    return view('statistik', ['activeNav' => 'statistik', 'kategori' => 'ekonomi', 'subpage' => 'produksi-pertanian']);
});
Route::get('/statistik/ekonomi/tingkat-kemiskinan', function () {
    return view('statistik', ['activeNav' => 'statistik', 'kategori' => 'ekonomi', 'subpage' => 'tingkat-kemiskinan']);
});

Route::get('/spasial', function () {
    return view('spasial', ['activeNav' => 'spasial']);
});

Route::get('/infografis', function () {
    return view('infografis', ['activeNav' => 'infografis']);
});

Route::get('/publikasi', function () {
    return view('publikasi', ['activeNav' => 'publikasi']);
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

