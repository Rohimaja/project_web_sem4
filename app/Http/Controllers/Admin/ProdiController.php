<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMasterProdi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Program Studi';
        $prodi = Prodi::all();
        return view('admin.master_data.prodi', compact('title', 'prodi'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.form-prodi',['title' => 'Tambah Data']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasterProdi $request)
    {
        $request->merge([
            'kode_prodi' => trim($request->kode_prodi),
            'nama_prodi' => trim($request->nama_prodi),
        ]);

        try {
            Prodi::create($request->only(['kode_prodi', 'jenjang', 'nama_prodi']));

            return redirect()->route('admin.master-prodi.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Tambahkan'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal tambah Program Studi', [
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
    public function edit($id)
    {
        $title = 'Edit Program Studi';
        $prodi = Prodi::findOrFail($id);
        return view('admin.master_data.form-prodi', compact('title', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMasterProdi $request, $id)
    {
        $request->merge([
            'kode_prodi' => trim($request->kode_prodi),
            'nama_prodi' => trim($request->nama_prodi),
        ]);

        try {
            $prodi = Prodi::findOrFail($id);

            $prodi->update($request->only(['kode_prodi', 'jenjang', 'nama_prodi']));

            return redirect()->route('admin.master-prodi.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Perbarui'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Perbarui Program Studi', [
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
    public function destroy($id): RedirectResponse
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();
        // return redirect()->route('admin.master-prodi.index')->with('success', 'Prodi berhasil dihapus.');
        return redirect()->route('admin.master-prodi.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);
    }

    public function validateField(Request $request)
    {
        $id = $request->input('id'); // ambil id dari form (edit mode)
        $rules = (new StoreMasterProdi())->rules($id);
        $messages = (new StoreMasterProdi())->messages();
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

    // ProdiController.php
    public function getList()
    {
        $data = Prodi::orderBy('nama')->pluck('nama');
        return response()->json($data);
    }

}
