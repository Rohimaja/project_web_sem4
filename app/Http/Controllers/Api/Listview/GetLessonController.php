<?php

namespace App\Http\Controllers\Api\Listview;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetLessonController extends Controller
{
    public function getLessonStudent(Request $request)
    {
        // Validasi input
        $request->validate([
            'mahasiswa_id' => 'required|string'
        ]);

        $mahasiswaId = $request->get('mahasiswa_id');

        if (empty($mahasiswaId)) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Mahasiswa ID tidak boleh kosong'
            ], 404);
        }

        try {
            // Query untuk mengambil data jadwal hari ini menggunakan relasi model Anda
            $jadwalPresensi = Presensi::with([
                'matkul:id,nama_matkul,kode_matkul,durasi_matkul',
                'dosen:id,nama',
                'ruangan:id,nama_ruangan',
                'detailPresensi' => function ($query) use ($mahasiswaId) {
                    $query->where('mahasiswa_id', $mahasiswaId);
                }
            ])
                ->whereDate('tgl_presensi', Carbon::today())
                ->whereHas('detailPresensi', function ($query) use ($mahasiswaId) {
                    $query->where('mahasiswa_id', $mahasiswaId);
                })
                ->orderByRaw("STR_TO_DATE(CONCAT(DATE(tgl_presensi), ' ', jam_awal), '%Y-%m-%d %H:%i:%s')")
                ->get();

            if ($jadwalPresensi->isEmpty()) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Data matkul tidak ditemukan',
                    'data' => null
                ], 200);
            }

            // Format data response sesuai dengan response API native
            $data = $jadwalPresensi->map(function ($presensi) {
                $detailPresensi = $presensi->detailPresensi->first();

                // Format durasi presensi seperti di view native
                $jamAwal = Carbon::parse($presensi->jam_awal)->format('H:i');
                $jamAkhir = Carbon::parse($presensi->jam_akhir)->format('H:i');
                $durasiPresensi = $jamAwal . ' - ' . $jamAkhir;

                return [
                    'presensis_id' => $presensi->id,
                    'nama_matkul' => $presensi->matkul->nama_matkul ?? null,
                    'durasi_matkul' => $presensi->matkul->durasi_matkul ?? null,
                    'kode_matkul' => $presensi->matkul->kode_matkul ?? null,
                    'nama_ruangan' => $presensi->ruangan->nama_ruangan ?? null,
                    'durasi_presensi' => $durasiPresensi,
                    'presensi_id' => $presensi->presensi_id,
                    'link_zoom' => $presensi->link_zoom,
                    'tgl_presensi' => $presensi->tgl_presensi,
                    'nama_dosen' => $presensi->dosen->nama ?? null,
                ];
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data Jadwal Hari ini ditemukan',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
