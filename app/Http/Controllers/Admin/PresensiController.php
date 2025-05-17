<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StorePresensi;
use App\Models\DetailPresensi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;


class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Presensi';
        $presensi = Presensi::with('dosen','prodi','ruangan','matkul')->get();
        return view('admin.presensi', compact('presensi','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Data Presensi';
        $prodi = Prodi::all(); // Ambil semua data prodi
        $ruangan = Ruangan::all(); // Ambil semua data prodi
        $matkul = Matkul::all(); // Ambil semua data prodi
        $dosen = Dosen::all(); // Ambil semua data prodi
        // $prodi = Prodi::all();
        return view('admin.form-presensi', compact('title','prodi','ruangan','matkul','dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresensi $request)
    {
            // $request = $request->validated(); // Ambil data yang sudah divalidasi

        try {
            return DB::transaction(function () use ($request) {

                $conflictRuangan = Presensi::where('tgl_presensi',$request['tgl_presensi'])
                ->where('ruangan_id', $request['ruangan_id'])
                ->where(function($query) use ($request){
                $query->where(function ($q) use ($request) {
                    $q->where('jam_awal', '<=', $request['jam_awal'])
                      ->where('jam_akhir', '>', $request['jam_awal']);
                })->orWhere(function ($q) use ($request) {
                    $q->where('jam_awal', '<', $request['jam_akhir'])
                      ->where('jam_akhir', '>=', $request['jam_akhir']);
                })->orWhere(function ($q) use ($request) {
                    $q->where('jam_awal', '>=', $request['jam_awal'])
                      ->where('jam_akhir', '<=', $request['jam_akhir']);
                });
            })->exists();

        if ($conflictRuangan) {
            return back()->withErrors(['ruangan_id' => 'Ruangan sedang dipakai pada waktu tersebut.'])->withInput();
        }


        // Cek bentrok jadwal
        $conflictJadwal = Presensi::where('tgl_presensi', $request['tgl_presensi'])
            ->where('prodi_id', $request['prodi_id'])
            ->where('semester', $request['semester'])
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_awal', '<=', $request['jam_awal'])
                      ->where('jam_akhir', '>', $request['jam_awal']);
                })->orWhere(function ($q) use ($request) {
                    $q->where('jam_awal', '<', $request['jam_akhir'])
                      ->where('jam_akhir', '>=', $request['jam_akhir']);
                })->orWhere(function ($q) use ($request) {
                    $q->where('jam_awal', '>=', $request['jam_awal'])
                      ->where('jam_akhir', '<=', $request['jam_akhir']);
                });
            })->exists();

        if ($conflictJadwal) {
            return back()->withErrors(['semester' => 'Jadwal bentrok untuk prodi dan semester yang dipilih.'])->withInput();
        }

        $tahunAjaranAktif = TahunAjaran::where('status', operator: true)->first();

        if (!$tahunAjaranAktif) {
            return back()->withErrors(['tahun_ajaran_id' => 'Tahun ajaran aktif tidak ditemukan.']);
        }

                // Generate no_transaksi
        $tahun = now()->format('y');
        $lastKode = Presensi::where('presensi_id', 'like', "TR{$tahun}%")
            ->orderByDesc('presensi_id')->first();

        $nextNumber = $lastKode ? (int)substr($lastKode->presensi_id, -5) + 1 : 1;
        $noTransaksi = 'TR' . $tahun . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);


               // Simpan presensi
        $presensi = Presensi::create([
            'presensi_id' => $noTransaksi,
            'tgl_presensi' => $request['tgl_presensi'],
            'jam_awal' => $request['jam_awal'],
            'jam_akhir' => $request['jam_akhir'],
            'dosen_id' => $request['dosen_id'],
            'prodi_id' => $request['prodi_id'],
            'semester' => $request['semester'],
            'matkul_id' => $request['matkul_id'],
            'ruangan_id' => $request['ruangan_id'],
            'link_zoom' => $request['link_zoom'],
            'tahun_ajaran_id' => $tahunAjaranAktif->id,
        ]);

        // Ambil mahasiswa
        $mahasiswa = Mahasiswa::where('prodi_id', $request['prodi_id'])
            ->where('semester', $request['semester'])->get();

        if ($mahasiswa->isEmpty()) {
            return back()->withErrors(['semester' => 'Tidak ada mahasiswa untuk prodi dan semester ini.']);
        }

                // Simpan detail presensi
        foreach ($mahasiswa as $mhs) {
            DetailPresensi::create([
                'presensi_id' => $presensi->id,
                'mahasiswa_id' => $mhs->id,
                'waktu_presensi' => null,
                'status' => 0,
                'alasan' => '',
            ]);
        }

            return redirect()->route('admin.presensi.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Ditambahkan'
            ]);
        });

        } catch (\Exception $e) {
            Log::error('Gagal menambahkan Presensi', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show()
    // {
    //     $title = 'Data Presensi';
    //     // $prodi = Prodi::all();
    //     return view('admin.info-presensi', compact('title'));
    // }
    public function show(string $id)
    {
        $title = 'Data Presensi';
        // $presensi = Presensi::findOrFail($id);
        $presensi = Presensi::with('dosen','prodi','ruangan','matkul','tahun')->findOrFail($id);
        $detail = DetailPresensi::with('mahasiswa')->where('presensi_id', $id)->get();
        return view('admin.info-presensi', compact('title','presensi','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateDetailPresensi(Request $request)
    {
        try {
            // $data = $request->only(['status', 'alasan', 'mahasiswa_id', 'presensi_id']);
            // $presensi = Presensi::findOrFail($id);
            // $presensi->detailpresensi()->where('mahasiswa_id', $request['mahasiswa_id'])
            // ->update([
            //     'status' => $request['status'],
            //     'waktu_presensi' => $request['status'] == 1 ? now() : null,
            //     'alasan' => $request['alasan'],
            // ]);

            DetailPresensi::where('mahasiswa_id', $request['mahasiswa_id'])
                ->where('presensi_id', $request['presensi_id'])
                ->update([
                    'status' => $request['status'],
                    'waktu_presensi' => $request['status'] == 1 ? now() : null,
                    'alasan' => $request['alasan'],
                ]);

            return redirect()->route('admin.presensi.show',$request['presensi_id'])->with([
                'status' => 'success',
                'message' => 'Data Berhasil Diubah'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal mengubah Presensi', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            // Update atau create data tahun ajaran
            $presensi = Presensi::findOrFail($id);
            $presensi->delete();

            return redirect()->route('admin.presensi.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Hapus'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Hapus Presensi', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ]);
        }
    }

    // public function getMatkulByProdi($prodi_id, $semester){
    //     $matkul = Matkul::where('prodi_id', $prodi_id)->where('semester',$semester)->get();

    //     return response()->json($matkul);
    // }

    // public function getMatkulByProdi(Request $request)
    // {
    //     $prodiId = $request->input('prodi');
    //     $semesterId = $request->input('semester');

    //     // Ambil matkul berdasarkan prodi dan semester
    //     $matkul = Matkul::orWhere('prodi_id', $prodiId)
    //                 ->orWhere('semester', $semesterId)
    //                 ->get();

    //     return response()->json($matkul); // Mengirimkan data sebagai response JSON
    // }

    public function getMatkulByProdi(Request $request)
    {
        $prodi = $request->query('prodi');
        $semester = $request->query('semester');

        $tahunAjaranAktif = TahunAjaran::where('status',  true)->first();

        $query = Matkul::query()->where('tahun_ajaran_id', $tahunAjaranAktif->id);

        if ($prodi) {
            $query->where('prodi_id', $prodi);
        }

        if ($semester) {
            $query->where('semester', $semester);
        }

        $matkul = $query->get(['id', 'nama_matkul']);

        return response()->json($matkul);
    }

        public function validateField(Request $request)
    {
        $rules = (new StorePresensi())->rules();
        $messages = (new StorePresensi())->messages();
        $field = $request->input('field');
        $value = $request->input('value');

        $validator = Validator::make([$field => $value], [
            $field => $rules[$field] ?? '',
        ],$messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first($field)], 422);
        }

        return response()->json(['success' => true]);
    }

}
