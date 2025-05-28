<?php

namespace App\Http\Controllers\Api\Listview;

use App\Http\Controllers\Controller;
use App\Models\DetailPresensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetLesson extends Controller
{
    public function getLessonStudent(Request $request)
    {
        $mahasiswaId = $request->query('mahasiswa_id');

        if (!$mahasiswaId) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Mahasiswa ID tidak boleh kosong'
            ], 404);
        }

        $today = Carbon::now()->toDateString();

        $presensis = DetailPresensi::with([
            'presensi.matkul',
            'presensi.ruangan',
            'presensi.dosen',
            'mahasiswa'
        ])
            ->where('mahasiswa_id', $mahasiswaId)
            ->whereHas('presensi', function ($query) use ($today) {
                $query->whereDate('tgl_presensi', $today);
            })
            ->orderByRaw("STR_TO_DATE(SUBSTRING_INDEX(CONCAT(jam_awal, ' - ', jam_akhir), ' - ', 1), '%H:%i')")
            ->get();

        if ($presensis->isEmpty()) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data matkul tidak ditemukan'
            ], 200);
        }

        $data = $presensis->map(function ($item) {
            return [
                'presensis_id' => $item->presensi->id,
                'presensi_id' => $item->presensi->presensi_id,
                'nama_matkul' => $item->presensi->matkul->nama_matkul ?? null,
                'durasi_matkul' => $item->presensi->matkul->durasi_matkul ?? null,
                'kode_matkul' => $item->presensi->matkul->kode_matkul ?? null,
                'nama_ruangan' => $item->presensi->ruangan->nama_ruangan ?? null,
                'durasi_presensi' => $item->presensi->jam_awal->format('H:i') . ' - ' . $item->presensi->jam_akhir->format('H:i'),
                'link_zoom' => $item->presensi->link_zoom,
                'tgl_presensi' => $item->presensi->tgl_presensi,
                'nama_dosen' => $item->presensi->dosen->nama ?? null,
                'status' => $item->status,
                'alasan' => $item->alasan,
                'waktu_presensi' => $item->waktu_presensi,
                'semester' => $item->mahasiswa->semester ?? null,
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data Jadwal Hari ini ditemukan',
            'data' => $data,
        ]);
    }
}
