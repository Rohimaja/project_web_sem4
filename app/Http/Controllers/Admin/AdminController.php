<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Admin';
        $admin = Admin::all();
        return view('admin.master_data.admin',compact('title','admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.form-admin',['title' =>'Tambah Data']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
        ]);

        $request->validate([
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
                $fotoPath = $request->file('foto')->store( 'foto_admin'); // folder: storage/app/public/foto_admin
            }

            // Insert ke tabel users dulu
            $user = \App\Models\User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'role' => 'admin', // default role admin
                'password' => Hash::make('password123'), // default password sementara
            ]);

            // Insert ke tabel admins
            Admin::create([
                'user_id' => $user->id, // hubungkan ke user yang baru dibuat
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $fotoPath,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'kecamatan_id' => $request->kecamatan_id,
                'kelurahan_id' => $request->kelurahan_id,
            ]);

            return redirect()->route('admin.master-admin.index')->with([
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
        $title = 'Edit Data Admin';
        $admin = Admin::findOrFail($id);
        return view('admin.master_data.form-admin', compact('title', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
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
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'email.required' => 'Email Tidak boleh kosong',
            'no_telp.required' => 'No Telpon Tidak boleh kosong',
            'alamat.required' => 'Alamat Tidak boleh kosong',
        ]);

        try {
            $admin = Admin::findOrFail($id);
            $user = $admin->user;

            // Kalau ada foto baru diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama kalau ada
                if ($admin->foto && Storage::disk('public')->exists($admin->foto)) {
                    Storage::disk('public')->delete($admin->foto);
                }

                // Simpan foto baru
                $fotoPath = $request->file('foto')->store('foto_admin', 'public');
                $admin->foto = $fotoPath;
            }

            // Update data admin
            $admin->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $admin->foto, // foto baru atau tetap lama
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

            return redirect()->route('admin.master-admin.index')->with([
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
        $admin = Admin::findOrFail($id);
        $admin->delete();
        // return redirect()->route('admin.master-prodi.index')->with('success', 'Prodi berhasil dihapus.');
        return redirect()->route('admin.master-admin.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);
    }
}
