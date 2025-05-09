<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class Mahasiswa extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'nim',
        'rfid',
        'nama',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'email',
        'no_telp',
        'alamat',
        'prodi_id',
        'tahun_masuk',
        'tahun_ajaran_id',
        'semester',
        'foto',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($mahasiswa) {
            // Hapus foto jika ada
            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }

            // Jika kamu mau sekalian hapus user terkait:
            if ($mahasiswa->user) {
                $mahasiswa->user->delete();
            }
        });
    }

    // Method ini digunakan untuk mengambil email untuk verifikasi
    public function getEmailForVerification()
    {
        return $this->email;  // Atau jika kamu ingin custom, bisa menambahkan logika lainnya
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }
}
