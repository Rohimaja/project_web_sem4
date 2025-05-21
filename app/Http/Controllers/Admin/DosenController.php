<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StoreMasterDosen;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Dosen';
        $dosen = Dosen::all();
        $prodi = Dosen::with(relations: ['prodi'])->get();
        return view('admin.master_data.dosen',compact('title','dosen','prodi'));

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
    public function store(StoreMasterDosen $request)
    {
        $request->merge([
            'nip' => trim($request->nip),
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
        ]);

        try {

            DB::transaction(function () use ($request) {

                // Insert ke tabel users dulu
                $user = User::create([
                    'name' => $request->nama,
                    'email' => $request->email,
                    'role' => 'dosen', // default role admin
                    'password' => Hash::make('password123'), // default password sementara
                ]);

                $fotoPath = null;
                if ($request->hasFile('foto')) {
                    $filename = 'profile/dosen/profile_' . $request->nip . '.' . $request->file('foto')->extension();
                    $fotoPath = $request->file('foto')->storeAs( 'foto_dosen', $filename, 'public'); // folder: storage/app/public/foto_admin
                }

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
                    'province_id' => $request->province_id,
                    'regency_id' => $request->regency_id,
                    'district_id' => $request->district_id,
                    'village_id' => $request->village_id,
                ]);
            });


            return redirect()->route('admin.master-dosen.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Ditambahkan'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Menambahkan Dosen', [
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
    public function show(string $id)
    {
        try {
            // Cari data mahasiswa berdasarkan ID
            $dosen = Dosen::with('prodi','province','regency','district','village')->findOrFail($id);

            // Kirimkan data mahasiswa sebagai response JSON
            return response()->json($dosen);
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan pesan error
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
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
    public function update(StoreMasterDosen $request, $id)
    {
        $request->merge([
            'nip' => trim($request->nip),
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
        ]);

        try {

            DB::transaction(function () use($request, $id) {

                $dosen = Dosen::findOrFail($id);
                $user = $dosen->user;

                // Kalau ada foto baru diupload
                if ($request->hasFile('foto')) {
                    // Hapus foto lama kalau ada
                    if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                        Storage::disk('public')->delete($dosen->foto);
                    }

                    // Simpan foto baru

                    $filename = 'profile/dosen/profile_' . $request->nip . '.' . $request->file('foto')->extension();
                    $fotoPath = $request->file('foto')->storeAs('foto_dosen', $filename, 'public');
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
                    'province_id' => $request->province_id,
                    'regency_id' => $request->regency_id,
                    'district_id' => $request->district_id,
                    'village_id' => $request->village_id,
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
            });


            return redirect()->route('admin.master-dosen.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Diperbarui'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal Memperbarui Dosen', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
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

    public function validateField(Request $request)
    {
        $id = $request->input('id'); // ambil id dari form (edit mode)
        $rules = (new StoreMasterDosen())->rules($id);
        $messages = (new StoreMasterDosen())->messages();
        $field = $request->input('field');
        $value = $request->input('value');

        // $rules = [
        //     'nama' => 'required|max:100',
        //     'email' => 'required|email|max:100|unique:admins,email',
        //     // tambahkan field lain sesuai kebutuhan
        // ];

        $validator = Validator::make([$field => $value], [
            $field => $rules[$field] ?? '',
        ],$messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first($field)], 422);
        }

        return response()->json(['success' => true]);
    }

    public function filter(Request $request)
    {
        $query = Dosen::query();

        if ($request->prodi_id) {
            $query->where('prodi_id', $request->prodi_id);
        }

        return response()->json($query->get(['foto','nip','nama', 'email']));
    }
}
