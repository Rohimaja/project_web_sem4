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
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kelurahan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::deleting(function ($admin) {
            // Hapus foto jika ada
            if ($admin->foto && Storage::disk('public')->exists($admin->foto)) {
                Storage::disk('public')->delete($admin->foto);
            }

            // Jika kamu mau sekalian hapus user terkait:
            if ($admin->user) {
                $admin->user->delete();
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
