<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSoalSaintek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_soal_sainteks';

    protected $fillable = [
        'name',
    ];

    public function SoalUjianSaintek(): HasMany
    {
        return $this->hasMany(SoalUjianSaintek::class);
    }
}
