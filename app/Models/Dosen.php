<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Dosen extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'email',
        'no_telp',
        'alamat',
        'prodi_id',
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
        static::deleting(function ($dosen) {
            // Hapus foto jika ada
            if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                Storage::disk('public')->delete($dosen->foto);
            }

            // Jika kamu mau sekalian hapus user terkait:
            if ($dosen->user) {
                $dosen->user->delete();
            }
        });
    }
}
