<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VillageSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah file tersedia dan valid
        $jsonPath = database_path('data/villages.json');
        if (!File::exists($jsonPath)) {
            throw new \Exception("File villages.json tidak ditemukan di: $jsonPath");
        }

        $json = File::get($jsonPath);
        $villages = json_decode($json, true);

        if (!is_array($villages)) {
            throw new \Exception("Format JSON tidak valid pada villages.json.");
        }

        // Hapus data dengan cara yang aman (tanpa truncate)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('villages')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Masukkan data secara bertahap (chunk)
        $chunks = array_chunk($villages, 1000); // bisa sesuaikan jumlahnya

        foreach ($chunks as $chunk) {
            $insertData = array_map(function ($item) {
                return [
                    'id' => $item['id'],
                    'district_id' => $item['district_id'],
                    'name' => $item['name'],
                    'alt_name' => $item['alt_name'] ?? null,
                    'latitude' => $item['latitude'] ?? null,
                    'longitude' => $item['longitude'] ?? null,
                ];
            }, $chunk);

            DB::table('villages')->insert($insertData);
        }
    }
}
