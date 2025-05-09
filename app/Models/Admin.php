<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Admin extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'email',
        'no_telp',
        'alamat',
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
}
