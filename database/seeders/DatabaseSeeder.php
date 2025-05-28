<?php

namespace Database\Seeders;

use \Laravolt\Indonesia\Seeds\IndonesiaSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            TahunAjaranSeeder::class,
        ]);
        $this->call([
            RuanganSeeder::class,
            // seeder lainnya jika ada
        ]);
    }
}
