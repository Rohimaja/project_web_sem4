<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\DetailPresensi;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Presensi;
use App\Models\TahunAjaran;
use App\Services\RekapMahasiswaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function jadwal()
    {
        $title = "Jadwal Mahasiswa";
        $mahasiswa = Auth::user()->mahasiswa;
        $jadwal = Jadwal::with(['prodi','dosen','matkul','ruangan','detailJadwal' => function ($q) use ($mahasiswa){
            $q->where('mahasiswa_id', $mahasiswa->id);
        }])->orderBy('hari')->get();
        $tahun = TahunAjaran::orderBy('tahun_awal')->get();
        return view('mahasiswa.jadwal',compact('title','jadwal','tahun'));
    }

    public function rekap(Request $request, RekapMahasiswaService $service){
        $mahasiswa = Auth::user()->mahasiswa->id;
        $data['title'] = "Rekap Presensi";
        $data['tahun'] = TahunAjaran::orderBy('tahun_awal')->get();
        $hasil = $service->getRekap($mahasiswa);
        $data['rekap'] = $hasil['rekap'];
        $data['totalPertemuan'] = $hasil['totalPertemuan'];
        return view('mahasiswa.rekap_mahasiswa',$data);
    }

    public function exportPdf(Request $request, RekapMahasiswaService $service)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(403, 'Dosen tidak ditemukan atau tidak terhubung dengan akun.');
        }

        $rekapData = $service->getRekap($mahasiswa->id);

        $data = [
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'prodi' => $mahasiswa->prodi->jenjang . ' ' . $mahasiswa->prodi->nama_prodi,
            'semester' => 'Ganjil',
            'matkul' => '-',
            'rekap' => $rekapData['rekap'],
            'totalPertemuan' => $rekapData['totalPertemuan'],
        ];

        $pdf = Pdf::loadView('rekap.export.rekap-mahasiswa-pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->download('Rekap Kehadiran Mahasiswa.pdf');
    }

    public function exportExcel(Request $request, RekapMahasiswaService $service)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $rekapData = $service->getRekap($mahasiswa->id);

        $totalPertemuan = $rekapData['totalPertemuan'] ?? 16;

        $export = new class($mahasiswa, $rekapData, $totalPertemuan) implements FromView {

            protected $mahasiswa;
            protected $rekapData;
            protected $totalPertemuan;

            public function __construct($mahasiswa, $rekapData, $totalPertemuan)
            {
                $this->mahasiswa = $mahasiswa;
                $this->rekapData = $rekapData;
                $this->totalPertemuan = $totalPertemuan;
            }

            public function view(): View
            {
                return view('rekap.export.rekap-mahasiswa-excel', [
                    'nim' => $this->mahasiswa->nim,
                    'nama' => $this->mahasiswa->nama,
                    'prodi' => $this->mahasiswa->prodi->jenjang . ' ' . $this->mahasiswa->prodi->nama_prodi,
                    'semester' => 'Ganjil', // bisa kamu sesuaikan
                    'matkul' => '-',        // bisa kamu sesuaikan
                    'rekap' => $this->rekapData['rekap'],
                    'totalPertemuan' => $this->totalPertemuan,
                ]);
            }
        };

        return Excel::download($export, 'Rekap Kehadiran Mahasiswa.xlsx');
    }

    public function update(Request $request, string $id)
    {
        try {
            $dosen = $request->user()->dosen;

            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                    Storage::disk('public')->delete($dosen->foto);
                }

                // Simpan foto baru
                $filename = 'profile/dosen/profile_' . $dosen->id . '.' . $request->file('foto')->extension();
                $fotoPath = $request->file('foto')->storeAs('foto_dosen', $filename, 'public');
                $dosen->update(['foto' => $fotoPath]);
            }

            return redirect()->route('dosen.profile.edit')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Perbarui'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Perbarui Profile', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ]);
        }
    }

        public function updateProfil(Request $request)
    {
        try {
            $mahasiswa = $request->user()->mahasiswa;

            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                    Storage::disk('public')->delete($mahasiswa->foto);
                }

                // Simpan foto baru
                $filename = 'profile/mahasiswa/profile_' . $mahasiswa->id . '.' . $request->file('foto')->extension();
                $fotoPath = $request->file('foto')->storeAs('foto_mahasiswa', $filename, 'public');
                $mahasiswa->update(['foto' => $fotoPath]);
            }

            return redirect()->route('mahasiswa.dashboard')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Perbarui'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Perbarui Profile', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ]);
        }
    }

