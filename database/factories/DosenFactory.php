<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
    public function definition(): array
    {
        // Ambil lokasi valid dan berelasi
        $village = Village::inRandomOrder()->first();

        if (!$village || !$village->district || !$village->district->regency || !$village->district->regency->province) {
            throw new \Exception("Data lokasi tidak lengkap atau tidak nyambung (relasi tidak valid).");
        }

        $district = $village->district;
        $regency = $district->regency;
        $province = $regency->province;

        $jenisKelamin = $this->faker->randomElement(['Laki-laki', 'Perempuan']);
        $agama = $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);

        return [
            'user_id' => User::where('role', 'dosen')->inRandomOrder()->first()?->id ?? User::factory(),
            'nip' => $this->faker->unique()->numerify('##########'),
            'nama' => $this->faker->name($jenisKelamin === 'Laki-laki' ? 'male' : 'female'),
            'jenis_kelamin' => $jenisKelamin,
            'agama' => $agama,
            'tempat_lahir' => $this->faker->city(),
            'tgl_lahir' => $this->faker->date('Y-m-d', '1980-01-01'),
            'email' => $this->faker->unique()->userName() . '@gmail.com',
            'no_telp' => '08' . $this->faker->numerify('##########'),
            'alamat' => "$village->name, $district->name, $regency->name, $province->name",

            'province_id' => $province->id,
            'regency_id' => $regency->id,
            'district_id' => $district->id,
            'village_id' => $village->id,

            'prodi_id' => Prodi::inRandomOrder()->first()?->id ?? 1,
            'foto' => null,
        ];
    }
}
