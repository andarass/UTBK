<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PaketSoalUjianSoshum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kategori_utbk_id',
    ];

    public function KategoriUtbk(): BelongsTo
    {
        return $this->belongsTo(KategoriUtbk::class);
    }

    public function SoalUjianSoshum(): HasMany
    {
        return $this->hasMany(SoalUjianSoshum::class);
    }
}
