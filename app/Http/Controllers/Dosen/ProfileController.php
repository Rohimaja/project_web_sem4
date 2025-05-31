<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request): View
    {

        // return view('dosen.profil', [
        //     'user' => $request->user(),
        // ]);

        $title = "Profil";
        // $user = $request->user();
        // $prodi = Dosen::with(relations: ['prodi'])->get();
        // $user = User::with('dosen')->find($request->user()->id);

        // $user = $request->user()->load('dosen','province','regency','district','village');
        $user = $request->user()->load(['dosen.provinsi', 'dosen.kota', 'dosen.kecamatan', 'dosen.kelurahan']);

        return view('dosen.profil', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $dosen = $request->user()->dosen;

            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                    Storage::disk('public')->delete($dosen->foto);
                }

                // Simpan foto baru
                $filename = 'dosen/profile_' . $dosen->id . '.' . $request->file('foto')->extension();
                $fotoPath = $request->file('foto')->storeAs('profiles', $filename, 'public');
                $dosen->update(['foto' => $fotoPath]);
            }

            return redirect()->route('dosen.profile.edit')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Perbarui'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Perbarui Profile', [
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
        //
    }
}
