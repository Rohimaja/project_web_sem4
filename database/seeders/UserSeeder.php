<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Cek apakah user dengan email ini sudah ada
    $existingUser = User::where('email', 'syahdega555@gmail.com')->first();

    // if (!$existingUser) {
    //     $adminUser = User::create([
    //         'name' => 'Admin Kampus',
    //         'email' => 'syahdega555@gmail.com',
    //         'password' => Hash::make('admin'),
    //         'role' => 'admin',
    //     ]);

    //     Admin::create([
    //         'user_id' => $adminUser->id,
    //         'nama' => 'Admin Kampus',
    //         'jenis_kelamin'=> 'Perempuan',
    //         'agama' => 'Islam',
    //         'tempat_lahir' => 'Probolinggo',
    //         'tgl_lahir' => '2004-01-20',
    //         'email' => 'syahdega555@gmail.com',
    //         'no_telp' => '089989889876',
    //         'alamat' => 'Jember Kota',
    //         'province_id' => 11,
    //         'regency_id' => 1101,
    //         'district_id' => 1101010,
    //         'village_id' => 1101010001,
    //     ]);
    // }
}

}