//     public function prosesPresensi(Request $request){
//         $rfid = $request->query('rfid');

//         $mahasiswa = Mahasiswa::where('rfid', strtoupper($rfid))->first();
//         if (!$mahasiswa) {
//             return response()->json(['status'=>'error', 'message'=>'Mahasiswa Tidak ditemukan'], 404);
//         }

//         $now = Carbon::now();


//             // $now = Carbon::now();

//             // $presensi = DetailPresensi::where('mahasiswa_id', $mahasiswa->id)
//             //     ->where('status', 0)
//             //     ->whereHas('presensi', function ($query) use ($now) {
//             //         $query->whereDate('tgl_presensi', $now->toDateString()) // presensi hari ini
//             //             ->whereTime('jam_awal', '<=', $now->format('H:i:s'))
//             //             ->whereTime('jam_akhir', '>=', $now->format('H:i:s'))
//             //             ->where(function ($q) {
//             //                 $q->whereNull('link_zoom')->orWhere('link_zoom', '');
//             //             });
//             //     })
//             //     ->with('presensi')
//             //     ->first();

//         // $presensi = DetailPresensi::where('mahasiswa_id', $mahasiswa->id)->where('status',0)->whereHas('presensi', function ($query){
//         //     $query->whereDate('tgl_presensi', Carbon::today())
//         //     ->whereTime('jam_awal', '<=', Carbon::now())
//         //     ->whereTime('jam_akhir','>=', Carbon::now())
//         //     ->where(function($q){
//         //         $q->whereNull('link_zoom')->orWhere('link_zoom','');
//         //     });
//         //     // ->whereNull('link_zoom')->where('tgl_presensi',Carbon::today());
//         // })->with('presensi')->first();

//         // $presensi = DetailPresensi::where('mahasiswa_id', $mahasiswa->id)->where('status', 0)
//         //         ->whereHas('presensi', function ($query) {
//         //             $query->where(function ($q) {
//         //                 $q->whereNull('link_zoom')->orWhere('link_zoom', '');
//         //             })->whereDate('tgl_presensi', Carbon::today());
//         //         });

//         $presensi = DetailPresensi::where('mahasiswa_id', $mahasiswa->id)->where('status',0)->whereHas('presensi', function ($query){
//                 $query->whereNull('link_zoom')->orWhere('link_zoom','');
//         })->with('presensi')->first();
//     // });




// //         $presensis = DetailPresensi::where('mahasiswa_id', $mahasiswa->id)
// //     ->where('status', 0)
// //     ->whereHas('presensi', function ($query) use ($now) {
// //         $query->whereDate('tgl_presensi', $now->toDateString())
// //               ->where(function ($q) {
// //                   $q->whereNull('link_zoom')->orWhere('link_zoom', '');
// //               });
// //     })
// //     ->with('presensi')
// //     ->get();

// // $presensi = $presensis->firstWhere(function ($dp) use ($now) {
// //     $jamAwal = Carbon::parse($dp->presensi->tgl_presensi . ' ' . $dp->presensi->jam_awal);
// //     $jamAkhir = Carbon::parse($dp->presensi->tgl_presensi . ' ' . $dp->presensi->jam_akhir);
// //     return $now->between($jamAwal, $jamAkhir);
// // });







//         if (!$presensi) {
//             return response()->json(['status' => 'error', 'message' => 'Tidak ada presensi aktif'], 404);
//         }

