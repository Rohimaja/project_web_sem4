<?php
namespace App\Services;

use App\Models\Presensi;

class RekapDosenService
{
    public function getRekapDosen($dosenId, $tahunAjaranId)
    {
        $presensis = Presensi::with(['dosen', 'matkul', 'prodi', 'tahunAjaran'])
            ->where('dosen_id', $dosenId)
            ->where('tahun_ajaran_id', $tahunAjaranId)
            ->orderBy('tgl_presensi')
            ->get();

        $rekap = [];
        $maxPertemuan = 0;

        foreach ($presensis->groupBy('matkul_id') as $matkulId => $grouped) {
            $tanggal = $grouped->pluck('tgl_presensi')->sort()->values();
            $rekap[] = [
                'kode_matkul' => $grouped->first()->matkul->kode_matkul,
                'nama_matkul' => $grouped->first()->matkul->nama_matkul,
                'nama_prodi' => $grouped->first()->prodi->nama_prodi,
                'semester' => $grouped->first()->semester,
                'nama_dosen' => $grouped->first()->dosen->nama,
                'total_pertemuan' => $tanggal->count(),
                'tanggal_pertemuan' => $tanggal->toArray(),
            ];

            if ($tanggal->count() > $maxPertemuan) {
                $maxPertemuan = $tanggal->count();
            }
        }

        return [
            'rekap' => $rekap,
            'totalPertemuan' => max(16, $maxPertemuan),
        ];
    }
}
