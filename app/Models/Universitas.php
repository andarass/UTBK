<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Universitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function Prodi(): HasMany
    {
        return $this->hasMany(SoalUjian::class);
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
