<?php

namespace App\Http\Controllers\Api\ActivityLecturer;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckPresenceController extends Controller
{
    public function checkPresenceEdit(Request $request)
    {
        $request->validate([
            'presensis_id' => 'required|integer',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
        ]);

        $presensi = Presensi::find($request->presensis_id);

        if (!$presensi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Presensi tidak ditemukan',
            ], 404);
        }

        $conflict = Presensi::where('prodi_id', $presensi->prodi_id)
            ->where('semester', $presensi->semester)
            ->where('tahun_ajaran_id', $presensi->tahun_ajaran_id)
            ->where('tgl_presensi', $presensi->tgl_presensi)
            ->where('id', '!=', $presensi->id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_awal', '<', $request->jam_akhir)
                        ->where('jam_akhir', '>', $request->jam_awal);
                })->orWhere(function ($q) use ($request) {
                    $q->where('jam_awal', '<', $request->jam_awal)
                        ->where('jam_akhir', '>', $request->jam_awal);
                });
            })->first();

        if ($conflict) {
            return response()->json([
                'status' => 'conflict',
                'message' => 'Data presensi bentrok',
                'data' => [
                    'tanggal_presensi' => $conflict->tgl_presensi,
                    'durasi_presensi' => Carbon::parse($conflict->jam_awal)->format('H:i') . ' - ' . Carbon::parse($conflict->jam_akhir)->format('H:i'),
                ]
            ], 409);
        }

        return response()->json([
            'status' => 'no_conflict',
            'message' => 'Tidak terjadi konflik data',
        ], 200);

    }
    public function checkPresenceUpload(Request $request)
    {
        $request->validate([
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'tgl_presensi' => 'required|date',
            'prodi_id' => 'required|integer',
            'semester' => 'required|integer',
        ]);

        $conflict = Presensi::where('prodi_id', $request->prodi_id)
            ->where('semester', $request->semester)
            ->where('tgl_presensi', $request->tgl_presensi)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_awal', '<', $request->jam_akhir)
                        ->where('jam_akhir', '>', $request->jam_awal);
                })->orWhere(function ($q) use ($request) {
                    $q->where('jam_awal', '<', $request->jam_awal)
                        ->where('jam_akhir', '>', $request->jam_awal);
                });
            })->first();

        if ($conflict) {
            return response()->json([
                'status' => 'conflict',
                'message' => 'Data presensi bentrok',
                'data' => [
                    'tanggal_presensi' => $conflict->tgl_presensi,
                    'durasi_presensi' => Carbon::parse($conflict->jam_awal)->format('H:i') . ' - ' . Carbon::parse($conflict->jam_akhir)->format('H:i'),
                ]
            ], 409);
        }

        return response()->json([
            'status' => 'no_conflict',
            'message' => 'Tidak terjadi konflik data',
        ], 200);
    }
}
