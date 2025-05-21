<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StoreMasterAdmin;
// use Illuminate\Validation\ValidationException;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Admin';
        // $admin = Admin::all();
        $admin = Admin::with(relations: ['province','regency','district','village'])->get();
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
    public function store(StoreMasterAdmin $request)
    {
        $request->merge([
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
        ]);

        try {

            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->nama,
                    'email' => $request->email,
                    'role' => 'admin', // default role admin
                    'password' => Hash::make('password123'), // default password sementara
                ]);

                $fotoPath = null;
                if ($request->hasFile('foto')) {
                    $filename = 'profile/admin/profile_' . $user->id . '.' . $request->file('foto')->extension();
                    $fotoPath = $request->file('foto')->storeAs( 'foto_admin',$filename,'public'); // folder: storage/app/public/foto_admin
                }

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
                    'province_id' => $request->province_id,
                    'regency_id' => $request->regency_id,
                    'district_id' => $request->district_id,
                    'village_id' => $request->village_id,
                ]);
            });


            return redirect()->route('admin.master-admin.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Ditambahkan'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal menambahkan Admin', [
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
            $admin = Admin::with('province','regency','district','village')->findOrFail($id);

            // Kirimkan data mahasiswa sebagai response JSON
            return response()->json( $admin);
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
        $title = 'Edit Data Admin';
        $admin = Admin::findOrFail($id);
        return view('admin.master_data.form-admin', compact('title', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMasterAdmin $request, $id)
    {
        $request->merge([
            'nama' => trim($request->nama),
            'tempat_lahir' => trim($request->tempat_lahir),
            'email' => trim($request->email),
            'no_telp' => trim($request->no_telp),
            'alamat' => trim($request->alamat),
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
            $admin = Admin::findOrFail($id);
            $user = $admin->user;

            // Kalau ada foto baru diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama kalau ada
                if ($admin->foto && Storage::disk('public')->exists($admin->foto)) {
                    Storage::disk('public')->delete($admin->foto);
                }

                // Simpan foto baru
                $filename = 'profile/admin/profile_' . $user->id . '.' . $request->file('foto')->extension();
                $fotoPath = $request->file('foto')->storeAs('foto_admin',$filename, 'public');
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


            return redirect()->route('admin.master-admin.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Diperbarui'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal Perbarui Admin', [
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
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.master-admin.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);
    }

    public function validateField(Request $request)
    {
        $id = $request->input('id'); // ambil id dari form (edit mode)
        $rules = (new StoreMasterAdmin())->rules($id);
        $messages = (new StoreMasterAdmin())->messages();
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
