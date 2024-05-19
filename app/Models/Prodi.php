<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
