<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Services\RekapMahasiswaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class RekapMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Rekap Mahasiswa';
        $prodi = Prodi::all();
        $matkul = Matkul::all(); // Ambil semua data prodi
        $rekap = [];
        $totalPertemuan = 16;
        $prodiTerpilih = $request->prodi ? Prodi::find($request->prodi) : null;
        $matkulTerpilih = $request->matkul ? Matkul::find($request->matkul) : null;
        $semesterTerpilih = $request->input('semester') ?? null;
        return view('admin.rekap_presensi.rekap_mahasiswa', compact('title','prodi','prodiTerpilih','matkulTerpilih','semesterTerpilih','matkul','rekap','totalPertemuan'));
    }





    public function exportPdf(Request $request, RekapMahasiswaService $service)
    {
        try {
            $data = [
                // 'nip' => $dosen->nip,
                // 'nama' => $dosen->nama,
                // 'prodi' => $dosen->prodi->jenjang . ' ' . $dosen->prodi->nama_prodi,
                'prodiTerpilih' => Prodi::findOrFail($request->prodi),
                'matkulTerpilih' => Matkul::findOrFail($request->matkul),
                'semester' => $request->input('semester'), // opsional: bisa ambil dari request jika sudah ada filter
                'rekap' => [],
                'totalPertemuan' => 16,
            ];

            if ($request->isMethod('post')) {

                $hasil = $service->getRekapMahasiswa($request->prodi, $request->semester, $request->matkul);
                $data['rekap'] = $hasil['rekap'];
                $data['totalPertemuan'] = $hasil['totalPertemuan'];
            }

            $pdf = Pdf::loadView('admin.rekap_presensi.mahasiswa_pdf', $data)->setPaper('a4', 'landscape');
            return $pdf->download('Rekap Kehadiran Mahasiswa.pdf');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'status' => 'Gagal',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }

    }



           public function exportExcel(Request $request, RekapMahasiswaService $service)
        {


            // if ($request->isMethod('post')) {

            //     $hasil = $service->getRekapMahasiswa($request->prodi, $request->semester, $request->matkul);
            //     $data['rekap'] = $hasil['rekap'];
            //     $data['totalPertemuan'] = $hasil['totalPertemuan'];
            // }
                // Validasi input
                $prodi = $request->prodi;
                $semester = $request->semester;
                $matkul = $request->matkul;

                // Ambil data rekap
                $rekapData = $service->getRekapMahasiswa($prodi, $semester, $matkul);

                // Buat export anonymous class
                $export = new class($rekapData, $prodi, $matkul, $semester) implements FromView {
                    protected  $rekapData, $prodiId, $matkulId, $semester;

                    public function __construct($rekapData, $prodiId, $matkulId, $semester)
                    {
                        $this->rekapData = $rekapData;
                        $this->prodiId = $prodiId;
                        $this->matkulId = $matkulId;
                        $this->semester = $semester;
                    }

                    public function view(): View
                    {
                        return view('admin.rekap_presensi.mahasiswa_excel', [
                            'prodi' => Prodi::find($this->prodiId)?->nama_prodi ?? '-',
                            'semester' => $this->semester,
                            'matkul' => Matkul::find($this->matkulId)?->nama_matkul ?? '-',
                            'dataPresensi' => $this->rekapData['rekap'],
                            'totalPertemuan' => $this->rekapData['totalPertemuan'],
                        ]);
                    }
                };

            return Excel::download($export, 'Rekap Kehadiran Mahasiswa.xlsx');
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

        public function rekapMahasiswa(Request $request, RekapMahasiswaService $service)
    {
        $data['title'] = 'Rekap Mahasiswa';
        $data['judul'] = 'Rekap Mahasiswa';
        $data['dosen'] = Dosen::all();
        $data['prodi'] = Prodi::all();
        $data['prodiTerpilih'] = Prodi::findOrFail($request->prodi);
        $data['matkulTerpilih'] = Matkul::findOrFail($request->matkul);
        $data['semesterTerpilih'] = $request->input('semester');
        $data['tahun'] = TahunAjaran::all();
        $data['rekap'] = [];
        $data['totalPertemuan'] = 16;

        if ($request->isMethod('post')) {
            // $request->validate([
            //     'dosen' => 'required|exists:dosens,id',
            //     'tahun_ajaran' => 'required|exists:tahun_ajarans,id',
            // ]);

            $hasil = $service->getRekapMahasiswa($request->prodi, $request->semester, $request->matkul);
            $data['rekap'] = $hasil['rekap'];
            $data['totalPertemuan'] = $hasil['totalPertemuan'];
        }

        return view('admin.rekap_presensi.rekap_mahasiswa', $data);
    }
}
