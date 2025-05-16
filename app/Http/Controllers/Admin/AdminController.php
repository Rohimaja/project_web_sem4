<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
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
=======
use App\Http\Requests\Admin\StoreMasterAdmin;
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

>>>>>>> 8934609 (fixed responsive & view  admin)
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
<<<<<<< HEAD
        return view('admin.master_data.form-admin',['title' =>'Tambah Data']);

=======
        $province = Province::all();
        $regencie = Regency::all();

        return view('admin.master_data.form-admin', [
            'title' => 'Tambah Data',
            // 'province' => $province,
            // 'regencie' => $regencie,
        ]);
>>>>>>> 8934609 (fixed responsive & view  admin)
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

<<<<<<< HEAD
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

=======
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
                'province_id' => $request->province_id,
                'regency_id' => $request->regency_id,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
            ]);
>>>>>>> 8934609 (fixed responsive & view  admin)

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
            $admin = Admin::findOrFail($id);

            // Kirimkan data mahasiswa sebagai response JSON
            return response()->json([
                'status' => 'success',
                'data' => $admin
            ]);
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

<<<<<<< HEAD
        try {
            DB::transaction(function () use ($request, $id) {
=======
        // $request->validate([
        //     'nama' => 'required|max:100',
        //     'jenis_kelamin' => 'required',
        //     'agama' => 'required',
        //     'tempat_lahir' => 'required|max:100',
        //     'tgl_lahir' => 'required|before:today',
        //     'email' => 'required|email|max:100|unique:admins,email,'.$id,
        //     'no_telp' => 'required|max:20|regex:/^[0-9]+$/',
        //     'alamat' => 'required|max:200',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // opsional: validasi foto
        //     'provinsi_id' => 'required',
        //     'kota_id' => 'required',
        //     'kecamatan_id' => 'required',
        //     'kelurahan_id' => 'required',
        // ], [
        //     'nama.required' => 'Nama tidak boleh kosong',
        //     'nama.max' => 'Nama maksimal 100 karakter',

        //     'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih',
        //     'agama.required' => 'Agama harus dipilih',

        //     'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
        //     'tempat_lahir.max' => 'Tempat Lahir maksimal 100 karakter',

        //     'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
        //     'tgl_lahir.before' => 'Tanggal Lahir harus sebelum hari ini',

        //     'email.required' => 'Email tidak boleh kosong',
        //     'email.email' => 'Format email tidak valid',
        //     'email.max' => 'Email maksimal 100 karakter',
        //     'email.unique' => 'Email sudah digunakan',

        //     'no_telp.required' => 'Nomor Telepon wajib diisi',
        //     'no_telp.max' => 'Nomor Telepon maksimal 20 karakter',
        //     'no_telp.regex' => 'Nomor Telepon hanya boleh berisi angka',

        //     'alamat.required' => 'Alamat tidak boleh kosong',
        //     'alamat.max' => 'Alamat maksimal 200 karakter',

        //     'foto.image' => 'File harus berupa gambar',
        //     'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg',
        //     'foto.max' => 'Ukuran gambar maksimal 2MB',

        //     'provinsi_id.required' => 'Provinsi wajib dipilih',
        //     'kota_id.required' => 'Kota wajib dipilih',
        //     'kecamatan_id.required' => 'Kecamatan wajib dipilih',
        //     'kelurahan_id.required' => 'Kelurahan wajib dipilih',
        // ]);

        try {
>>>>>>> 8934609 (fixed responsive & view  admin)
            $admin = Admin::findOrFail($id);
            $user = $admin->user;

            // Kalau ada foto baru diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama kalau ada
                if ($admin->foto && Storage::disk('public')->exists($admin->foto)) {
                    Storage::disk('public')->delete($admin->foto);
                }

                // Simpan foto baru
<<<<<<< HEAD
                $filename = 'profile/admin/profile_' . $user->id . '.' . $request->file('foto')->extension();
                $fotoPath = $request->file('foto')->storeAs('foto_admin',$filename, 'public');
=======
                $fotoPath = $request->file('foto')->store('foto_admin', 'public');
>>>>>>> 8934609 (fixed responsive & view  admin)
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
<<<<<<< HEAD
        });

=======
>>>>>>> 8934609 (fixed responsive & view  admin)

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

<<<<<<< HEAD
=======
        // $rules = [
        //     'nama' => 'required|max:100',
        //     'email' => 'required|email|max:100|unique:admins,email',
        //     // tambahkan field lain sesuai kebutuhan
        // ];

>>>>>>> 8934609 (fixed responsive & view  admin)
        $validator = Validator::make([$field => $value], [
            $field => $rules[$field] ?? '',
        ],$messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first($field)], 422);
        }

        return response()->json(['success' => true]);
    }
<<<<<<< HEAD
=======

// public function validateField(Request $request)
// {
//     // Ambil rules dan messages dari FormRequest
//     $rules = (new StoreMasterRequest())->rules();
//     $messages = (new StoreMasterRequest())->messages();

//     // Validasi hanya field yang dikirim
//     $inputKey = array_keys($request->all())[0];

//     $validator = Validator::make($request->only($inputKey), [
//         $inputKey => $rules[$inputKey] ?? '',
//     ], $messages);

//     // if ($validator->fails()) {
//     //     return response()->json([
//     //         'success' => false,
//     //         'message' => $validator->errors()->first($inputKey),
//     //     ]);
//     // }

//     if ($validator->fails()) {
//         throw new ValidationException($validator);
//     }

//     return response()->json(['success' => true]);
// }

>>>>>>> 8934609 (fixed responsive & view  admin)
}
