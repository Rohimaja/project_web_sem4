<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Services\RekapDosenService;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class RekapDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RekapDosenService $service)
    {
        $data['title'] = 'Rekap Dosen';
        $data['judul'] = 'Rekap Dosen';
        $data['dosen'] = Dosen::all();
        $data['prodi'] = Prodi::all();
        // $dosenTerpilih = Auth::user()->dosen;
        $data['dosenTerpilih'] = Auth::user()->dosen;
        // $data['dosenTerpilih'] = Dosen::findOrFail($request->dosen);
        // $data['tahunTerpilih'] = TahunAjaran::findOrFail($request->tahun_ajaran);
        $data['tahun'] = TahunAjaran::all();
        $data['rekap'] = [];
        $data['totalPertemuan'] = 16;

        // if ($request->isMethod('post')) {
        //     $request->validate([
        //         'dosen' => 'required|exists:dosens,id',
        //         'tahun_ajaran' => 'required|exists:tahun_ajarans,id',
        //     ]);

        // }
        $hasil = $service->getRekapDosen($data['dosenTerpilih']->id);
        $data['rekap'] = $hasil['rekap'];
        $data['totalPertemuan'] = $hasil['totalPertemuan'];


        return view('dosen.rekap_presensi.rekap_dosen', $data);
    }

    //     public function exportPdf(Request $request)
    // {
    //     $data = [
    //         'nip' => '19800101 200501 1 001',
    //         'nama' => 'Dr. Budi Santoso, M.Kom',
    //         'prodi' => 'S1 Informatika',
    //         'semester' => 'Ganjil',
    //         'matkul' => 'Pemrograman Web',
    //         'dataPresensi' => Rekap::getData(), // ganti sesuai logika data kamu
    //     ];

    //     $pdf = PDF::loadView('rekap.pdf', $data)->setPaper('a4', 'landscape');
    //     return $pdf->download('rekap-kehadiran-dosen.pdf');
    // }





    public function exportPdf(Request $request, RekapDosenService $service)
    {
        $dosen = Auth::user()->dosen;

        if (!$dosen) {
            abort(403, 'Dosen tidak ditemukan atau tidak terhubung dengan akun.');
        }

        $rekapData = $service->getRekapDosen($dosen->id);

        $data = [
            'nip' => $dosen->nip,
            'nama' => $dosen->nama,
            'prodi' => $dosen->prodi->jenjang . ' ' . $dosen->prodi->nama_prodi,
            'semester' => 'Ganjil', // opsional: bisa ambil dari request jika sudah ada filter
            'matkul' => '-', // opsional: isi jika ada filter mata kuliah
            'dataPresensi' => $rekapData['rekap'],
            'totalPertemuan' => $rekapData['totalPertemuan'],
        ];

        $pdf = Pdf::loadView('dosen.rekap_presensi.pdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('rekap-kehadiran-dosen.pdf');
    }







       public function exportExcel(Request $request, RekapDosenService $service)
    {
        $dosen = Auth::user()->dosen;

            $rekapData = $service->getRekapDosen($dosen->id);

            $totalPertemuan = $rekapData['totalPertemuan'] ?? 16;

            $export = new class($dosen, $rekapData, $totalPertemuan) implements FromView {

                protected $dosen;
                protected $rekapData;
                protected $totalPertemuan;

                public function __construct($dosen, $rekapData, $totalPertemuan)
                {
                    $this->dosen = $dosen;
                    $this->rekapData = $rekapData;
                    $this->totalPertemuan = $totalPertemuan;
                }

                public function view(): View
                {
                    return view('dosen.rekap_presensi.excel', [
                        'nip' => $this->dosen->nip,
                        'nama' => $this->dosen->nama,
                        'prodi' => $this->dosen->prodi->jenjang . ' ' . $this->dosen->prodi->nama_prodi,
                        'semester' => 'Ganjil', // bisa kamu sesuaikan
                        'matkul' => '-',        // bisa kamu sesuaikan
                        'dataPresensi' => $this->rekapData['rekap'],
                        'totalPertemuan' => $this->totalPertemuan,
                    ]);
                }
            };

            return Excel::download($export, 'rekap_dosen.xlsx');
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
        // $dosenTerpilih = Auth::user()->dosen;
        $data['dosenTerpilih'] = Auth::user()->dosen;
        // $data['dosenTerpilih'] = Dosen::findOrFail($request->dosen);
        // $data['tahunTerpilih'] = TahunAjaran::findOrFail($request->tahun_ajaran);
        $data['tahun'] = TahunAjaran::all();
        $data['rekap'] = [];
        $data['totalPertemuan'] = 16;

        if ($request->isMethod('post')) {
            $request->validate([
                'dosen' => 'required|exists:dosens,id',
                'tahun_ajaran' => 'required|exists:tahun_ajarans,id',
            ]);

            $hasil = $service->getFilterRekapDosen($data['dosenTerpilih']->id, $request->prodi_id, $request->tahun_ajaran_id);
            $data['rekap'] = $hasil['rekap'];
            $data['totalPertemuan'] = $hasil['totalPertemuan'];
        }

        return response()->json($data);

    }
}
