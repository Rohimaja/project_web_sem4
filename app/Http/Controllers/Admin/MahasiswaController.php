<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StoreMasterMahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Mahasiswa';
        // $mahasiswa = Mahasiswa::all();
        $mahasiswa = Mahasiswa::with(relations: ['prodi', 'tahun','province','regency','district','village'])->get();

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
    public function store(StoreMasterMahasiswa $request)
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

        // $request->validate([
        //     'nim' => 'required|max:10|unique:mahasiswas,nim',
        //     'nama' => 'required|max:100',
        //     'jenis_kelamin' => 'required',
        //     'agama' => 'required',
        //     'tempat_lahir' => 'required|max:100',
        //     'tgl_lahir' => 'required|before:today',
        //     'email' => 'required|email|max:100|unique:mahasiswas,email',
        //     'no_telp' => 'required|max:20|regex:/^[0-9]+$/',
        //     'alamat' => 'required|max:200',
        //     'prodi_id' => 'required',
        //     'tahun_masuk' => 'required|max:4|regex:/^[0-9]+$/',
        //     'semester' => 'required',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // opsional: validasi foto
        //     'provinsi_id' => 'required',
        //     'kota_id' => 'required',
        //     'kecamatan_id' => 'required',
        //     'kelurahan_id' => 'required',
        // ], [
        //     'nim.required' => 'Nim tidak boleh kosong',
        //     'nim.max' => 'Nim Maksimal 10 Karakter',
        //     'nim.unique' => 'Nim sudah terdaftar',

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

        //     'prodi_id.required' => 'Program Studi wajib dipilih',
        //     'semester.required' => 'Semester wajib dipilih',

        //     'tahun_masuk.required' => 'Tahun Akhir tidak boleh kosong.',
        //     'tahun_masuk.max' => 'Tahun Akhir maksimal 4 angka.',
        //     'tahun_masuk.regex' => 'Tahun Akhir hanya boleh berupa angka.',

        //     'foto.image' => 'File harus berupa gambar',
        //     'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg',
        //     'foto.max' => 'Ukuran gambar maksimal 2MB',

        //     'provinsi_id.required' => 'Provinsi wajib dipilih',
        //     'kota_id.required' => 'Kota wajib dipilih',
        //     'kecamatan_id.required' => 'Kecamatan wajib dipilih',
        //     'kelurahan_id.required' => 'Kelurahan wajib dipilih',
        // ]);

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
                'province_id' => $request->province_id,
                'regency_id' => $request->regency_id,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
            ]);

            return redirect()->route('admin.master-mahasiswa.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Ditambahkan'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal menambahkan Mahasiswa', [
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
    public function update(StoreMasterMahasiswa $request, $id)
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

        // $request->validate([
        //     'nim' => 'required|max:10|unique:mahasiswas,nim,'.$id,
        //     'nama' => 'required|max:100',
        //     'jenis_kelamin' => 'required',
        //     'agama' => 'required',
        //     'tempat_lahir' => 'required|max:100',
        //     'tgl_lahir' => 'required|before:today',
        //     'email' => 'required|email|max:100|unique:mahasiswas,email,'.$id,
        //     'no_telp' => 'required|max:20|regex:/^[0-9]+$/',
        //     'alamat' => 'required|max:200',
        //     'prodi_id' => 'required',
        //     'tahun_masuk' => 'required|max:4|regex:/^[0-9]+$/',
        //     'semester' => 'required',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // opsional: validasi foto
        //     'provinsi_id' => 'required',
        //     'kota_id' => 'required',
        //     'kecamatan_id' => 'required',
        //     'kelurahan_id' => 'required',
        // ], [
        //     'nim.required' => 'Nim tidak boleh kosong',
        //     'nim.max' => 'Nim Maksimal 10 Karakter',
        //     'nim.unique' => 'Nim sudah terdaftar',

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

        //     'prodi_id.required' => 'Program Studi wajib dipilih',
        //     'semester.required' => 'Semester wajib dipilih',

        //     'tahun_masuk.required' => 'Tahun Akhir tidak boleh kosong.',
        //     'tahun_masuk.max' => 'Tahun Akhir maksimal 4 angka.',
        //     'tahun_masuk.regex' => 'Tahun Akhir hanya boleh berupa angka.',

        //     'foto.image' => 'File harus berupa gambar',
        //     'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg',
        //     'foto.max' => 'Ukuran gambar maksimal 2MB',

        //     'provinsi_id.required' => 'Provinsi wajib dipilih',
        //     'kota_id.required' => 'Kota wajib dipilih',
        //     'kecamatan_id.required' => 'Kecamatan wajib dipilih',
        //     'kelurahan_id.required' => 'Kelurahan wajib dipilih',
        // ]);

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $user = $mahasiswa->user;

            // Kalau ada foto baru diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama kalau ada
                if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                    Storage::disk('public')->delete($mahasiswa->foto);
                }

                // Simpan foto baru
                $fotoPath = $request->file('foto')->store('foto_mahasiswa', 'public');
                $mahasiswa->foto = $fotoPath;
            }

            $tahunAjaranAktif = TahunAjaran::where('status', true)->first();


            // Update data admin
            $mahasiswa->update([
                'user_id' => $user->id, // hubungkan ke user yang baru dibuat
                'nim' => $request->nim,
                'rfid' => $request->rfid,
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
                'foto' => $mahasiswa->foto,
                'province_id' => $request->province_id,
                'regency_id' => $request->regency_id,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
            ]);

            // Update juga data user terkait
            $userData =[
                'name' => $request->nama,
                'nim' => $request->nim,
            ];

            if ($request->filled('new_password')) {
                $userData['password'] = Hash::make($request->new_password);
            }

            $user->update($userData);

            return redirect()->route('admin.master-mahasiswa.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Diperbarui'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui Mahasiswa', [
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
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        // return redirect()->route('admin.master-prodi.index')->with('success', 'Prodi berhasil dihapus.');
        return redirect()->route('admin.master-mahasiswa.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);
    }

    public function validateField(Request $request)
    {
        $id = $request->input('id'); // ambil id dari form (edit mode)
        $rules = (new StoreMasterMahasiswa())->rules($id);
        $messages = (new StoreMasterMahasiswa())->messages();
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
