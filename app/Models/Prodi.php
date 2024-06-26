<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nilai_minimal',
        'universitas_id',
    ];

    public function Universitas(): BelongsTo
    {
        return $this->belongsTo(Universitas::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
