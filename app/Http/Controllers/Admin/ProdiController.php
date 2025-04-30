<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Http\RedirectResponse;

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
    public function store(Request $request)
    {
        $request->merge([
            'kode_prodi' => trim($request->kode_prodi),
            'nama_prodi' => trim($request->nama_prodi),
        ]);

        $request->validate([
            'kode_prodi' => 'required|max:5|regex:/^[A-Z0-9]+$/|unique:prodis,kode_prodi',
            'jenjang' => 'required',
            'nama_prodi' => 'required|max:40|unique:prodis,nama_prodi',
        ], [
            'kode_prodi.required' => 'Kode Prodi tidak boleh kosong',
            'kode_prodi.unique' => 'Kode Prodi sudah terdaftar',
            'nama_prodi.unique' => 'Nama Program Studi sudah ada',
        ]);

        Prodi::create($request->only(['kode_prodi', 'jenjang', 'nama_prodi']));

        return redirect()->route('admin.master-prodi.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Di Tambahkan'
        ]);
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
    public function update(Request $request, string $id)
    {
        $request->merge([
            'kode_prodi' => trim($request->kode_prodi),
            'nama_prodi' => trim($request->nama_prodi),
        ]);

        $request->validate([
            'kode_prodi' => 'required|max:5|regex:/^[A-Z0-9]+$/|unique:prodis,kode_prodi,'.$id,
            'jenjang' => 'required',
            'nama_prodi' => 'required|max:40|unique:prodis,nama_prodi,'.$id,
        ], [
            'kode_prodi.required' => 'Kode Prodi tidak boleh kosong',
            'kode_prodi.unique' => 'Kode Prodi sudah terdaftar',
            'nama_prodi.unique' => 'Nama Program Studi sudah ada',
        ]);

        $prodi = Prodi::findOrFail($id);

        $prodi->update($request->only(['kode_prodi', 'jenjang', 'nama_prodi']));

        return redirect()->route('admin.master-prodi.index')->with([
            'status' => 'success',
            'message' => 'Data Berhasil Di Perbarui'
        ]);
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
}
