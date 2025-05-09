<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\Auth\PasswordController;

// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
//     Route::resource('mahasiswa', MahasiswaController::class);
// });

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', fn () => view('admin.dashboard',['title'=> 'Dashboard', 'rute'=> 'admin -> Dashboard']))->name('dashboard');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('master-admin', AdminController::class);
    Route::post('/validate-field/admin', [AdminController::class, 'validateField'])->name('admin.validate.field.admin');

    Route::resource('master-dosen', DosenController::class);
    Route::get('/api/filter-data', [DosenController::class, 'filter']);
    Route::post('/validate-field/dosen', [DosenController::class, 'validateField'])->name('admin.validate.field.dosen');

    Route::resource('master-mahasiswa', MahasiswaController::class);
    Route::post('/validate-field/mahasiswa', [MahasiswaController::class, 'validateField'])->name('admin.validate.field.mahasiswa');

    Route::resource('master-tahun', TahunAjaranController::class);
    Route::post('/validate-field/tahun', [TahunAjaranController::class, 'validateField'])->name('admin.validate.field.tahun');

    Route::resource('master-prodi', ProdiController::class);
    Route::get('/api/prodi', [ProdiController::class, 'getList']);
    Route::post('/validate-field/prodi', [ProdiController::class, 'validateField'])->name('admin.validate.field.prodi');

    Route::resource('master-matkul', MatkulController::class);
    Route::post('/validate-field/matkul', [MatkulController::class, 'validateField'])->name('admin.validate.field.matkul');

    Route::resource('master-ruangan', RuanganController::class);
    Route::post('/validate-field/ruangan', [RuanganController::class, 'validateField'])->name('admin.validate.field.ruangan');

    Route::resource('presensi', PresensiController::class);
    Route::get('/presensi/info-presensi',function(){
        return view('admin.info-presensi',['title'=> 'Dashboard', 'rute'=> 'admin -> Dashboard']);
    })->name('info-presensi');

    Route::get('/laporan-mahasiswa', function () {
        return view('admin.laporan_absensi.lap_mahasiswa', ['title' => 'Laporan Mahasiswa']);
    })->name('laporan.mahasiswa');

    Route::get('/laporan-dosen', function () {
        return view('admin.laporan_absensi.lap_dosen', ['title' => 'Laporan Dosen']);
    })->name('laporan.dosen');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::put('/change-password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('/validate-field/change-password', [ProfileController::class, 'validateField'])->name('admin.validate.field.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



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
