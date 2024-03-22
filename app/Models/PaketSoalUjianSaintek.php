<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketSoalUjianSaintek extends Model
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

    public function SoalUjianSaintek(): HasMany
    {
        return $this->hasMany(SoalUjianSaintek::class);
    }

}
