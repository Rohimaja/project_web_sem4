<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id', 'regency_id', 'name'];

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
