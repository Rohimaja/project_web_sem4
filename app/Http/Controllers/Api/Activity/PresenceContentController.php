<?php

namespace App\Http\Controllers\Api\activity;

use App\Http\Controllers\Controller;
use App\Models\DetailPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PresenceContentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'presensi_id' => 'required|exists:presensis,id',
            'status' => 'required|in:1,2,3,4', // sesuaikan range status valid
            'waktu_presensi' => 'required|date',
            'alasan' => 'nullable|string|max:255',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5120', // max:5120 KB = 5 MB
        ]);

        // Persiapkan data untuk update
        $data = [
            'status' => $request->status,
            'alasan' => $request->alasan,
            'waktu_presensi' => $request->waktu_presensi,
        ];

        // Handle file upload jika ada
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = 'bukti-' . $request->mahasiswa_id . '-' . now()->format('Ymd') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/bukti
            $file->storeAs('bukti', $filename, 'public');

            // Simpan path relatif ke database
            $data['bukti'] = '/bukti/' . $filename;
        }

        // Jalankan update data
        $updated = DB::table('detail_presensis')
            ->where('presensi_id', $request->presensi_id)
            ->where('mahasiswa_id', $request->mahasiswa_id)
            ->update($data);

        // Respon berdasarkan hasil update
        if ($updated > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'Absensi berhasil',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan atau tidak ada perubahan',
            ], 404);
        }
    }
}
