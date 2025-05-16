<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreMasterRuangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Ruangan';
        $ruangan = Ruangan::all();
        return view('admin.master_data.ruangan', compact('title', 'ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Data Ruangan';
        // $ruangan = Ruangan::all();
        return view('admin.master_data.form-ruangan', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasterRuangan $request)
    {
        $request->merge([
            'nama_ruangan' =>trim($request->nama_ruangan),
        ]);

        $request->validate([
            'nama_ruangan' => 'required|max:150|unique:ruangans,nama_ruangan',
        ],[
            'nama_ruangan.required' => 'Nama Ruangan tidak boleh kosong',
            'nama_ruangan.max' => 'Nama Ruangan Maksimal 150 karakter',
            'nama_ruangan.unique' => 'Nama Ruangan Sudah terdaftar',
        ]);

        try {
            Ruangan::create($request->only([ 'nama_ruangan']));

            return redirect()->route('admin.master-ruangan.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Tambahkan'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal tambah Ruangan', [
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
        $title = 'Edit Ruangan';
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.master_data.form-ruangan', compact('title', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMasterRuangan $request, string $id)
    {

        $request->validate([
            'nama_ruangan' => 'required|max:150|unique:ruangans,nama_ruangan,'.$id,
        ],[
            'nama_ruangan.required' => 'Nama Ruangan tidak boleh kosong',
            'nama_ruangan.max' => 'Nama Ruangan Maksimal 150 karakter',
            'nama_ruangan.unique' => 'Nama Ruangan Sudah terdaftar',
        ]);

        try {
            $ruangan = Ruangan::findOrFail($id);

            $ruangan->update($request->only(['nama_ruangan']));

            return redirect()->route('admin.master-ruangan.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Perbarui'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Perbarui Ruangan', [
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
        try {

            // Update atau create data tahun ajaran
            $ruangan = Ruangan::findOrFail($id);
            $ruangan->delete();
            return redirect()->route('admin.master-ruangan.index')->with([
                'status' => 'success',
                'message' => 'Data Berhasil Di Hapus'
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal Hapus Ruangan', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat Hapus data: ' . $e->getMessage()
            ]);
        }
    }

    public function validateField(Request $request)
    {
        {
            $id = $request->input('id'); // ambil id dari form (edit mode)
            $rules = (new StoreMasterRuangan())->rules($id);
            $messages = (new StoreMasterRuangan())->messages();
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
}
