<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Presensi;
use App\Models\Prodi;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $user = Auth::user()->dosen;
        $presensiHariIni = Presensi::with('prodi','dosen','matkul','tahunAjaran','ruangan')->whereDate('tgl_presensi', Carbon::today())->get();
        // Presensi::with('prodi','dosen','matkul','tahunAjaran','ruangan')->whereDate('tgl_presensi', Carbon::today())->get(),

        // $mahasiswa = Mahasiswa::count();
        // $dosen = Dosen::count();
        // $matkul = Matkul::count();
        // $prodi = Prodi::count();
        return view('dosen.dashboard',compact('title','user','presensiHariIni'));

    }
}
