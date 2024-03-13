<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketSoalLatihanSoal extends Model
{
    use HasFactory;

    protected $table = 'paket_soal_latihan_soals';

    protected $fillable = [
        'name',
        'kategori_utbk_id',
    ];

    public function KategoriUtbk(): BelongsTo
    {
        return $this->belongsTo(KategoriUtbk::class);
    }

}
