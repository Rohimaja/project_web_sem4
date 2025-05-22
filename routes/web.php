<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KalenderAkademikController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    $role = auth()->user()->role;

    return match($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'dosen' => redirect()->route('dosen.dashboard'),
        'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
        default => abort(403),
    };
});

// Route Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard', [
            'title' => 'Dashboard',
            'rute' => 'mahasiswa -> Dashboard'
        ]);
    })->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/presensi', function () {
        return view('mahasiswa.presensi', [
            'title' => 'Presensi',
            'rute' => 'mahasiswa -> Presensi'
        ]);
    })->name('mahasiswa.presensi');

    Route::get('/mahasiswa/jadwal', function () {
        return view('mahasiswa.jadwal', [
            'title' => 'Jadwal',
            'rute' => 'mahasiswa -> Jadwal'
        ]);
    })->name('mahasiswa.jadwal');

    Route::get('/mahasiswa/rekap', function () {
        return view('mahasiswa.rekap_mahasiswa', [
            'title' => 'Rekap Mahasiswa',
            'rute' => 'mahasiswa -> Rekap Mahasiswa'
        ]);
    })->name('mahasiswa.rekap');
});


// Route::middleware('auth')->get('/dashboard', function () {
//     if (auth('admin')->check()) return redirect()->route('admin.dashboard');
//     if (auth('dosen')->check()) return redirect()->route('dosen.dashboard');
//     if (auth('mahasiswa')->check()) return redirect()->route('mahasiswa.dashboard');
//     abort(403);
// });
// Route::middleware('auth')->group(function () {


// Route::get('/dashboard', function () {
//     return view('admin.dashboard',['title'=> 'Dashboard', 'rute'=> 'admin -> Dashboard']);
// })->middleware(['auth', 'role:admin'])->name('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'));

// Route::get('/dashboard', fn () => redirect()->route('dosen.dashboard'));

// Route::get('/dosen/dashboard', function () {
//     return view('dosen.dashboard',['title'=> 'Dashboard', 'rute'=> 'dosen -> Dashboard']);
// })->middleware(['auth', 'role:dosen'])->name('dosen.dashboard');

// Route::get('/mahasiswa/dashboard', function () {
//     return view('mahasiswa.dashboard', ['title'=>'Dashboard', 'rute' =>'mahasiswa -> Dashboard']);
// })->middleware(['auth', 'role:mahasiswa'])->name('mahasiswa.dashboard');

Route::get('/getMatkulByProdi', [PresensiController::class, 'getMatkulByProdi']);
Route::get('/kalender-akademik', [KalenderAkademikController::class, 'viewCalendar'])->name('kalender-akademik.view');



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// routes/web.php
// Route::get('/api-wilayah/{jenis}/{id?}', function ($jenis, $id = null) {
//     // $base = 'https://wilayah.id/api/';
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

// Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
//     Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
//     Route::get('/presensi',[DashboardController::class,'index'])->name('presensi');
//   });


Route::get('/wilayah/{type}/{id?}', function ($type, $id = null) {
    return match ($type) {
        'provinces' => \App\Models\Province::select('id', 'name')->get(),
        'regencies' => \App\Models\Regency::where('province_id', $id)->select('id', 'name')->get(),
        'districts' => \App\Models\District::where('regency_id', $id)->select('id', 'name')->get(),
        'villages' => \App\Models\Village::where('district_id', $id)->select('id', 'name')->get(),
        default => abort(404),
    };
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/dosen.php';
