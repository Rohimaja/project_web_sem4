<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id', 'province_id', 'name'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
    public function province()
{
    return $this->belongsTo(Province::class);
}

}
