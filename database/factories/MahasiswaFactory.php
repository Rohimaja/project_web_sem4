<?php
namespace Database\Factories;

use App\Models\User;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    public function definition(): array
    {
        // Ambil lokasi yang saling berelasi
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
            'user_id' => User::where('role', 'mahasiswa')
                ->whereDoesntHave('mahasiswa')
                ->inRandomOrder()
                ->first()?->id,
            'nim' => $this->faker->unique()->numerify('##########'),
            'rfid' => $this->faker->optional()->regexify('[A-Z0-9]{10,30}'),
            'nama' => $this->faker->name($jenisKelamin === 'Laki-laki' ? 'male' : 'female'),
            'jenis_kelamin' => $jenisKelamin,
            'agama' => $agama,
            'tempat_lahir' => $this->faker->city(),
            'tgl_lahir' => $this->faker->date('Y-m-d', '2004-12-31'),
            'email' => $this->faker->unique()->userName() . '@gmail.com',
            'no_telp' => '+62' . $this->faker->numerify('8#########'),
            'alamat' => "$village->name, $district->name, $regency->name, $province->name",

            'province_id' => $province->id,
            'regency_id' => $regency->id,
            'district_id' => $district->id,
            'village_id' => $village->id,

            'prodi_id' => Prodi::inRandomOrder()->first()?->id ?? Prodi::factory()->create()->id,
            'tahun_masuk' => $this->faker->year(),
            'tahun_ajaran_id' => TahunAjaran::inRandomOrder()->first()?->id ?? TahunAjaran::factory()->create()->id,
            'semester' => $this->faker->numberBetween(1, 8),
            'email_verified_at' => now(),
            'foto' => null,
        ];
    }
}
