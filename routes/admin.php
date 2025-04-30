<?php

use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\MatkulController;

// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
//     Route::resource('mahasiswa', MahasiswaController::class);
// });

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', fn () => view('admin.dashboard',['title'=> 'Dashboard', 'rute'=> 'admin -> Dashboard']))->name('dashboard');
    Route::resource('master-admin', AdminController::class);
    Route::resource('master-dosen', DosenController::class);
    Route::resource('master-mahasiswa', MahasiswaController::class);
    Route::resource('master-tahun', TahunAjaranController::class);
    Route::resource('master-prodi', ProdiController::class);
    Route::resource('master-matkul', MatkulController::class);

    Route::get('/laporan-mahasiswa', function () {
        return view('admin.laporan_absensi.lap_mahasiswa', ['title' => 'Laporan Mahasiswa']);
    })->name('laporan.mahasiswa');

    Route::get('/laporan-dosen', function () {
        return view('admin.laporan_absensi.lap_dosen', ['title' => 'Laporan Dosen']);
    })->name('laporan.dosen');

    // routes/web.php
// Route::get('/api-wilayah/{jenis}/{id?}', function ($jenis, $id = null) {
//     $base = 'https://emsifa.github.io/api-wilayah-indonesia/api/';
//     $url = match ($jenis) {
//         'provinces' => $base . 'provinces.json',
//         'regencies' => $base . "regencies/{$id}.json",
//         'districts' => $base . "districts/{$id}.json",
//         'villages' => $base . "villages/{$id}.json",
//         default => abort(404),
//     };

//     $response = Http::get($url);

//     return response()->json($response->json());
// });

    // Route::get('/laporan', function () {
    //     return view('admin.laporan_absensi.lap_dosen');
    // })->name('laporan.dosen');
    // Route::get('/master-admin', [AdminController::class, 'index'])->name('master.index');

    // Route::resource('dosen', DosenController::class);
    // Route::resource('matkul', MatkulController::class);
});
