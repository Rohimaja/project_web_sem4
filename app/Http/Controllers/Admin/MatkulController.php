<?php

namespace App\Http\Controllers\Admin;

use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Mata Kuliah';
        // $matkul = Matkul::all();
        // $prodi = Matkul::with('prodi')->get();
        // $tahun = Matkul::with('tahunAjaran')->get();
        $matkul = Matkul::with(['prodi', 'tahun'])->get();


        return view('admin.master_data.matkul', compact('title', 'matkul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all(); // Ambil semua data prodi
        $tahun = TahunAjaran::all(); // Ambil semua data prodi
        $title = 'Tambah Data'; // Ambil semua data prodi
        return view('admin.master_data.form-matkul', compact('prodi','tahun', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'nama_matkul' => trim($request->nama_matkul),
            'durasi_matkul' => trim($request->durasi_matkul),
        ]);

        $request->validate([
            'nama_matkul' => 'required|max:100',
            'prodi_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'semester' => 'required',
            'durasi_matkul' => 'required',
        ], [
            'nama_matkul.required' => 'Mata Kuliah tidak boleh kosong',
            'durasi_matkul.required' => 'Sks tidak boleh kosong',
        ]);

        try {
            $kodeMatkul = $this->generateKodeMatkul($request->prodi_id);

            Matkul::create([
                'kode_matkul' => $kodeMatkul,
                'nama_matkul' => $request->nama_matkul,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
                'semester' => $request->semester,
                'durasi_matkul' => $request->durasi_matkul,
                'prodi_id' => $request->prodi_id,
            ]);

            return redirect()->route('admin.master-matkul.index')->with([
                'status' => 'success',
                'message' => 'Mata Kuliah Berhasil Ditambahkan'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan Mata Kuliah', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $matkul = Matkul::findOrFail($id);
        $prodi = Prodi::all(); // Ambil semua data prodi
        $tahun = TahunAjaran::all(); // Ambil semua data prodi
        $title = 'Update Data'; // Ambil semua data prodi
        return view('admin.master_data.form-matkul', compact('matkul','prodi','tahun', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
            'nama_matkul' => trim($request->nama_matkul),
            'durasi_matkul' => trim($request->durasi_matkul),
        ]);

        $request->validate([
            'nama_matkul' => 'required|max:100',
            'prodi_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'semester' => 'required',
            'durasi_matkul' => 'required',
        ], [
            'nama_matkul.required' => 'Mata Kuliah tidak boleh kosong',
            'durasi_matkul.required' => 'Sks tidak boleh kosong',
        ]);

        try {

            // Update atau create data tahun ajaran
            $matkul = Matkul::findOrFail($id);
            $matkul->update($request->only(['nama_matkul', 'tahun_ajaran_id', 'semester', 'durasi_matkul','prodi_id']));

            return redirect()->route('admin.master-matkul.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Ubah'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Ubah Tahun Ajaran', [
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
        $matkul = Matkul::findOrFail($id);
        $matkul->delete();
        // return redirect()->route('admin.master-prodi.index')->with('success', 'Prodi berhasil dihapus.');
        return redirect()->route('admin.master-matkul.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);
    }

    private function generateKodeMatkul($id)
{
    // Ambil kode prodi berdasarkan id_prodi
    $prodi = Prodi::findOrFail($id);

    $kodeProdi = $prodi->kode_prodi; // contoh "TI"
    $tahunSekarang = now()->format('y'); // contoh "25" untuk tahun 2025

    // Cari kode matkul terakhir dengan pola yang sesuai
    $lastKode = Matkul::where('kode_matkul', 'like', $kodeProdi . $tahunSekarang . '%')
        ->orderBy('kode_matkul', 'desc')
        ->first();

    if ($lastKode) {
        // Ambil 3 digit terakhir dan tambah 1
        $lastNumber = (int)substr($lastKode->kode_matkul, -3);
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        // Kalau belum ada, mulai dari 001
        $newNumber = '001';
    }

    // Gabungkan semuanya
    return $kodeProdi . $tahunSekarang . $newNumber;
}

}
