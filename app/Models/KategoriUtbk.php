<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriUtbk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_utbks';

    protected $fillable = [
        'name',
        'kkm_ujian',
    ];

    public function PaketSoalUjianSaintek(): HasMany
    {
        return $this->hasMany(PaketSoalUjianSaintek::class);
    }

    public function PaketSoalUjianSoshum(): HasMany
    {
        return $this->hasMany(PaketSoalUjianSoshum::class);
    }

    // public function PaketSoalLatihanSoal(): HasMany
    // {
    //     return $this->hasMany(PaketSoalLatihanSoal::class);
    // }

}
