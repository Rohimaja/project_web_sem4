<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Requests\Admin\StorePresensi;
use App\Models\DetailPresensi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Presensi';
        $mahasiswa = Auth::user()->mahasiswa;
        $biodata = Mahasiswa::findOrFail($mahasiswa->id);
        // $presensi = Presensi::with('dosen','prodi','ruangan','matkul','detailPresensi.mahasiswa')->whereDate('tgl_presensi', Carbon::today())->whereTime('jam_awal', Carbon::now())->whereHas('detailPresensi',function ($query) use ($mahasiswa){
        //     $query->where('mahasiswa_id',$mahasiswa->id);
        // })->get();
        // $presensi = Presensi::with('detailPresensi','mahasiswa')->where('mahasiswa_id',$mahasiswa->id)->where('presensi_id')->get();


        // $now = Carbon::now();
        // $start = $now->copy()->subMinutes(30); // 15 menit sebelum
        // $end = $now->copy()->addMinutes(15);   // 15 menit sesudah

        // $presensi = Presensi::with([
        //         'dosen',
        //         'prodi',
        //         'ruangan',
        //         'matkul',
        //         'detailPresensi.mahasiswa'
        //     ])
        //     ->whereDate('tgl_presensi', Carbon::today())
        //     ->whereTime('jam_awal', '>=', $start->format('H:i:s'))
        //     ->whereTime('jam_awal', '<=', $end->format('H:i:s'))
        //     ->whereHas('detailPresensi', function ($query) use ($mahasiswa) {
        //         $query->where('mahasiswa_id', $mahasiswa->id);
        //     })
        //     ->first();

        $now = Carbon::now();
        $start = $now->copy()->subMinutes(30); // rentang 30 menit sebelum sekarang
        $end = $now->copy()->addMinutes(30);   // rentang 30 menit sesudah sekarang

        $presensi = Presensi::with(['matkul', 'ruangan', 'detailPresensi' => function ($q) use ($mahasiswa) {
            $q->where('mahasiswa_id', $mahasiswa->id);
        }])
        ->whereDate('tgl_presensi', Carbon::today())
        ->whereTime('jam_awal', '<=', $now->format('H:i:s'))
        ->whereTime('jam_akhir', '>=', $now->format('H:i:s'))
        ->first();

        $presensiTercatat = optional($presensi?->detailPresensi->first())->waktu_presensi;

        $riwayat =  Presensi::with(['matkul','ruangan','detailPresensi' => function ($q) use ($mahasiswa){
            $q->where('mahasiswa_id', $mahasiswa->id);
        }])
        ->whereDate('tgl_presensi', '=', $now->toDateString()) // hari ini atau sebelumnya
        ->whereTime('jam_akhir', '<', $now->format('H:i:s'))     // pastikan sudah selesai
        ->whereHas('detailPresensi', function ($q) use ($mahasiswa) {
            $q->where('mahasiswa_id', $mahasiswa->id);
            // ->whereNotNull('waktu_presensi'); // hanya yang sudah presensi
        })
        ->orderByDesc('tgl_presensi')
        ->get();


        return view('mahasiswa.presensi', compact('presensi','title','biodata','presensiTercatat','riwayat'));
    }

    public function prosesPresensi(Request $request){
        $rfid = $request->input('rfid');

        $mahasiswa = Mahasiswa::where('rfid', $rfid)->first();
        if (!$mahasiswa) {
            return response()->json(['status'=>'error', 'message'=>'Mahasiswa Tidak ditemukan'], 404);
        }

        $presensi = DetailPresensi::where('id', $mahasiswa->id)->where('status',0)->whereHas('presensi', function ($query){
            $query->whereNull('link_zoom')->orWhere('link_zoom','');
        })->with('presensi')->first();

        if (!$presensi) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada presensi aktif'], 404);
        }

        $tglPresensi = $presensi->presensi->tgl_presensi;
        $jamAwal = $presensi->presensi->jam_awal;
        $jamAkhir = $presensi->presensi->jam_akhir;

        $timeMulai = Carbon::parse("$tglPresensi $jamAwal");
        $timeBerakhir = Carbon::parse("$tglPresensi $jamAkhir");
        $now = Carbon::now();

        if ($now->lt($timeMulai)) {
            return response()->json(['status' => 'error', 'message' => 'Absensi belum dimulai']);
        } elseif ($now->gt($timeBerakhir)) {
            return response()->json(['status' => 'error', 'message' => 'Absensi sudah kadaluarsa']);
        }

        $presensi->update([
            'status' => 1,
            'waktu_presensi' => now()
        ]);

        return response()->json(['status' => 'success', 'message' => 'Presensi berhasil']);

    }
}
