<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('provinces')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $json = File::get(database_path('data/provinces.json'));
        $provinces = json_decode($json, true);

        $insertData = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'alt_name' => $item['alt_name'] ?? null, // mapping alt_name, bisa null
                'latitude' => $item['latitude'] ?? null,
                'longitude' => $item['longitude'] ?? null,
            ];
        }, $provinces);

        DB::table('provinces')->insert($insertData);
    }
}
