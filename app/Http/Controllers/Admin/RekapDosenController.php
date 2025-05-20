<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Services\RekapDosenService;
use Illuminate\Http\Request;

class RekapDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Rekap Dosen';
        $judul = 'Rekap Dosen';
        $dosen = Dosen::all();
        $tahun = TahunAjaran::all();
        $dosenTerpilih = $request->dosen ? Dosen::find($request->dosen) : null;
        $tahunTerpilih = $request->tahun_ajaran ? TahunAjaran::find($request->tahun_ajaran) : null;
        $rekap = [];
        $totalPertemuan = 16;
        return view('admin.rekap_presensi.rekap_dosen', compact('title','judul','dosen','dosenTerpilih','tahunTerpilih','tahun','rekap','totalPertemuan'));
    }

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

    public function rekapDosen(Request $request, RekapDosenService $service)
    {
        $data['title'] = 'Rekap Dosen';
        $data['judul'] = 'Rekap Dosen';
        $data['dosen'] = Dosen::all();
        $data['prodi'] = Prodi::all();
        $data['dosenTerpilih'] = Dosen::findOrFail($request->dosen);
        $data['tahunTerpilih'] = TahunAjaran::findOrFail($request->tahun_ajaran);
        $data['tahun'] = TahunAjaran::all();
        $data['rekap'] = [];
        $data['totalPertemuan'] = 16;

        if ($request->isMethod('post')) {
            $request->validate([
                'dosen' => 'required|exists:dosens,id',
                'tahun_ajaran' => 'required|exists:tahun_ajarans,id',
            ]);

            $hasil = $service->getRekapDosen($request->dosen, $request->tahun_ajaran);
            $data['rekap'] = $hasil['rekap'];
            $data['totalPertemuan'] = $hasil['totalPertemuan'];
        }

        return view('admin.rekap_presensi.rekap_dosen', $data);
    }
}
