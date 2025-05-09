<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id', 'name'];

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }
}
