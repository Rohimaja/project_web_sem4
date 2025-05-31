<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id', 'name'];

    public function kota()
    {
        return $this->hasMany(Kota::class);
    }
}
