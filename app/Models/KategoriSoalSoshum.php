<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSoalSoshum extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_soal_soshums';

    protected $fillable = [
        'name',
    ];

    public function SoalUjianSoshum(): HasMany
    {
        return $this->hasMany(SoalUjianSoshum::class);
    }
}
