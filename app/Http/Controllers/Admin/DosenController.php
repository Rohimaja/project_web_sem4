<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Dosen';
        $dosen = Dosen::all();
        return view('admin.master_data.dosen',compact('title','dosen'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all(); // Ambil semua data prodi
        $title = 'Tambah Data'; // Ambil semua data prodi
        return view('admin.master_data.form-dosen', compact('prodi', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'nip' => trim($request->nip),
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
        ]);

        $request->validate([
            'nip' => 'required|max:20|unique:dosens,nip',
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
                $fotoPath = $request->file('foto')->store( 'foto_dosen', 'public'); // folder: storage/app/public/foto_admin
            }

            // Insert ke tabel users dulu
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'role' => 'dosen', // default role admin
                'password' => Hash::make('password123'), // default password sementara
            ]);

            // Insert ke tabel admins
            Dosen::create([
                'user_id' => $user->id, // hubungkan ke user yang baru dibuat
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'prodi_id' => $request->prodi_id,
                'foto' => $fotoPath,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'kecamatan_id' => $request->kecamatan_id,
                'kelurahan_id' => $request->kelurahan_id,
            ]);

            return redirect()->route('admin.master-dosen.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Ditambahkan'
            ]);

        } catch (\Exception $e) {
            \Log::error('Gagal menambahkan Admin', [
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
        $dosen = Dosen::findOrFail($id);
        $title = 'Edit Data'; // Ambil semua data prodi
        return view('admin.master_data.form-dosen', compact('dosen','prodi', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
            'nip' => trim($request->nip),
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
        ]);

        $request->validate([
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:100',
            'email' => 'required|email|max:100',
            'no_telp' => 'required|max:20|regex:/^[0-9]+$/',
            'alamat' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // opsional: validasi foto
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
            $dosen = Dosen::findOrFail($id);
            $user = $dosen->user;

            // Kalau ada foto baru diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama kalau ada
                if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                    Storage::disk('public')->delete($dosen->foto);
                }

                // Simpan foto baru
                $fotoPath = $request->file('foto')->store('foto_dosen', 'public');
                $dosen->foto = $fotoPath;
            }

            // Update data admin
            $dosen->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $dosen->foto, // foto baru atau tetap lama
                'prodi_id' => $request->prodi_id, // foto baru atau tetap lama
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'kecamatan_id' => $request->kecamatan_id,
                'kelurahan_id' => $request->kelurahan_id,
            ]);

            // Update juga data user terkait
            $userData =[
                'name' => $request->nama,
                'email' => $request->email,
            ];

            if ($request->filled('new_password')) {
                $userData['password'] = Hash::make($request->new_password);
            }

            $user->update($userData);

            return redirect()->route('admin.master-dosen.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Diperbarui'
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal mengupdate Admin', [
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        // return redirect()->route('admin.master-prodi.index')->with('success', 'Prodi berhasil dihapus.');
        return redirect()->route('admin.master-dosen.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);
    }
}
