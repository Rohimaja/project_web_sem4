<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DetailPresensi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Presensi;
use App\Models\Prodi;


use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
        'title' => 'Dashboard',
        'mahasiswa' => Mahasiswa::count(),
        'dosen' => Dosen::count(),
        'matkul' => Matkul::count(),
        'prodi' => Prodi::count(),
        'dosenMengajar' => Presensi::with('prodi','dosen','matkul','tahunAjaran','ruangan')->whereDate('tgl_presensi', Carbon::today())->get(),
        'mingguan' => [],
        ];

// Hitung data kehadiran mahasiswa per minggu berdasarkan status numerik
        $statusMap = [
            1 => 'Hadir',
            2 => 'Izin',
            3 => 'Sakit',
            0 => 'Alpha'
        ];

        $chartData = [];

        foreach ($statusMap as $statusValue => $statusLabel) {
            $minggu = [];

            for ($i = 1; $i <= 4; $i++) {
                $start = Carbon::now()->startOfMonth()->addWeeks($i - 1)->startOfWeek();
                $end = (clone $start)->endOfWeek();

                $count = DetailPresensi::where('status', $statusValue)
                    ->whereHas('presensi', function ($q) use ($start, $end) {
                        $q->whereBetween('tgl_presensi', [$start, $end]);
                    })
                    ->count();

                $minggu[] = $count;
            }

            $chartData[] = [
                'name' => $statusLabel,
                'data' => $minggu
            ];
        }

        $data['mingguan'] = $chartData;


        return view('admin.dashboard',$data);

    }
}
