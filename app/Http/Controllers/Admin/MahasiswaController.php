<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $prodi = Prodi::all();
        $mahasiswa = Mahasiswa::with(relations: ['prodi', 'tahun','province','regency','district','village'])->get();

        return view('admin.master_data.mahasiswa',compact('title','prodi','mahasiswa'));

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

        try {

            DB::transaction(function () use ($request) {
                // Insert ke tabel users dulu
                $user = User::create([
                    'name' => $request->nama,
                    'nim' => $request->nim,
                    'role' => 'mahasiswa', // default role admin
                    'password' => Hash::make('password123'), // default password sementara
                ]);

                $fotoPath = null;
                if ($request->hasFile('foto')) {
                    $filename = 'profile/student/profile_' . $request->nim . '.' . $request->file('foto')->extension();
                    $fotoPath = $request->file('foto')->storeAs( 'foto_mahasiswa', $filename, 'public'); // folder: storage/app/public/foto_admin
                }

                $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

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
            });

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
        $mahasiswa = Mahasiswa::with(relations: ['prodi', 'tahun','province','regency','district','village'])->findOrFail($id);
        return response()->json($mahasiswa);

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

        try {
            DB::transaction(function () use ($request, $id) {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $user = $mahasiswa->user;

            // Kalau ada foto baru diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama kalau ada
                if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                    Storage::disk('public')->delete($mahasiswa->foto);
                }

                // Simpan foto baru
                $filename = 'profile/student/profile_' . $request->nim . '.' . $request->file('foto')->extension();
                $fotoPath = $request->file('foto')->storeAs('foto_mahasiswa',$filename, 'public');
                $mahasiswa->foto = $fotoPath;
            }

            $tahunAjaranAktif = TahunAjaran::where('status', true)->first();


            // Update data admin
            $mahasiswa->update([
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
            });

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

    public function getFilterMahasiswa(Request $request){
        $prodi = $request->query('prodi');
        $semester = $request->query('semester');

        $query = Mahasiswa::query()->with('prodi');

        if ($prodi) {
            $query->where('prodi_id', $prodi);
        }

        if ($semester) {
            $query->where('semester', $semester);
        }

        $mahasiswa = $query->get();

        return response()->json($mahasiswa);
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
