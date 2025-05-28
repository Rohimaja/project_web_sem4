<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMasterJadwal;
use App\Models\DetailJadwal;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index()
    {
        $title = 'Data Jadwal';
        $jadwal = Jadwal::with('dosen','prodi','ruangan','matkul')->get();
        return view('admin.master_data.jadwal', compact('jadwal','title'));
    }

    public function create()
    {
        $title = 'Data Jadwal';
        $prodi = Prodi::all();
        $ruangan = Ruangan::all();
        $matkul = Matkul::all();
        $dosen = Dosen::all();
        return view('admin.master_data.form-jadwal', compact('title','prodi','ruangan','matkul','dosen'));
    }

    public function store(StoreMasterJadwal $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

                $jadwal = Jadwal::create([
                    'jam' => $request->jam,
                    'durasi' => $request->durasi,
                    'hari' => $request->hari,
                    'dosen_id' => $request->dosen_id,
                    'prodi_id' => $request->prodi_id,
                    'matkul_id' => $request->matkul_id,
                    'ruangan_id' => $request->ruangan_id,
                    'tahun_ajaran_id' => $tahunAjaranAktif->id,
                    'semester' => $request->semester,
                ]);

                $mahasiswa = Mahasiswa::where('prodi_id', $request['prodi_id'])
                ->where('semester', $request['semester'])->get();

                if ($mahasiswa->isEmpty()) {
                    return back()->withErrors(['semester' => 'Tidak ada mahasiswa untuk prodi dan semester ini.']);
                }

                // Simpan detail presensi
                foreach ($mahasiswa as $mhs) {
                    DetailJadwal::create([
                        'jadwal_id' => $jadwal->id,
                        'mahasiswa_id' => $mhs->id,
                    ]);
                }
            });

            return redirect()->route('admin.master-jadwal.index')->with([
                'status' => 'success',
                'message' => 'Jadwal Berhasil Ditambahkan'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan Data', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage()
            ]);
        }
    }

    public function show(string $id)
    {
        $title = 'Data Jadwal';
        // $presensi = Presensi::findOrFail($id);
        $jadwal = Jadwal::with('dosen','prodi','ruangan','matkul','tahun')->findOrFail($id);
        $detail = DetailJadwal::with('mahasiswa')->where('jadwal_id', $id)->get();
        return view('admin.master_data.info-jadwal', compact('title','jadwal','detail'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

        public function validateField(Request $request)
    {
        {
            // $id = $request->input('id');
            $rules = (new StoreMasterJadwal())->rules();
            $messages = (new StoreMasterJadwal())->messages();
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
}
