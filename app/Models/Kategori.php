<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function Pertanyaan(): HasMany
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function SoalUjian(): HasMany
    {
        return $this->hasMany(SoalUjian::class);
    }

    public function LatihanSoal(): HasMany
    {
        return $this->hasMany(LatihanSoal::class);
    }
}
