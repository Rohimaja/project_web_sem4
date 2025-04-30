<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Mahasiswa';
        $mahasiswa = Mahasiswa::all();
        return view('admin.master_data.mahasiswa',compact('title','mahasiswa'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data';
        $prodi = Prodi::all();
        return view('admin.master_data.form-mahasiswa', compact('title','prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'nim' => trim($request->nim),
            'rfid' => trim($request->rfid),
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
            'tahun_masuk' => trim($request->tahun_masuk),
        ]);

        $request->validate([
            'nim' => 'required|max:20|unique:mahasiswas,nim',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:100',
            'email' => 'required|max:100',
            'no_telp' => 'required|max:20|regex:/^[0-9]+$/',
            'alamat' => 'required|max:100',
            'provinsi_id' => 'required|integer',
            'kota_id' => 'required|integer',
            'kecamatan_id' => 'required|integer',
            'kelurahan_id' => 'required|integer',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'email.required' => 'Email Tidak boleh kosong',
            'no_telp.required' => 'No Telpon Tidak boleh kosong',
            'alamat.required' => 'Alamat Tidak boleh kosong',
        ]);

        try {

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store( 'foto_mahasiswa', 'public'); // folder: storage/app/public/foto_admin
            }

            $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

            // Insert ke tabel users dulu
            $user = User::create([
                'name' => $request->nama,
                'nim' => $request->nim,
                'role' => 'mahasiswa', // default role admin
                'password' => Hash::make('password123'), // default password sementara
            ]);

            // Insert ke tabel admins
            Mahasiswa::create([
                'user_id' => $user->id, // hubungkan ke user yang baru dibuat
                'nim' => $request->nim,
                'rfid' => '',
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'prodi_id' => $request->prodi_id,
                'tahun_masuk' => $request->tahun_masuk,
                'tahun_ajaran_id' => $tahunAjaranAktif->id,
                'semester' => $request->semester,
                'foto' => $fotoPath,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'kecamatan_id' => $request->kecamatan_id,
                'kelurahan_id' => $request->kelurahan_id,
            ]);

            return redirect()->route('admin.master-mahasiswa.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Ditambahkan'
            ]);

        } catch (\Exception $e) {
            \Log::error('Gagal menambahkan Mahasiswa', [
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
        $prodi = Prodi::all(); // Ambil semua data prodi
        $mahasiswa = Mahasiswa::findOrFail($id);
        $title = 'Edit Data'; // Ambil semua data prodi
        return view('admin.master_data.form-mahasiswa', compact('mahasiswa','prodi', 'title'));
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
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        // return redirect()->route('admin.master-prodi.index')->with('success', 'Prodi berhasil dihapus.');
        return redirect()->route('admin.master-mahasiswa.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);
    }
}
