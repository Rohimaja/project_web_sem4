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

        // 1. Admin
        $adminUser = User::create([
            'name' => 'Admin Kampus',
            'email' => 'syahdega555@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'nama' => 'Admin Kampus',
            'jenis_kelamin'=> 'Perempuan',
            'agama' => 'Islam',
            'tempat_lahir' => 'Probolinggo',
            'tgl_lahir' => '2004-01-20',
            'email' => 'syahdega555@gmail.com',
            'no_telp' => '089989889876',
            'alamat' => 'Jember Kota',
        ]);

        // // 2. Dosen
        // $dosenUser = User::create([
        //     'name' => 'Dosen Informatika',
        //     'email' => 'rizirohim@gmail.com',
        //     'password' => Hash::make('dosen'),
        //     'role' => 'dosen',
        // ]);

        // Dosen::create([
        //     'user_id' => $dosenUser->id,
        //     'nama' => 'Ibu Dosen',
        //     'nip' => '1234567890',
        //     'jenis_kelamin'=> 'Perempuan',
        //     'agama' => 'Islam',
        //     'tempat_lahir' => 'Probolinggo',
        //     'tgl_lahir' => '2004-01-20',
        //     'email' => 'rizirohim@gmail.com',
        //     'no_telp' => '089989889876',
        //     'alamat' => 'Jember Kota',
        //     'prodi_id' => '1',
        // ]);

        // // 3. Mahasiswa
        // $mahasiswaUser = User::create([
        //     'name' => 'Budi Mahasiswa',
        //     'nim' => '220001122',
        //     'password' => Hash::make('mahasiswa'),
        //     'role' => 'mahasiswa',
        // ]);

        // Mahasiswa::create([
        //     'user_id' => $mahasiswaUser->id,
        //     'nim' => '220001122',
        //     'rfid' => 'RFID12345678',
        //     'nama' => 'Budi Mahasiswa',
        //     'jenis_kelamin'=> 'Perempuan',
        //     'agama' => 'Islam',
        //     'tempat_lahir' => 'Probolinggo',
        //     'tgl_lahir' => '2004-01-20',
        //     'email' => 'rizirohim@gmail.com',
        //     'no_telp' => '089989889876',
        //     'alamat' => 'Jember Kota',
        //     'prodi_id' => '1',
        //     'tahun_masuk' => '2023',
        //     'tahun_ajaran_id' => '1',
        //     'semester' => '3',
        // ]);
    }
}