//         $tglPresensi = $presensi->presensi->tgl_presensi;
//         $jamAwal = $presensi->presensi->jam_awal;
//         $jamAkhir = $presensi->presensi->jam_akhir;

//         $timeMulai = Carbon::parse("$tglPresensi $jamAwal");
//         $timeBerakhir = Carbon::parse("$tglPresensi $jamAkhir");
//         $now = Carbon::now();
//         // $now = now();

//                return response()->json([
//             'tgl_presensi' => $tglPresensi,
//             'jam_awal' => $jamAwal,
//             'jam_akhir' => $jamAkhir,
//             'time_mulai' => $timeMulai,
//             'time_berakhir' => $timeBerakhir,
//             'now' => $now,
//         ]);

//         if ($now->lt($timeMulai)) {
//             return response()->json(['status' => 'error', 'message' => 'Absensi belum dimulai']);
//         } elseif ($now->gt($timeBerakhir)) {
//             return response()->json(['status' => 'error', 'message' => 'Absensi sudah kadaluarsa']);
//         }

//         // $presensi->update([
//         //     'status' => 1,
//         //     'waktu_presensi' => Carbon::now(),
//         // ]);



//         // return response()->json(['status' => 'success', 'message' => 'Presensi berhasil']);

//     }







    public function prosesPresensi(Request $request){
        $rfid = strtoupper($request->query('rfid'));
        $mahasiswa = Mahasiswa::where('rfid', $rfid)->first();

        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $now = Carbon::now();

        try {
            // 1. Ambil presensi aktif berdasarkan waktu dan link_zoom
            $presensi = Presensi::whereDate('tgl_presensi', Carbon::today())
                ->where(function ($q) {
                    $q->whereNull('link_zoom')->orWhere('link_zoom','');
                })
                ->whereTime('jam_awal', '<=', $now)
                ->whereTime('jam_akhir', '>=', $now)
                ->first();

            if (!$presensi) {
                return response()->json(['status' => 'error', 'message' => 'Tidak ada presensi aktif saat ini'], 404);
            }

            $tglPresensi = $presensi->tgl_presensi;
            $jamAwal = $presensi->jam_awal;
            $jamAkhir = $presensi->jam_akhir;

            $timeMulai = Carbon::parse("$tglPresensi $jamAwal");
            $timeBerakhir = Carbon::parse("$tglPresensi $jamAkhir");

            if ($now->lt($timeMulai)) {
                return response()->json(['status' => 'error', 'message' => 'Absensi belum dimulai']);
            } elseif ($now->gt($timeBerakhir)) {
                return response()->json(['status' => 'error', 'message' => 'Absensi sudah kadaluarsa']);
            }

            DetailPresensi::where('mahasiswa_id', $mahasiswa->id)
                ->where('presensi_id', $presensi->id)
                ->update([
                    'waktu_presensi' => now(),
                    'status' => 1,
                ]);
                return response()->json(['status' => 'success', 'message' => 'Presensi berhasil']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Gagal update presensi'], 404);
            }
    }

        public function getFilterRekap(Request $request, RekapMahasiswaService $service)
    {
        $data['title'] = 'Rekap Dosen';
        $data['judul'] = 'Rekap Dosen';
        $mahasiswa = Auth::user()->mahasiswa;
        // $dosenTerpilih = Auth::user()->dosen;
        // $data['mahasiswa'] = Auth::user()->mahasiswa;
        // $data['dosenTerpilih'] = Dosen::findOrFail($request->dosen);
        // $data['tahunTerpilih'] = TahunAjaran::findOrFail($request->tahun_ajaran);
        // $data['tahun'] = TahunAjaran::orderBy('tahun_awal')->get();
        $data['rekap'] = [];
        $data['totalPertemuan'] = 16;

        $hasil = $service->getFilterRekap($mahasiswa->id, $request->tahun_ajaran);
        $data['rekap'] = $hasil['rekap'];
        $data['totalPertemuan'] = $hasil['totalPertemuan'];

        return response()->json($data);

    }

}
