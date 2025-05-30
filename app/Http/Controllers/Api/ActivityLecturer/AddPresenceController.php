<?php

namespace App\Http\Controllers\Api\ActivityLecturer;

use App\Http\Controllers\Controller;
use App\Models\DetailPresensi;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Presensi;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class AddPresenceController extends Controller
{
    public function uploadPresence(Request $request)
    {
        $request->validate([
            'presensi_id' => 'required|string',
            'tgl_presensi' => 'required|date',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'dosen_id' => 'required|integer',
            'prodi_id' => 'required|integer',
            'semester' => 'required|integer',
            'matkul_id' => 'required|integer',
            'tahun_ajaran_id' => 'required|integer',
            'link_zoom' => 'required|string',
        ]);

        $presensi = Presensi::create([
            'presensi_id' => $request->presensi_id,
            'tgl_presensi' => $request->tgl_presensi,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'dosen_id' => $request->dosen_id,
            'prodi_id' => $request->prodi_id,
            'semester' => $request->semester,
            'matkul_id' => $request->matkul_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'link_zoom' => $request->link_zoom,
        ]);

        $mahasiswas = Mahasiswa::where('prodi_id', $request->prodi_id)
            ->where('semester', $request->semester)
            ->get();

        foreach ($mahasiswas as $mahasiswa) {
            DetailPresensi::create([
                'presensi_id' => $presensi->id,
                'mahasiswa_id' => $mahasiswa->id,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data presensi berhasil diunggah'
        ]);
    }
    public function showMajors(Request $request)
    {
        $prodis = Prodi::select('id', 'nama_prodi')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data prodi berhasil ditampilkan',
            'data' => $prodis
        ]);
    }
    public function showMatkuls(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|integer',
            'semester' => 'required|integer',
        ]);

        $matkuls = Matkul::where('prodi_id', $request->prodi_id)
            ->where('semester', $request->semester)
            ->select('id as id_matkul', 'kode_matkul', 'nama_matkul')
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data matkul berhasil ditampilkan',
            'data' => $matkuls
        ]);
    }
    public function showTahunAjarans(Request $request)
    {
        $tahunAjaran = TahunAjaran::where('status', 1)->select('id', 'tahun_awal', 'tahun_akhir', 'keterangan')->first();

        if ($tahunAjaran) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data tahun ajaran aktif berhasil ditampilkan',
                'data' => $tahunAjaran
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada tahun ajaran aktif yang ditampilkan'
            ]);
        }
    }
}
