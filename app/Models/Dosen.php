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
