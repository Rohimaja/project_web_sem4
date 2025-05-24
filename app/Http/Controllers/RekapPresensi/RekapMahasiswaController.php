<?php

namespace App\Http\Controllers\RekapPresensi;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Presensi;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Services\RekapMahasiswaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('rekap.rekap-mahasiswa', compact('title','prodi','prodiTerpilih','matkulTerpilih','semesterTerpilih','matkul','rekap','totalPertemuan'));
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

            $pdf = Pdf::loadView('rekap.export.mahasiswa-pdf', $data)->setPaper('a4', 'portrait');
            return $pdf->download('Rekap Kehadiran Mahasiswa.pdf');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'status' => 'error',
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
                        return view('rekap.export.mahasiswa-excel', [
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

        return view('rekap.rekap-mahasiswa', $data);
    }

            public function getMatkulDosen(Request $request)
    {
        $prodi = $request->query('prodi');
        $semester = $request->query('semester');
        $dosen = Auth::user()->dosen;

        $tahunAjaranAktif = TahunAjaran::where('status',  true)->first();
        $matkulId = Presensi::where('dosen_id',$dosen->id)->distinct()->pluck('matkul_id');

        $query = Matkul::query()->whereIn('id', $matkulId)->where('tahun_ajaran_id', $tahunAjaranAktif->id);


        // $query = Presensi::where('dosen_id', $dosen->id)->with('matkul:id,kode_matku,nama_matkul')->select('kode_matkul')->distinct()->get()->pluck('matkul');

        if ($prodi) {
            $query->where('prodi_id', $prodi);
        }

        if ($semester) {
            $query->where('semester', $semester);
        }

        $matkul = $query->get(['id', 'nama_matkul']);

        return response()->json($matkul);
    }
}
