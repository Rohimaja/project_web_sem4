<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\TahunAjaran;

class MatkulSeeder extends Seeder
{
    public function run(): void
    {
        $prodiId = Prodi::inRandomOrder()->first()->id;
        $tahunAjaranId = TahunAjaran::inRandomOrder()->first()->id;

        $matkuls = [
            ['kode_matkul' => 'MKU101', 'nama_matkul' => 'Pendidikan Pancasila', 'semester' => 1, 'durasi_matkul' => '2'],
            ['kode_matkul' => 'MKU102', 'nama_matkul' => 'Bahasa Indonesia', 'semester' => 1, 'durasi_matkul' => '2'],
            ['kode_matkul' => 'MKU103', 'nama_matkul' => 'Matematika Dasar', 'semester' => 1, 'durasi_matkul' => '3'],
            ['kode_matkul' => 'MKI104', 'nama_matkul' => 'Algoritma dan Pemrograman', 'semester' => 1, 'durasi_matkul' => '3'],
            ['kode_matkul' => 'MKI105', 'nama_matkul' => 'Pengantar Teknologi Informasi', 'semester' => 1, 'durasi_matkul' => '2'],
            ['kode_matkul' => 'MKI201', 'nama_matkul' => 'Struktur Data', 'semester' => 2, 'durasi_matkul' => '3'],
            ['kode_matkul' => 'MKI202', 'nama_matkul' => 'Sistem Operasi', 'semester' => 2, 'durasi_matkul' => '3'],
            ['kode_matkul' => 'MKI203', 'nama_matkul' => 'Basis Data', 'semester' => 2, 'durasi_matkul' => '3'],
            ['kode_matkul' => 'MKI204', 'nama_matkul' => 'Pemrograman Web', 'semester' => 2, 'durasi_matkul' => '3'],
            ['kode_matkul' => 'MKU105', 'nama_matkul' => 'Kewirausahaan', 'semester' => 2, 'durasi_matkul' => '2'],
        ];

        foreach ($matkuls as $matkul) {
            Matkul::create([
                'kode_matkul' => $matkul['kode_matkul'],
                'nama_matkul' => $matkul['nama_matkul'],
                'tahun_ajaran_id' => $tahunAjaranId,
                'semester' => $matkul['semester'],
                'durasi_matkul' => $matkul['durasi_matkul'],
                'prodi_id' => $prodiId,
            ]);
        }
    }
}
