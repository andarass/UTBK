<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriLatihanSoal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'kategori_id',
    ];

    public function LatihanSoal(): HasMany
    {
        return $this->hasMany(LatihanSoal::class);
    }

    public function Kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
