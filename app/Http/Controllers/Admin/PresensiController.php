<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Matkul;
use App\Models\Ruangan;


class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Presensi';
        $presensi = Presensi::all();
        return view('admin.presensi', compact('presensi','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data Presensi';
        // $prodi = Prodi::all();
        $prodi = Prodi::all(); // Ambil semua data prodi
        $ruangan = Ruangan::all(); // Ambil semua data prodi
        $matkul = Matkul::all(); // Ambil semua data prodi
        $dosen = Dosen::all(); // Ambil semua data prodi
        // $prodi = Prodi::all();
        return view('admin.form-presensi', compact('title','prodi','ruangan','matkul','dosen'));
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
    // public function show()
    // {
    //     $title = 'Data Presensi';
    //     // $prodi = Prodi::all();
    //     return view('admin.info-presensi', compact('title'));
    // }
    public function show(string $id)
    {
        $title = 'Detail Data Presensi';
        // $prodi = Prodi::all();
        return view('admin.info-presensi', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
