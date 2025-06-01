<?php

// database/factories/ProdiFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdiFactory extends Factory
{
    public function definition(): array
    {
        $jenjang = $this->faker->randomElement(['D3', 'D4', 'S1']);

        $namaProdiList = [
            'Manajemen Informatika',
            'Teknik Komputer',
            'Teknik Elektronika',
            'Teknologi Informasi',
            'Teknik Mesin',
            'Teknik Sipil',
            'Akuntansi',
            'Administrasi Bisnis',
            'Manajemen Agribisnis',
            'Teknologi Hasil Pertanian',
            'Peternakan',
            'Kesehatan Lingkungan',
            'Manajemen Informasi Kesehatan',
        ];

        return [
            'kode_prodi' => strtoupper($this->faker->unique()->bothify('??###')),
            'jenjang' => $jenjang,
            'nama_prodi' => $jenjang . ' ' . $this->faker->unique()->randomElement($namaProdiList),
        ];
    }
}


