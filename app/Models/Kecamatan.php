<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id', 'kota_id', 'name'];

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }
}
